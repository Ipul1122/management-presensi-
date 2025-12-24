<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use Illuminate\Support\Facades\Storage;
use App\Models\NotifikasiAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use Barryvdh\DomPDF\Facade\Pdf;
// [CACHE] Import Facade Cache
use Illuminate\Support\Facades\Cache;

class MuridController extends Controller
{
    public function index(Request $request)
    {
        $query = Murid::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('id_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('ayah', 'like', "%{$search}%")
                  ->orWhere('ibu', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('jenis_kelamin', $request->gender);
        }

        if ($request->filled('kitab')) {
            $query->where('jenis_alkitab', $request->kitab);
        }

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        $murids = $query->orderBy('created_at', 'asc')->paginate(10);
        
        // [CACHE] Menyimpan jumlah notifikasi unread selama 5 menit (300 detik)
        // Kunci cache: 'admin_unread_notif'
        $unreadCount = Cache::remember('admin_unread_notif', 300, function () {
            return NotifikasiAdmin::where('is_read', false)->count();
        });

        return view('admin.murid.index', compact('murids', 'unreadCount'));
    }

    public function create()
    {
        return view('admin.murid.create');
    }

    public function store(Request $request)
    {
        Log::info('MuridController@store called', ['request' => $request->all()]);

        $validatedData = $request->validate([
            'nama_anak.*' => 'required|string|max:255',
            'foto_anak.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'jenis_kelamin.*' => 'required|in:Laki-laki,Perempuan',
            'alamat.*' => 'required|string',
            'kelas.*' => 'required|string',
            'jenis_alkitab.*' => 'required|in:iqro,Al-Quran',
            'tanggal_daftar.*' => 'required|date',
            'nomor_telepon.*' => 'required|string|max:20',
            'ayah.*' => 'required|string|max:255',
            'ibu.*' => 'required|string|max:255',
        ]);

        $count = count($request->nama_anak); 

        for ($i = 0; $i < $count; $i++) {
            $muridData = [
                'nama_anak'      => $request->nama_anak[$i],
                'jenis_kelamin'  => $request->jenis_kelamin[$i],
                'alamat'         => $request->alamat[$i],
                'kelas'          => $request->kelas[$i],
                'jenis_alkitab'  => $request->jenis_alkitab[$i],
                'tanggal_daftar' => $request->tanggal_daftar[$i],
                'nomor_telepon'  => $request->nomor_telepon[$i],
                'ayah'           => $request->ayah[$i],
                'ibu'            => $request->ibu[$i],
            ];

            if (isset($request->foto_anak[$i]) && $request->foto_anak[$i] instanceof \Illuminate\Http\UploadedFile) {
                $muridData['foto_anak'] = $request->foto_anak[$i]->store('foto_anak', 'public');
            }

            $murid = Murid::create($muridData);

            NotifikasiAdmin::create([
                'aksi'       => 'Admin Tambah Data Murid',
                'deskripsi'  => 'Admin menambahkan Murid bernama ' . $murid->nama_anak,
            ]);

            Log::info('MuridController@store success', ['data' => $muridData]);
        }

        // [CACHE] Hapus cache saat ada data baru masuk
        $this->clearMuridCache(); 

        return redirect()->route('admin.murid.index')
                        ->with('success', 'Semua data pendaftaran berhasil disimpan.');
    }

    public function edit($id)
    {
        $murid = Murid::findOrFail($id);
        return view('admin.murid.edit', compact('murid'));
    }

    public function show()
    {
        $murids = Murid::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.murid.show', compact('murids'));
    }

    public function update(Request $request, $id)
    {
        $murid = Murid::findOrFail($id);

        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'kelas' => 'required|string',
            'tanggal_daftar' => 'required|date',
            'jenis_alkitab' => 'required|in:iqro,Al-Quran',
            'nomor_telepon' => 'required|string|max:20',
            'ayah' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'foto_anak' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', 
        ]);        

        NotifikasiAdmin::create([
            'aksi' => 'Admin Edit Data Murid',
            'deskripsi' => 'Admin mengubah data Murid bernama ' . $request['nama_anak'],
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_anak')) {
            if ($murid->foto_anak && Storage::disk('public')->exists($murid->foto_anak)) {
                Storage::disk('public')->delete($murid->foto_anak);
            }
            $data['foto_anak'] = $request->file('foto_anak')->store('foto_anak', 'public');
        }

        $murid->update($data);

        // [CACHE] Hapus cache saat data diedit
        $this->clearMuridCache();

        return redirect()->route('admin.murid.index')->with('success', 'Data murid berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $murid = Murid::findOrFail($id);
        NotifikasiAdmin::create([
            'aksi' => 'Admin Hapus Data Murid',
            'deskripsi' => 'Admin menghapus Murid bernama ' . $murid->nama_murid,
        ]);
        
        if ($murid->foto_anak && Storage::disk('public')->exists($murid->foto_anak)) {
            Storage::disk('public')->delete($murid->foto_anak);
        }

        $murid->delete();

        // [CACHE] Hapus cache saat data dihapus
        $this->clearMuridCache();

        return redirect()->route('admin.murid.index')->with('success', 'Data murid berhasil dihapus.');
    }

    // [CACHE] Method statistik ini paling berat, jadi kita cache hasilnya
    public function dataMurid()
    {
        // Ingat data ini selama 10 menit (600 detik)
        $stats = Cache::remember('statistik_murid', 600, function () {
            // Semua query count() dipindahkan ke dalam sini
            return [
                'totalLaki' => Murid::where('jenis_kelamin', 'Laki-laki')->count(),
                'totalPerempuan' => Murid::where('jenis_kelamin', 'Perempuan')->count(),
                'kelasCounts' => Murid::select('kelas', DB::raw('count(*) as total'))
                                ->groupBy('kelas')
                                ->orderBy('kelas')
                                ->get(),
                'totalIqro' => Murid::where('jenis_alkitab', 'iqro')->count(),
                'totalQuran' => Murid::where('jenis_alkitab', 'Al-Quran')->count(),
            ];
        });

        // Mengakses array stats
        return view('admin.dataMurid', $stats);
    }
    
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || count($ids) === 0) {
            return redirect()->route('admin.murid.index')->with('error', 'Tidak ada data yang dipilih.');
        }

        $murids = Murid::whereIn('id_pendaftaran', $ids)->get();

        foreach ($murids as $murid) {
            NotifikasiAdmin::create([
                'aksi' => 'Admin Hapus Data murid (Bulk)',
                'deskripsi' => 'Admin menghapus murid bernama ' . $murid->nama_anak,
            ]);
            
            if ($murid->foto_anak && Storage::disk('public')->exists($murid->foto_anak)) {
                Storage::disk('public')->delete($murid->foto_anak);
            }
            $murid->delete();
        }

        // [CACHE] Hapus cache setelah hapus massal
        $this->clearMuridCache();

        return redirect()->route('admin.murid.index')->with('success', count($ids) . ' data murid berhasil dihapus.');
    }

    public function deleteAll()
    {
        $murids = Murid::all();
        
        // Perbaikan: Loop untuk notifikasi yang benar sebelum truncate
        foreach($murids as $m) {
             NotifikasiAdmin::create([
                'aksi' => 'Admin Hapus Data Murid (Bulk)',
                'deskripsi' => 'Admin menghapus Murid bernama ' . $m->nama_anak,
            ]);
        }
       
        Murid::truncate(); 

        // [CACHE] Hapus cache total
        $this->clearMuridCache();

        return redirect()->route('admin.murid.index')->with('success', 'Seluruh data murid telah dihapus.');
    }

    public function cetakPDF()
    {
        $murid = Murid::select([
            'id_pendaftaran', 'nama_anak', 'jenis_kelamin', 'alamat',
            'kelas', 'jenis_alkitab', 'nomor_telepon', 'ayah', 'ibu'
        ])->get();

        $pdf = Pdf::loadView('admin.murid.pdf', compact('murid'));
        return $pdf->stream('data-murid.pdf');
    }

    // [CACHE] Helper Private function untuk membersihkan semua cache terkait
    private function clearMuridCache()
    {
        // Hapus cache statistik agar dihitung ulang
        Cache::forget('statistik_murid');
        
        // Hapus cache dashboard (jika Anda menerapkan cache di DashboardController sebelumnya)
        Cache::forget('dashboard_jumlah_murid');
        
        // Hapus cache notifikasi karena kita membuat notifikasi baru di method create/update/delete
        Cache::forget('admin_unread_notif');
    }
}
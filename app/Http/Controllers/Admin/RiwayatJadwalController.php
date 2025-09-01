<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Pengajar;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatJadwalController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        $availableYears = Jadwal::selectRaw('YEAR(tanggal_jadwal) as tahun')
            ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
            ->distinct()
            ->pluck('tahun')
            ->sortDesc();

        $jadwalData = Jadwal::selectRaw('MONTH(tanggal_jadwal) as bulan, YEAR(tanggal_jadwal) as tahun, COUNT(*) as jumlah')
            ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
            ->groupBy('bulan', 'tahun')
            ->get()
            ->keyBy(fn($item) => $item->tahun . '-' . $item->bulan);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $groupedByMonth = collect();

        if ($bulan && $tahun) {
            $riwayatJadwal = Jadwal::whereMonth('tanggal_jadwal', $bulan)
                ->whereYear('tanggal_jadwal', $tahun)
                ->whereDate('tanggal_jadwal', '<', $now->startOfMonth())
                ->orderBy('tanggal_jadwal', 'desc')
                ->get();

            $groupedByMonth = $riwayatJadwal->groupBy(fn($item) => Carbon::parse($item->tanggal_jadwal)->format('F Y'));
        }

        return view('admin.riwayatJadwal.index', compact('groupedByMonth', 'availableYears', 'jadwalData'));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $pengajars = Pengajar::all();

        return view('admin.riwayatJadwal.edit', compact('jadwal', 'pengajars'));
    }

    // Admin/RiwayatJadwalController.php (hanya method update)
public function update(Request $request, $id)
{
    $rules = [
        'nama_jadwal'     => 'required|string|max:255',
        'tanggal_jadwal'  => 'required|date',
        'pukul_jadwal'    => 'required|string|max:100',
        'kegiatan_jadwal' => 'nullable|string',
    ];

    $inputPengajar = $request->input('nama_pengajar_jadwal');

    if (is_array($inputPengajar)) {
        $rules['nama_pengajar_jadwal'] = 'required|array|min:1';
        $rules['nama_pengajar_jadwal.*'] = 'required|string|max:255';
    } else {
        $rules['nama_pengajar_jadwal'] = 'required|string|max:255';
    }

    $validated = $request->validate($rules);

    // Normalisasi input pengajar
    if (is_array($inputPengajar)) {
        $clean = array_filter(array_map('trim', $inputPengajar));
        $validated['nama_pengajar_jadwal'] = implode(',', $clean);
        $jumlahPengajar = count($clean);
    } else {
        $validated['nama_pengajar_jadwal'] = trim($inputPengajar ?? '');
        $jumlahPengajar = $validated['nama_pengajar_jadwal'] ? 1 : 0;
    }

    // Hitung gaji otomatis = jumlah pengajar × 50.000
    $validated['gaji'] = $jumlahPengajar * 50000;

    $jadwal = Jadwal::findOrFail($id);
    $jadwal->update([
        'nama_jadwal'          => $validated['nama_jadwal'],
        'tanggal_jadwal'       => $validated['tanggal_jadwal'],
        'pukul_jadwal'         => $validated['pukul_jadwal'],
        'nama_pengajar_jadwal' => $validated['nama_pengajar_jadwal'],
        'kegiatan_jadwal'      => $validated['kegiatan_jadwal'] ?? null,
        'gaji'                 => $validated['gaji'],
    ]);

    return redirect()->route('admin.riwayatJadwal.index')
                     ->with('success', 'Jadwal berhasil diperbarui.');
}


    public function exportPdf(Request $request)
    {
        $bulan = (int) $request->bulan;
        $tahun = (int) $request->tahun;

        if (!$bulan || !$tahun) {
            return redirect()->back()->with('error', 'Bulan dan tahun harus dipilih.');
        }

        $data = Jadwal::whereMonth('tanggal_jadwal', $bulan)
            ->whereYear('tanggal_jadwal', $tahun)
            ->orderBy('tanggal_jadwal', 'asc')
            ->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data jadwal untuk bulan dan tahun tersebut.');
        }

        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');
        $judul = "Riwayat Jadwal - $namaBulan $tahun";
        $jadwals = $data;

        $pdf = Pdf::loadView('admin.riwayatJadwal.pdf', compact('judul', 'jadwals'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("riwayat-jadwal-$bulan-$tahun.pdf");
    }

    public function bulkDelete(Request $request)
    {
        $ids = array_filter(explode(',', (string) $request->input('ids', '')));
        if (empty($ids)) {
            return back()->withErrors(['ids' => 'Tidak ada data yang dipilih.']);
        }
        Jadwal::whereIn('id', $ids)->delete();

        return back()->with('success', 'Jadwal terpilih berhasil dihapus.');
    }

    public function deleteAll(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $q = Jadwal::query();
        if ($bulan) {
            $q->whereMonth('tanggal_jadwal', $bulan);
        }
        if ($tahun) {
            $q->whereYear('tanggal_jadwal', $tahun);
        }

        $deleted = $q->delete();

        return back()->with('success', "Berhasil menghapus {$deleted} jadwal.");
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Pengajar;
use App\Models\NotifikasiAdmin;
use Carbon\Carbon;

class DashboardPengajarController extends Controller
{
    //
    public function index()
    {

        // Mengambil jadwal bulan ini dan mengurutkannya berdasarkan tanggal
        $jadwalBulanIni = Jadwal::whereMonth('tanggal_jadwal', Carbon::now()->month)
            ->whereYear('tanggal_jadwal', Carbon::now()->year)
            ->orderBy('tanggal_jadwal', 'asc')
            ->get()
            ->map(function ($item) {
                $today = Carbon::today();
                $tanggal = Carbon::parse($item->tanggal_jadwal);

                if ($tanggal->isToday()) {
                    $item->status = 'Hari Ini';
                } elseif ($tanggal->isPast()) {
                    $item->status = 'Selesai';
                } else {
                    $item->status = 'Akan Datang';
                }

                return $item;
            });


            // Ambil semua data pengajar
            $dataPengajar = Pengajar::all();

            // Ambil notifikasi admin untuk pengajar yang sedang input absensi
            // NotifikasiAdmin::create([
            //     'aksi' => 'Input Absensi' ,
            //     'deskripsi' => 'Pengajar' . auth()->guard('pengajar')->user()->nama_pengajar . 'melakukan input absensi bernama' . $request->nama_murid,
            // ]);

        return view('pengajar.dashboard', compact('jadwalBulanIni',  'dataPengajar'));
    }
}

<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Pengajar;
use Carbon\Carbon;


class DashboardPengajarController extends Controller
{
    //
    public function index()
    {
         // Menampilkan Jadwal bulan ini di halaman dashboard pengajar
        $namaPengajar = auth('pengajar')->user()->nama_pengajar;

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

            // Ambil nama pengajar yang telah diinputkan oleh admin
            $namaPengajar = auth('pengajar')->user()->nama_pengajar;

            // Ambil semua data pengajar
            $dataPengajar = Pengajar::all();

        return view('pengajar.dashboard', compact('jadwalBulanIni', 'namaPengajar', 'dataPengajar'));
    }
}

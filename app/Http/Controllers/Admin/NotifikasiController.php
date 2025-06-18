<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotifikasiAdmin;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Auto delete notifications older than 5 minutes
        $this->autoDeleteExpiredNotifications();
        
        $notifikasi = NotifikasiAdmin::latest()->get();

        NotifikasiAdmin::where('is_read', false)->update(['is_read' => true]);

        return view('admin.notifikasi.index', compact('notifikasi'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || count($ids) === 0) {
            return redirect()->route('admin.notifikasi.index')->with('error', 'Tidak ada notifikasi yang dipilih.');
        }

        NotifikasiAdmin::whereIn('id', $ids)->delete();

        return redirect()->route('admin.notifikasi.index')->with('success', 'Beberapa notifikasi berhasil dihapus.');
    }

    public function deleteAll()
    {
        NotifikasiAdmin::truncate();
        return redirect()->route('admin.notifikasi.index')->with('success', 'Semua notifikasi berhasil dihapus.');
    }

    /**
     * Auto delete notifications older than 5 minutes
     */
    private function autoDeleteExpiredNotifications()
    {
        $expiredTime = Carbon::now()->subMinutes(5);
        NotifikasiAdmin::where('created_at', '<', $expiredTime)->delete();
    }

    /**
     * API endpoint to get remaining time for notifications
     */
    public function getNotificationTimes()
    {
        $notifikasi = NotifikasiAdmin::select('id', 'created_at')->get();
        $currentTime = Carbon::now();
        
        $times = [];
        foreach ($notifikasi as $notif) {
            $createdTime = Carbon::parse($notif->created_at);
            $elapsedSeconds = $currentTime->diffInSeconds($createdTime);
            $remainingSeconds = max(0, 300 - $elapsedSeconds); // 300 seconds = 5 minutes
            
            $times[$notif->id] = [
                'remaining_seconds' => $remainingSeconds,
                'expired' => $remainingSeconds <= 0
            ];
        }
        
        return response()->json($times);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenstrualCycle;
use App\Models\DailyLog;
use App\Models\CycleSetting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil riwayat menstruasi milik pengguna yang login
        $cycles = MenstrualCycle::where('user_id', Auth::id())
            ->orderBy('start_date', 'desc')
            ->get();

        $totalCycles = $cycles->count();

        // Menghitung rata-rata panjang siklus dari riwayat aktual
        $sortedCycles = $cycles->sortBy('start_date')->values();
        $cycleLengths = [];

        for ($i = 1; $i < $sortedCycles->count(); $i++) {
            $previousDate = Carbon::parse($sortedCycles[$i - 1]->start_date);
            $currentDate = Carbon::parse($sortedCycles[$i]->start_date);

            $cycleLengths[] = $previousDate->diffInDays($currentDate);
        }

        $averageCycle = count($cycleLengths) > 0
            ? round(array_sum($cycleLengths) / count($cycleLengths))
            : null;

        // Menghitung rata-rata durasi menstruasi aktual
        $periodDurations = $cycles
            ->filter(fn ($cycle) => $cycle->end_date !== null)
            ->map(fn ($cycle) => Carbon::parse($cycle->start_date)
                ->diffInDays(Carbon::parse($cycle->end_date)) + 1);

        $averagePeriod = $periodDurations->count() > 0
            ? round($periodDurations->avg(), 1)
            : null;

        // Mengambil pengaturan manual pengguna
        $setting = CycleSetting::where('user_id', Auth::id())->first();

        // Menentukan sumber panjang siklus
        if ($averageCycle !== null) {
            $effectiveCycleLength = $averageCycle;
            $cycleSource = 'Otomatis dari riwayat';
        } else {
            $effectiveCycleLength = $setting?->cycle_length;
            $cycleSource = $effectiveCycleLength !== null
                ? 'Pengaturan manual'
                : 'Belum tersedia';
        }

        // Menentukan sumber durasi menstruasi
        if ($averagePeriod !== null) {
            $effectivePeriodDuration = $averagePeriod;
            $periodSource = 'Otomatis dari riwayat';
        } else {
            $effectivePeriodDuration = $setting?->period_duration;
            $periodSource = $effectivePeriodDuration !== null
                ? 'Pengaturan manual'
                : 'Belum tersedia';
        }

        // Menghitung hari siklus dan perkiraan menstruasi berikutnya
        $latestCycle = $cycles->first();
        $cycleDay = null;
        $nextPeriod = null;

        if ($latestCycle) {
            $today = Carbon::today();
            $startDate = Carbon::parse($latestCycle->start_date);

            if ($startDate->lessThanOrEqualTo($today)) {
                $cycleDay = $startDate->diffInDays($today) + 1;
            }

            if ($effectiveCycleLength !== null) {
                $nextPeriod = $startDate->copy()
                    ->addDays($effectiveCycleLength);
            }
        }

        // Mengambil jurnal pengguna
        $logs = DailyLog::where('user_id', Auth::id())
            ->orderBy('log_date', 'desc')
            ->get();

        $totalLogs = $logs->count();
        $latestLog = $logs->first();

        return view('dashboard', compact(
            'cycles',
            'totalCycles',
            'averageCycle',
            'averagePeriod',
            'effectiveCycleLength',
            'cycleSource',
            'effectivePeriodDuration',
            'periodSource',
            'latestCycle',
            'cycleDay',
            'nextPeriod',
            'totalLogs',
            'latestLog'
        ));
    }
}
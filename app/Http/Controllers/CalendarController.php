<?php

namespace App\Http\Controllers;

use App\Models\MenstrualCycle;
use App\Models\CycleSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // Validasi format bulan yang dipilih
        $validated = $request->validate([
            'month' => 'nullable|date_format:Y-m',
        ]);

        // Menentukan bulan yang ditampilkan
        $month = Carbon::createFromFormat(
            '!Y-m',
            $validated['month'] ?? now()->format('Y-m')
        );

        $monthStart = $month->copy()->startOfMonth();
        $monthEnd = $month->copy()->endOfMonth();

        // Mengambil seluruh riwayat menstruasi pengguna
        $allCycles = MenstrualCycle::where('user_id', Auth::id())
            ->orderBy('start_date', 'desc')
            ->get();

        // Mengambil catatan menstruasi yang berkaitan dengan bulan kalender
        $cycles = $allCycles->filter(function ($cycle) use ($monthStart, $monthEnd) {
            $end = $cycle->end_date
                ? Carbon::parse($cycle->end_date)
                : Carbon::today();

            return Carbon::parse($cycle->start_date)->lessThanOrEqualTo($monthEnd)
                && $end->greaterThanOrEqualTo($monthStart);
        });

        // Menghitung rata-rata panjang siklus aktual
        $sortedCycles = $allCycles->sortBy('start_date')->values();
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
        $periodDurations = $allCycles
            ->filter(fn ($cycle) => $cycle->end_date !== null)
            ->map(fn ($cycle) => Carbon::parse($cycle->start_date)
                ->diffInDays(Carbon::parse($cycle->end_date)) + 1);

        $averagePeriod = $periodDurations->count() > 0
            ? round($periodDurations->avg())
            : null;

        // Mengambil pengaturan manual pengguna
        $setting = CycleSetting::where('user_id', Auth::id())->first();

        // Mengutamakan data aktual, kemudian pengaturan manual
        $effectiveCycleLength = $averageCycle
            ?? $setting?->cycle_length;

        $effectivePeriodDuration = $averagePeriod
            ?? $setting?->period_duration;

        // Menghitung perkiraan menstruasi berikutnya
        $latestCycle = $allCycles->first();

        $predictedPeriodStart = null;
        $predictedPeriodEnd = null;

        if ($latestCycle && $effectiveCycleLength !== null) {
            $lastStartDate = Carbon::parse($latestCycle->start_date);

            if ($lastStartDate->lessThanOrEqualTo(Carbon::today())) {
                $predictedPeriodStart = $lastStartDate
                    ->copy()
                    ->addDays($effectiveCycleLength);

                $duration = $effectivePeriodDuration ?? 1;

                $predictedPeriodEnd = $predictedPeriodStart
                    ->copy()
                    ->addDays($duration - 1);
            }
        }

        // Menentukan awal dan akhir kalender
        $calendarStart = $monthStart->copy()
            ->startOfWeek(Carbon::SUNDAY);

        $calendarEnd = $monthEnd->copy()
            ->endOfWeek(Carbon::SATURDAY);

        // Membuat daftar tanggal kalender
        $calendarDays = [];

        $date = $calendarStart->copy();

        while ($date->lessThanOrEqualTo($calendarEnd)) {
            $calendarDays[] = $date->copy();
            $date->addDay();
        }

        // Navigasi bulan sebelumnya dan berikutnya
        $previousMonth = $month->copy()
            ->subMonth()
            ->format('Y-m');

        $nextMonth = $month->copy()
            ->addMonth()
            ->format('Y-m');

        return view('calendar.index', compact(
            'month',
            'cycles',
            'calendarDays',
            'previousMonth',
            'nextMonth',
            'predictedPeriodStart',
            'predictedPeriodEnd'
        ));
    }
}

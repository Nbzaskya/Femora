
@extends('layouts.app')

@section('title', 'Kalender Menstruasi - Femora')

@section('styles')
<style>
    .calendar-page {
        max-width: 1440px;
        margin: auto;
        padding: 32px 0 55px;
        animation: calendarEnter .55s ease both;
    }

    /* Header */
    .calendar-header {
        position: relative;
        overflow: hidden;
        padding: 30px 34px;
        margin-bottom: 25px;
        border: 1px solid rgba(201, 130, 159, .14);
        border-radius: 25px;
        background: linear-gradient(120deg, #fff8f7 0%, #f9eaf0 58%, #f0eafa 100%);
    }

    .calendar-header::after {
        content: "✿";
        position: absolute;
        right: 35px;
        top: -30px;
        font-size: 145px;
        line-height: 1;
        color: rgba(201, 130, 159, .12);
        transform: rotate(-15deg);
        pointer-events: none;
    }

    .calendar-eyebrow {
        display: inline-block;
        margin-bottom: 9px;
        color: var(--pink-dark, #a95e7e);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .calendar-header h2 {
        position: relative;
        z-index: 1;
        margin-bottom: 9px;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: clamp(25px, 4vw, 34px);
        font-weight: 700;
    }

    .calendar-header p {
        position: relative;
        z-index: 1;
        max-width: 520px;
        margin: 0;
        color: var(--muted, #8b7c83);
        font-size: 14px;
        line-height: 1.7;
    }

    /* Calendar panel */
    .calendar-panel {
        overflow: hidden;
        border: 1px solid var(--border-soft, #f0e5e9);
        border-radius: 23px;
        background: #fff;
        box-shadow: var(--shadow-soft, 0 10px 30px rgba(73, 58, 66, .06));
    }

    .calendar-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        padding: 24px 27px;
        border-bottom: 1px solid #f3e9ed;
    }

    .calendar-panel-title small {
        display: block;
        margin-bottom: 5px;
        color: var(--muted, #8b7c83);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .calendar-panel-title h4 {
        margin: 0;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: 23px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .calendar-navigation {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .calendar-nav-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        min-height: 39px;
        padding: 8px 13px;
        border: 1px solid #eee2e8;
        border-radius: 11px;
        background: #fff;
        color: #705b66;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .calendar-nav-btn:hover {
        border-color: #dba5ba;
        background: #fff4f7;
        color: #a95e7e;
        transform: translateY(-2px);
    }

    .calendar-nav-btn.current {
        border-color: transparent;
        background: #f8e6ed;
        color: #a95e7e;
    }

    .calendar-content {
        padding: 24px 27px 27px;
    }

    /* Calendar grid */
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 9px;
    }

    .calendar-heading {
        padding: 8px 0 13px;
        color: #a27c8d;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
        text-align: center;
        text-transform: uppercase;
    }

    .calendar-day {
        position: relative;
        display: flex;
        min-width: 0;
        min-height: 105px;
        flex-direction: column;
        align-items: center;
        gap: 7px;
        padding: 12px 5px 9px;
        overflow: hidden;
        border: 1px solid #f1e9ed;
        border-radius: 15px;
        background: #fffdfd;
        color: #584750;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .calendar-day:hover {
        z-index: 1;
        border-color: #dfb4c5;
        box-shadow: 0 7px 17px rgba(169, 94, 126, .10);
        transform: translateY(-3px);
    }

    .calendar-date-number {
        display: flex;
        width: 30px;
        height: 30px;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        font-size: 13px;
        font-weight: 700;
    }

    .calendar-day.other-month {
        border-color: #f5f1f2;
        background: #faf8f9;
        color: #c5b9bf;
    }

    .calendar-day.other-month .calendar-date-number {
        opacity: .55;
    }

    /* Actual period */
    .calendar-day.menstruation-day {
        border-color: #e6aabd;
        background: linear-gradient(145deg, #fff0f4, #f9dfe8);
        color: #82435d;
    }

    .calendar-day.menstruation-day .calendar-date-number {
        background: #c9829f;
        color: #fff;
    }

    /* Predicted period */
    .calendar-day.predicted-day {
        border-color: #c8b8e3;
        background: linear-gradient(145deg, #f8f4ff, #ece5f8);
        color: #665384;
    }

    .calendar-day.predicted-day .calendar-date-number {
        background: #b6a5d5;
        color: #fff;
    }

    /* Today */
    .calendar-day.today {
        outline: 2px solid #c9829f;
        outline-offset: -3px;
    }

    .calendar-day.today:not(.menstruation-day):not(.predicted-day) {
        background: #fff9fb;
    }

    .calendar-day.today:not(.menstruation-day):not(.predicted-day) .calendar-date-number {
        background: #f8e6ed;
        color: #a95e7e;
    }

    .calendar-day-label {
        display: inline-block;
        max-width: 100%;
        padding: 4px 7px;
        overflow: hidden;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 800;
        text-align: center;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .menstruation-day .calendar-day-label {
        background: rgba(201, 130, 159, .16);
        color: #96536f;
    }

    .predicted-day .calendar-day-label {
        background: rgba(182, 165, 213, .25);
        color: #75619b;
    }

    .today-label {
        color: #a95e7e;
        font-size: 9px;
        font-weight: 800;
    }

    /* Legend */
    .calendar-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 13px 22px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #f3e9ed;
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #83747c;
        font-size: 11px;
        font-weight: 600;
    }

    .legend-color {
        width: 13px;
        height: 13px;
        flex-shrink: 0;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .legend-menstruation {
        border-color: #e6aabd;
        background: #f8dfe8;
    }

    .legend-predicted {
        border-color: #c8b8e3;
        background: #ece5f8;
    }

    .legend-today {
        border: 2px solid #c9829f;
        background: #fff;
    }

    /* Information */
    .calendar-info {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-top: 22px;
        padding: 22px 24px;
        border: 1px solid #eee5f5;
        border-radius: 19px;
        background: linear-gradient(120deg, #faf7ff, #fff8fa);
    }

    .calendar-info-icon {
        display: flex;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        justify-content: center;
        align-items: center;
        border-radius: 13px;
        background: #eee7f8;
        color: #8b75b1;
        font-size: 18px;
    }

    .calendar-info h6 {
        margin: 1px 0 7px;
        color: #5e4d70;
        font-size: 14px;
        font-weight: 800;
    }

    .calendar-info p {
        margin: 0;
        color: #82758d;
        font-size: 12px;
        line-height: 1.8;
    }

    @keyframes calendarEnter {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .calendar-page {
            padding-top: 20px;
        }

        .calendar-header {
            padding: 24px;
        }

        .calendar-header::after {
            right: 12px;
            font-size: 105px;
        }

        .calendar-panel-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
        }

        .calendar-content {
            padding: 17px;
        }

        .calendar-grid {
            gap: 5px;
        }

        .calendar-day {
            min-height: 83px;
            gap: 5px;
            padding: 8px 2px;
            border-radius: 10px;
        }

        .calendar-date-number {
            width: 26px;
            height: 26px;
            font-size: 11px;
        }

        .calendar-day-label {
            padding: 3px 4px;
            font-size: 8px;
        }

        .calendar-heading {
            font-size: 9px;
        }
    }

    @media (max-width: 480px) {
        .calendar-navigation {
            width: 100%;
            justify-content: space-between;
            gap: 5px;
        }

        .calendar-nav-btn {
            min-height: 36px;
            padding: 7px 9px;
            font-size: 10px;
        }

        .calendar-day {
            min-height: 68px;
            gap: 4px;
            padding: 6px 1px;
        }

        .calendar-date-number {
            width: 23px;
            height: 23px;
            font-size: 10px;
        }

        .calendar-day-label {
            max-width: 95%;
            font-size: 7px;
        }

        .today-label {
            font-size: 7px;
        }

        .calendar-legend {
            gap: 11px 14px;
        }

        .legend-item {
            font-size: 10px;
        }

        .calendar-info {
            padding: 17px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .calendar-page,
        .calendar-day,
        .calendar-nav-btn {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid calendar-page">

    {{-- Header --}}
    <div class="calendar-header">
        <span class="calendar-eyebrow">Femora · Your cycle journey</span>
        <h2>Kalender Menstruasi</h2>
        <p>
            Kenali pola siklus tubuhmu melalui catatan menstruasi.
            Setiap tanggal membantu kamu memahami perjalanan siklusmu.
        </p>
    </div>

    {{-- Calendar --}}
    <div class="calendar-panel">

        {{-- Calendar heading and navigation --}}
        <div class="calendar-panel-header">

            <div class="calendar-panel-title">
                <small>Kalender siklusmu</small>
                <h4>{{ $month->translatedFormat('F Y') }}</h4>
            </div>

            <div class="calendar-navigation">

                <a href="{{ route('calendar.index', ['month' => $previousMonth]) }}"
                   class="calendar-nav-btn"
                   aria-label="Bulan sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                    <span>Sebelumnya</span>
                </a>

                <a href="{{ route('calendar.index', ['month' => now()->format('Y-m')]) }}"
                   class="calendar-nav-btn current">
                    <i class="bi bi-calendar-heart"></i>
                    <span>Bulan Ini</span>
                </a>

                <a href="{{ route('calendar.index', ['month' => $nextMonth]) }}"
                   class="calendar-nav-btn"
                   aria-label="Bulan berikutnya">
                    <span>Berikutnya</span>
                    <i class="bi bi-chevron-right"></i>
                </a>

            </div>
        </div>

        <div class="calendar-content">

            <div class="calendar-grid">

                {{-- Nama hari --}}
                @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                    <div class="calendar-heading">
                        {{ $day }}
                    </div>
                @endforeach

                {{-- Tanggal kalender --}}
                @foreach ($calendarDays as $date)

                    @php
                        $isCurrentMonth = $date->format('Y-m') === $month->format('Y-m');
                        $isToday = $date->isToday();

                        // Memeriksa menstruasi aktual
                        $isMenstruation = $cycles->contains(function ($cycle) use ($date) {
                            $start = $cycle->start_date->copy()->startOfDay();

                            $end = $cycle->end_date
                                ? $cycle->end_date->copy()->startOfDay()
                                : now()->startOfDay();

                            return $date->between($start, $end);
                        });

                        // Memeriksa perkiraan menstruasi
                        $isPredicted = $predictedPeriodStart
                            && $predictedPeriodEnd
                            && $date->between(
                                $predictedPeriodStart->copy()->startOfDay(),
                                $predictedPeriodEnd->copy()->startOfDay()
                            );
                    @endphp

                    <div class="calendar-day
                        {{ !$isCurrentMonth ? 'other-month' : '' }}
                        {{ $isPredicted && !$isMenstruation ? 'predicted-day' : '' }}
                        {{ $isMenstruation ? 'menstruation-day' : '' }}
                        {{ $isToday ? 'today' : '' }}">

                        <span class="calendar-date-number">
                            {{ $date->day }}
                        </span>

                        @if ($isCurrentMonth && $isMenstruation)
                            <span class="calendar-day-label">
                                Menstruasi
                            </span>
                        @elseif ($isCurrentMonth && $isPredicted)
                            <span class="calendar-day-label">
                                Perkiraan
                            </span>
                        @endif

                        @if ($isToday && $isCurrentMonth)
                            <span class="today-label">Hari ini</span>
                        @endif

                    </div>

                @endforeach

            </div>

            {{-- Legend --}}
            <div class="calendar-legend">

                <div class="legend-item">
                    <span class="legend-color legend-menstruation"></span>
                    <span>Menstruasi tercatat</span>
                </div>

                <div class="legend-item">
                    <span class="legend-color legend-predicted"></span>
                    <span>Perkiraan menstruasi</span>
                </div>

                <div class="legend-item">
                    <span class="legend-color legend-today"></span>
                    <span>Hari ini</span>
                </div>

            </div>

        </div>
    </div>

    {{-- Information --}}
    <div class="calendar-info">

        <div class="calendar-info-icon">
            <i class="bi bi-info-circle"></i>
        </div>

        <div>
            <h6>Memahami kalender siklusmu</h6>
            <p>
                Warna merah muda menunjukkan periode menstruasi yang sudah tercatat.
                Warna ungu menunjukkan perkiraan periode menstruasi berikutnya.
                Perkiraan dihitung berdasarkan riwayat menstruasi atau pengaturan
                siklus manual apabila data aktual belum mencukupi. Hasil prediksi
                hanya berupa estimasi dan bukan tanggal yang pasti.
            </p>
        </div>

    </div>

</div>
@endsection
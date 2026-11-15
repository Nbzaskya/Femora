
@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .dashboard-page {
        max-width: 1440px;
        margin: auto;
        padding-top: 38px;
        padding-bottom: 55px;
    }

    /* Welcome section */
    .welcome-hero {
        position: relative;
        overflow: hidden;
        padding: 35px 38px;
        border-radius: 26px;
        background: linear-gradient(115deg, #F8DDE5 0%, #F9EAF0 55%, #E9E2F5 100%);
        box-shadow: 0 10px 30px rgba(147, 91, 119, 0.08);
        animation: dashboardEnter .65s ease both;
    }

    .welcome-hero::before,
    .welcome-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-hero::before {
        width: 230px;
        height: 230px;
        right: 8%;
        top: -125px;
        background: rgba(255,255,255,.28);
    }

    .welcome-hero::after {
        width: 150px;
        height: 150px;
        right: -25px;
        bottom: -85px;
        background: rgba(255,255,255,.32);
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-date {
        color: #94677D;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .welcome-title {
        margin: 12px 0 8px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 4vw, 38px);
        font-weight: 700;
    }

    .welcome-description {
        color: #795D6B;
        max-width: 550px;
        margin-bottom: 22px;
        line-height: 1.7;
    }

    .welcome-decoration {
        position: absolute;
        right: 7%;
        top: 50%;
        transform: translateY(-50%);
        font-size: 92px;
        opacity: .55;
        animation: floatDecoration 4s ease-in-out infinite;
    }

    /* Section heading */
    .section-heading {
        margin: 34px 0 17px;
    }

    .section-heading h4 {
        font-family: 'Playfair Display', serif;
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .section-subtitle {
        color: var(--muted);
        font-size: 13px;
        margin: 0;
    }

    /* Statistics cards */
    .stat-card {
        position: relative;
        height: 100%;
        min-height: 180px;
        padding: 23px;
        border: 1px solid rgba(240, 227, 233, .9);
        border-radius: 21px;
        background: rgba(255,255,255,.92);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease;
        animation: dashboardEnter .7s ease both;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 105px;
        height: 105px;
        right: -35px;
        bottom: -40px;
        border-radius: 50%;
        background: var(--card-decoration, #F8DDE5);
        opacity: .55;
    }

    .stat-card.pink {
        --card-decoration: #F8DDE5;
    }

    .stat-card.purple {
        --card-decoration: #E9E2F5;
    }

    .stat-card.cream {
        --card-decoration: #F8EBDD;
    }

    .stat-card.green {
        --card-decoration: #E3F0E7;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 43px;
        height: 43px;
        border-radius: 14px;
        background: var(--icon-background, #F8DDE5);
        font-size: 20px;
    }

    .pink .stat-icon {
        --icon-background: #FBE9EF;
    }

    .purple .stat-icon {
        --icon-background: #F0EBF8;
    }

    .cream .stat-icon {
        --icon-background: #FBF1E6;
    }

    .green .stat-icon {
        --icon-background: #EAF4ED;
    }

    .stat-label {
        color: #927E88;
        font-size: 13px;
        font-weight: 600;
        margin: 0;
    }

    .stat-value {
        color: var(--text);
        font-family: 'Playfair Display', serif;
        font-size: clamp(24px, 3vw, 30px);
        font-weight: 700;
        margin: 0 0 7px;
        overflow-wrap: anywhere;
    }

    .stat-description {
        color: #9B8992;
        font-size: 11px;
        line-height: 1.6;
        margin: 0;
        max-width: 95%;
    }

    /* Cycle progress */
    .cycle-panel {
        height: 100%;
        padding: 25px;
        background: #FFFFFF;
        border: 1px solid var(--border-soft);
        border-radius: 22px;
        box-shadow: var(--shadow-soft);
    }

    .cycle-progress {
        --progress: 0%;
        width: 142px;
        height: 142px;
        margin: 20px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: conic-gradient(
            #C9829F var(--progress),
            #F6E8ED var(--progress)
        );
        transition: background 1s ease;
    }

    .cycle-progress-inner {
        width: 116px;
        height: 116px;
        border-radius: 50%;
        background: #FFFFFF;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .cycle-progress-number {
        font-family: 'Playfair Display', serif;
        font-size: 34px;
        font-weight: 700;
        color: var(--text);
        line-height: 1.1;
    }

    .cycle-progress-label {
        font-size: 11px;
        color: var(--muted);
        margin-top: 5px;
    }

    .cycle-note {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
        text-align: center;
    }

    /* Information panels */
    .info-panel {
        height: 100%;
        padding: 25px;
        border: 1px solid var(--border-soft);
        border-radius: 22px;
        background: #FFFFFF;
        box-shadow: var(--shadow-soft);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .info-panel:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    .panel-heading {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 20px;
    }

    .panel-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: var(--pink-soft);
        font-size: 19px;
        flex-shrink: 0;
    }

    .panel-heading h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin: 0;
        font-size: 19px;
    }

    .panel-heading small {
        color: var(--muted);
        font-size: 11px;
    }

    .record-date {
        padding: 15px;
        border-radius: 14px;
        background: #FFF8FA;
        color: var(--text);
        font-weight: 600;
        line-height: 1.7;
    }

    .journal-detail {
        padding-top: 15px;
        border-top: 1px solid var(--border-soft);
    }

    .journal-detail p {
        font-size: 13px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .empty-state {
        padding: 22px 15px;
        border-radius: 15px;
        background: #FFFAFC;
        text-align: center;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    /* Quick actions */
    .quick-action {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        border-radius: 15px;
        background: #FFFFFF;
        border: 1px solid var(--border-soft);
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
        transition: all .25s ease;
    }

    .quick-action:hover {
        color: var(--pink-dark);
        background: #FFF4F7;
        border-color: #E8C2D0;
        transform: translateY(-3px);
    }

    .quick-action-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: var(--pink-soft);
        font-size: 17px;
    }

    .dashboard-footer {
        text-align: center;
        color: #A18E97;
        font-size: 11px;
        margin-top: 38px;
    }

    @keyframes dashboardEnter {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes floatDecoration {
        0%, 100% {
            transform: translateY(-50%);
        }
        50% {
            transform: translateY(calc(-50% - 10px));
        }
    }

    @media (max-width: 767.98px) {
        .dashboard-page {
            padding-top: 22px;
        }

        .welcome-hero {
            padding: 27px 23px;
        }

        .welcome-decoration {
            right: 5%;
            top: 18px;
            transform: none;
            font-size: 55px;
            opacity: .3;
        }

        .welcome-description {
            max-width: 85%;
        }

        .stat-card {
            min-height: 165px;
            padding: 19px;
        }

        .info-panel,
        .cycle-panel {
            padding: 20px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .welcome-decoration,
        .stat-card,
        .dashboard-card {
            animation: none !important;
        }

        .stat-card,
        .info-panel,
        .quick-action {
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
@php
    $cycleProgress = ($cycleDay !== null && $effectiveCycleLength)
        ? min(100, round(($cycleDay / $effectiveCycleLength) * 100))
        : 0;
@endphp

<div class="container dashboard-page">

    {{-- Welcome Hero --}}
    <section class="welcome-hero mb-4">
        <div class="welcome-content">
            <div class="welcome-date">
                {{ now()->locale('id')->translatedFormat('l, d F Y') }}
            </div>

            <h1 class="welcome-title">
                Halo, {{ Auth::user()->name }}!
            </h1>

            <p class="welcome-description">
                Setiap hari adalah kesempatan untuk lebih memahami tubuhmu.
                Yuk, kenali pola siklus dan kondisi dirimu bersama Femora.
            </p>

            <a href="{{ route('journal.index') }}"
               class="btn btn-femora">
                ✨ Catat Kondisimu
            </a>
        </div>

        <div class="welcome-decoration" aria-hidden="true">🌷</div>
    </section>

    {{-- Statistik utama --}}
    <div class="section-heading">
        <h4>Ringkasan Siklusmu</h4>
        <p class="section-subtitle">
            Informasi berdasarkan catatan yang sudah kamu masukkan.
        </p>
    </div>

    <div class="row g-3">

        {{-- Hari siklus --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card pink">
                <div class="stat-top">
                    <p class="stat-label">Hari Siklus Saat Ini</p>
                    <div class="stat-icon">🌸</div>
                </div>

                @if ($cycleDay !== null)
                    <h3 class="stat-value">{{ $cycleDay }} hari</h3>
                    <p class="stat-description">
                        Dihitung sejak hari pertama menstruasi terakhir.
                    </p>
                @else
                    <h3 class="stat-value">Belum tersedia</h3>
                    <p class="stat-description">
                        Tambahkan catatan menstruasi untuk melihat hari siklus.
                    </p>
                @endif
            </div>
        </div>

        {{-- Periode berikutnya --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card purple">
                <div class="stat-top">
                    <p class="stat-label">Perkiraan Periode Berikutnya</p>
                    <div class="stat-icon">🗓️</div>
                </div>

                @if ($nextPeriod !== null)
                    <h3 class="stat-value">
                        {{ $nextPeriod->format('d M Y') }}
                    </h3>
                    <p class="stat-description">
                        Sumber: {{ $cycleSource }}. Tanggal ini merupakan
                        perkiraan, bukan kepastian.
                    </p>
                @else
                    <h3 class="stat-value">Belum tersedia</h3>
                    <p class="stat-description">
                        Tambahkan riwayat menstruasi atau pengaturan siklus.
                    </p>
                @endif
            </div>
        </div>

        {{-- Riwayat --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card cream">
                <div class="stat-top">
                    <p class="stat-label">Riwayat Menstruasi</p>
                    <div class="stat-icon">📖</div>
                </div>

                <h3 class="stat-value">{{ $totalCycles }} catatan</h3>
                <p class="stat-description">
                    Total catatan menstruasi yang tersimpan.
                </p>
            </div>
        </div>

        {{-- Rata-rata siklus --}}
        <div class="col-12 col-md-6 col-xl-6">
            <div class="stat-card green">
                <div class="stat-top">
                    <p class="stat-label">Rata-rata Panjang Siklus</p>
                    <div class="stat-icon">🔄</div>
                </div>

                @if ($averageCycle !== null)
                    <h3 class="stat-value">{{ $averageCycle }} hari</h3>
                    <p class="stat-description">
                        Dihitung dari riwayat tanggal mulai menstruasi.
                    </p>
                @elseif ($effectiveCycleLength !== null)
                    <h3 class="stat-value">{{ $effectiveCycleLength }} hari</h3>
                    <p class="stat-description">
                        Berdasarkan pengaturan manual, belum dari rata-rata aktual.
                    </p>
                @else
                    <h3 class="stat-value">Belum tersedia</h3>
                    <p class="stat-description">
                        Atur panjang siklus atau tambahkan riwayat menstruasi.
                    </p>
                @endif
            </div>
        </div>

        {{-- Durasi --}}
        <div class="col-12 col-md-6 col-xl-6">
            <div class="stat-card purple">
                <div class="stat-top">
                    <p class="stat-label">Durasi Menstruasi</p>
                    <div class="stat-icon">💗</div>
                </div>

                @if ($averagePeriod !== null)
                    <h3 class="stat-value">{{ $averagePeriod }} hari</h3>
                    <p class="stat-description">
                        Rata-rata berdasarkan catatan dengan tanggal selesai.
                    </p>
                @elseif ($effectivePeriodDuration !== null)
                    <h3 class="stat-value">{{ $effectivePeriodDuration }} hari</h3>
                    <p class="stat-description">
                        Berdasarkan pengaturan manual, belum dari rata-rata aktual.
                    </p>
                @else
                    <h3 class="stat-value">Belum tersedia</h3>
                    <p class="stat-description">
                        Atur durasi menstruasi atau lengkapi catatanmu.
                    </p>
                @endif
            </div>
        </div>

    </div>

    {{-- Visualisasi siklus dan menstruasi terakhir --}}
    <div class="section-heading">
        <h4>Perjalanan Siklusmu</h4>
        <p class="section-subtitle">
            Lihat ringkasan siklus dan catatan menstruasi terakhir.
        </p>
    </div>

    <div class="row g-3">

        {{-- Progress --}}
        <div class="col-12 col-lg-4">
            <div class="cycle-panel">
                <h5 class="fw-bold text-center mb-1"
                    style="font-family: 'Playfair Display', serif;">
                    Progres Siklus
                </h5>

                <p class="section-subtitle text-center">
                    Berdasarkan panjang siklus yang tersedia
                </p>

                <div class="cycle-progress"
                     style="--progress: {{ $cycleProgress }}%;">
                    <div class="cycle-progress-inner">
                        @if ($cycleDay !== null)
                            <span class="cycle-progress-number">
                                {{ $cycleDay }}
                            </span>
                            <span class="cycle-progress-label">Hari siklus</span>
                        @else
                            <span class="cycle-progress-number">—</span>
                            <span class="cycle-progress-label">Belum ada data</span>
                        @endif
                    </div>
                </div>

                @if ($cycleDay !== null && $effectiveCycleLength !== null)
                    <p class="cycle-note">
                        {{ $cycleDay }} dari {{ $effectiveCycleLength }} hari
                        berdasarkan panjang siklus yang digunakan.
                        Visualisasi ini bukan penentu fase biologis.
                    </p>
                @else
                    <p class="cycle-note">
                        Data progres akan tersedia setelah informasi siklus
                        tercatat atau pengaturan siklus diisi.
                    </p>
                @endif
            </div>
        </div>

        {{-- Menstruasi terakhir --}}
        <div class="col-12 col-lg-8">
            <div class="info-panel">
                <div class="panel-heading">
                    <div class="panel-icon">🌷</div>
                    <div>
                        <h5>Menstruasi Terakhir</h5>
                        <small>Catatan periode yang paling baru</small>
                    </div>
                </div>

                @if ($latestCycle)
                    <div class="record-date">
                        {{ $latestCycle->start_date->format('d M Y') }}
                        <span class="text-muted">—</span>
                        {{ $latestCycle->end_date
                            ? $latestCycle->end_date->format('d M Y')
                            : 'Masih berlangsung' }}
                    </div>

                    @if ($latestCycle->notes)
                        <p class="text-muted mt-3 mb-0"
                           style="font-size: 13px; line-height: 1.7;">
                            {{ $latestCycle->notes }}
                        </p>
                    @endif
                @else
                    <div class="empty-state">
                        <div style="font-size: 28px; margin-bottom: 8px;">🌼</div>
                        Belum ada catatan menstruasi.
                        Mulai catat periode pertamamu untuk melihat ringkasannya.
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Jurnal harian --}}
    <div class="section-heading">
        <h4>Ruang Ceritamu</h4>
        <p class="section-subtitle">
            Catatan kecil tentang kondisi dan perasaanmu setiap hari.
        </p>
    </div>

    <div class="info-panel">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <div class="panel-heading mb-0">
                <div class="panel-icon">📔</div>
                <div>
                    <h5>Jurnal Harian</h5>
                    <small>
                        {{ $totalLogs }} catatan tersimpan · Menampilkan catatan terbaru
                    </small>
                </div>
            </div>

            <a href="{{ route('journal.index') }}"
               class="btn btn-outline-secondary btn-sm rounded-3 px-3">
                Lihat Jurnal →
            </a>
        </div>

        @if ($latestLog)
            <div class="journal-detail">
                <p class="fw-bold mb-2">
                    {{ $latestLog->log_date->format('d M Y') }}
                </p>

                @if ($latestLog->mood)
                    <p class="mb-2">
                        <strong>Mood:</strong> {{ $latestLog->mood }}
                    </p>
                @endif

                @if (!empty($latestLog->symptoms))
                    <p class="mb-2">
                        <strong>Gejala:</strong>
                        {{ implode(', ', $latestLog->symptoms) }}
                    </p>
                @endif

                @if ($latestLog->notes)
                    <p class="text-muted mb-0">
                        {{ $latestLog->notes }}
                    </p>
                @endif
            </div>
        @else
            <div class="empty-state">
                <div style="font-size: 28px; margin-bottom: 8px;">📝</div>
                Belum ada jurnal harian.
                Yuk, mulai catat kondisi dan perasaanmu hari ini.
            </div>
        @endif
    </div>

    {{-- Aksi cepat --}}
    <div class="section-heading">
        <h4>Akses Cepat</h4>
        <p class="section-subtitle">
            Langsung menuju fitur yang ingin kamu gunakan.
        </p>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <a href="{{ route('menstrual.index') }}" class="quick-action">
                <span class="quick-action-icon">🌸</span>
                <span>Kelola Catatan Menstruasi</span>
                <span class="ms-auto">→</span>
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('calendar.index') }}" class="quick-action">
                <span class="quick-action-icon">🗓️</span>
                <span>Lihat Kalender Siklus</span>
                <span class="ms-auto">→</span>
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('journal.index') }}" class="quick-action">
                <span class="quick-action-icon">📔</span>
                <span>Tambah Jurnal Harian</span>
                <span class="ms-auto">→</span>
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('settings.cycle') }}" class="quick-action">
                <span class="quick-action-icon">⚙️</span>
                <span>Pengaturan Siklus</span>
                <span class="ms-auto">→</span>
            </a>
        </div>
    </div>

    <div class="dashboard-footer">
        Femora · Understand Your Cycle, Embrace Yourself.
    </div>

</div>
@endsection
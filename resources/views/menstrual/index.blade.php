
@extends('layouts.app')

@section('title', 'Catatan Menstruasi')

@section('styles')
<style>
    .menstrual-page {
        max-width: 1200px;
        margin: auto;
        padding-top: 35px;
        padding-bottom: 55px;
    }

    /* Page heading */
    .menstrual-heading {
        margin-bottom: 28px;
        animation: menstrualEnter .5s ease both;
    }

    .menstrual-eyebrow {
        color: var(--pink-dark);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .menstrual-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 4vw, 35px);
        font-weight: 700;
        color: var(--text);
        margin-bottom: 8px;
    }

    .menstrual-description {
        color: var(--muted);
        font-size: 14px;
        margin: 0;
        line-height: 1.7;
    }

    /* Intro banner */
    .menstrual-banner {
        position: relative;
        overflow: hidden;
        padding: 23px 27px;
        margin-bottom: 25px;
        border-radius: 21px;
        background: linear-gradient(110deg, #F8DDE5, #F9EDF1 60%, #E9E2F5);
        animation: menstrualEnter .6s ease both;
    }

    .menstrual-banner::after {
        content: "🌷";
        position: absolute;
        right: 35px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 62px;
        opacity: .55;
        animation: menstrualFloat 4s ease-in-out infinite;
    }

    .menstrual-banner-content {
        position: relative;
        z-index: 1;
        max-width: 75%;
    }

    .menstrual-banner h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .menstrual-banner p {
        color: #795D6B;
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }

    /* General panels */
    .menstrual-panel {
        height: 100%;
        padding: 26px;
        background: #FFFFFF;
        border: 1px solid var(--border-soft);
        border-radius: 21px;
        box-shadow: var(--shadow-soft);
        animation: menstrualEnter .65s ease both;
    }

    .menstrual-panel-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
    }

    .menstrual-panel-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        background: #FBE9EF;
        color: var(--pink-dark);
        font-size: 19px;
    }

    .menstrual-panel-heading h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 19px;
        margin: 0 0 3px;
    }

    .menstrual-panel-heading small {
        color: var(--muted);
        font-size: 11px;
    }

    /* Form */
    .menstrual-form .form-label {
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .menstrual-form .form-control {
        min-height: 46px;
        border: 1px solid #EADDE3;
        border-radius: 12px;
        background-color: #FFFCFD;
        color: var(--text);
        font-size: 13px;
        padding: 11px 13px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .menstrual-form textarea.form-control {
        min-height: 105px;
        resize: vertical;
    }

    .menstrual-form .form-control:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 4px rgba(201, 130, 159, .12);
        background: #FFFFFF;
    }

    .form-hint {
        display: block;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
        margin-top: 7px;
    }

    .menstrual-submit {
        width: 100%;
        min-height: 46px;
        margin-top: 5px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
    }

    /* Alerts */
    .menstrual-alert {
        border: 0;
        border-radius: 13px;
        font-size: 13px;
        padding: 14px 17px;
        margin-bottom: 20px;
    }

    /* Filter */
    .filter-box {
        padding: 17px;
        margin-bottom: 20px;
        border-radius: 15px;
        background: #FFFAFC;
        border: 1px solid #F1E5EA;
    }

    .filter-box .form-label {
        color: var(--text);
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .filter-box .form-select {
        min-height: 43px;
        border: 1px solid #EADDE3;
        border-radius: 11px;
        background-color: #FFFFFF;
        font-size: 12px;
        color: var(--text);
    }

    .filter-box .form-select:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 3px rgba(201, 130, 159, .10);
    }

    .filter-submit,
    .filter-reset {
        min-height: 43px;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 600;
        padding-left: 17px;
        padding-right: 17px;
    }

    .record-count {
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 15px;
    }

    /* History cards */
    .cycle-record {
        position: relative;
        padding: 19px;
        margin-bottom: 12px;
        border: 1px solid #F0E5E9;
        border-radius: 16px;
        background: #FFFFFF;
        transition: transform .25s ease, box-shadow .25s ease,
                    border-color .25s ease;
    }

    .cycle-record:last-child {
        margin-bottom: 0;
    }

    .cycle-record:hover {
        transform: translateY(-3px);
        border-color: #E8C6D3;
        box-shadow: 0 9px 22px rgba(147, 91, 119, .08);
    }

    .cycle-record-date {
        color: var(--text);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .cycle-record-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 20px;
        background: #FCEEF3;
        color: #A75E7C;
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .cycle-record-status.ongoing {
        background: #F3EDF9;
        color: #80649B;
    }

    .cycle-record-notes {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .cycle-record-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
    }

    .cycle-record-actions .btn {
        min-width: 66px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 600;
        padding: 7px 11px;
    }

    /* Empty state */
    .menstrual-empty {
        padding: 40px 20px;
        text-align: center;
        border: 1px dashed #E8D5DE;
        border-radius: 16px;
        background: #FFFAFC;
    }

    .menstrual-empty-icon {
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 20px;
        background: #FBE9EF;
        font-size: 29px;
    }

    .menstrual-empty h6 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .menstrual-empty p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
    }

    .menstrual-footer {
        text-align: center;
        color: #A18E97;
        font-size: 11px;
        margin-top: 35px;
    }

    @keyframes menstrualEnter {
        from {
            opacity: 0;
            transform: translateY(13px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes menstrualFloat {
        0%, 100% {
            transform: translateY(-50%);
        }
        50% {
            transform: translateY(calc(-50% - 8px));
        }
    }

    @media (max-width: 767.98px) {
        .menstrual-page {
            padding-top: 22px;
        }

        .menstrual-banner {
            padding: 21px;
        }

        .menstrual-banner::after {
            right: 13px;
            font-size: 43px;
            opacity: .3;
        }

        .menstrual-banner-content {
            max-width: 85%;
        }

        .menstrual-panel {
            padding: 20px;
        }

        .cycle-record {
            padding: 16px;
        }

        .cycle-record-actions {
            width: 100%;
            margin-top: 12px;
        }

        .cycle-record-actions .btn {
            flex: 1;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .menstrual-banner::after,
        .menstrual-heading,
        .menstrual-panel {
            animation: none !important;
        }

        .cycle-record {
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container menstrual-page">

    {{-- Heading --}}
    <div class="menstrual-heading">
        <div class="menstrual-eyebrow">Femora · Menstrual tracker</div>
        <h1 class="menstrual-title">Catatan Menstruasi</h1>
        <p class="menstrual-description">
            Kenali pola siklusmu dengan mencatat setiap periode menstruasi.
        </p>
    </div>

    {{-- Banner --}}
    <section class="menstrual-banner">
        <div class="menstrual-banner-content">
            <h5>Kenali pola tubuhmu, satu catatan setiap waktu.</h5>
            <p>
                Catatan yang konsisten dapat membantumu melihat pola
                siklus dari waktu ke waktu.
            </p>
        </div>
    </section>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success menstrual-alert" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation summary --}}
    @if ($errors->any())
        <div class="alert alert-danger menstrual-alert" role="alert">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Form tambah catatan --}}
        <div class="col-12 col-lg-5">
            <div class="menstrual-panel">
                <div class="menstrual-panel-heading">
                    <div class="menstrual-panel-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div>
                        <h5>Tambah Catatan</h5>
                        <small>Isi informasi periode menstruasimu</small>
                    </div>
                </div>

                <form action="{{ route('menstrual.store') }}"
                      method="POST"
                      class="menstrual-form">
                    @csrf

                    <div class="mb-3">
                        <label for="start_date" class="form-label">
                            Tanggal Mulai
                        </label>
                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >

                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">
                            Tanggal Selesai
                        </label>
                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}"
                            min="{{ old('start_date') }}"
                            max="{{ date('Y-m-d') }}"
                        >

                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="form-hint">
                            Kosongkan jika menstruasi masih berlangsung.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">
                            Catatan <span class="text-muted fw-normal">(Opsional)</span>
                        </label>
                        <textarea
                            id="notes"
                            name="notes"
                            class="form-control @error('notes') is-invalid @enderror"
                            rows="3"
                            placeholder="Misalnya, kondisi atau hal yang ingin kamu ingat..."
                        >{{ old('notes') }}</textarea>

                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-femora menstrual-submit">
                        <i class="bi bi-bookmark-heart me-2"></i>
                        Simpan Catatan
                    </button>
                </form>
            </div>
        </div>

        {{-- Riwayat menstruasi --}}
        <div class="col-12 col-lg-7">
            <div class="menstrual-panel">
                <div class="menstrual-panel-heading">
                    <div class="menstrual-panel-icon">
                        <i class="bi bi-calendar-heart"></i>
                    </div>
                    <div>
                        <h5>Riwayat Menstruasi</h5>
                        <small>Lihat kembali catatan periode sebelumnya</small>
                    </div>
                </div>

                {{-- Filter bulan dan tahun --}}
                <form action="{{ route('menstrual.index') }}"
                      method="GET"
                      class="filter-box">

                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <label for="month" class="form-label">
                                Bulan
                            </label>
                            <select name="month" id="month" class="form-select">
                                <option value="">Semua Bulan</option>

                                @foreach ([
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                ] as $number => $monthName)
                                    <option value="{{ $number }}"
                                        @selected((string) ($validated['month'] ?? '') === (string) $number)>
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="year" class="form-label">
                                Tahun
                            </label>
                            <select name="year" id="year" class="form-select">
                                <option value="">Semua Tahun</option>

                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        @selected((string) ($validated['year'] ?? '') === (string) $year)>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-3 d-flex align-items-end gap-2">
                            <button type="submit"
                                    class="btn btn-femora filter-submit flex-grow-1">
                                <i class="bi bi-funnel me-1"></i>
                                Filter
                            </button>

                            <a href="{{ route('menstrual.index') }}"
                               class="btn btn-outline-secondary filter-reset">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <p class="record-count">
                    <i class="bi bi-journal-text me-1"></i>
                    Menampilkan {{ $cycles->count() }} catatan menstruasi.
                </p>

                @forelse ($cycles as $cycle)
                    <article class="cycle-record">
                        <div class="d-flex justify-content-between
                                    align-items-start flex-wrap gap-2">

                            <div class="flex-grow-1">
                                <div class="cycle-record-date">
                                    <i class="bi bi-calendar3 me-2"
                                       style="color: var(--pink-dark);"></i>
                                    {{ $cycle->start_date->format('d M Y') }}
                                    <span class="text-muted mx-1">—</span>
                                    {{ $cycle->end_date
                                        ? $cycle->end_date->format('d M Y')
                                        : 'Masih berlangsung' }}
                                </div>

                                @if ($cycle->end_date)
                                    <span class="cycle-record-status">
                                        <i class="bi bi-check-circle"></i>
                                        Selesai
                                    </span>
                                @else
                                    <span class="cycle-record-status ongoing">
                                        <i class="bi bi-clock"></i>
                                        Sedang berlangsung
                                    </span>
                                @endif

                                @if ($cycle->notes)
                                    <p class="cycle-record-notes">
                                        {{ $cycle->notes }}
                                    </p>
                                @endif
                            </div>

                            <div class="cycle-record-actions">
                                <a href="{{ route('menstrual.edit', $cycle->id) }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil me-1"></i>
                                    Edit
                                </a>

                                <form action="{{ route('menstrual.destroy', $cycle->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="menstrual-empty">
                        <div class="menstrual-empty-icon">🌷</div>
                        <h6>Belum Ada Catatan</h6>
                        <p>
                            Belum ada riwayat menstruasi pada pilihan filter ini.
                            Tambahkan catatan baru atau ubah filter untuk melihat
                            catatan lainnya.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="menstrual-footer">
        Femora · Understand Your Cycle, Embrace Yourself.
    </div>

</div>
@endsection
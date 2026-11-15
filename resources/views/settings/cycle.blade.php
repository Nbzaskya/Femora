@extends('layouts.app')

@section('title', 'Pengaturan Siklus - Femora')

@section('styles')
<style>
    .settings-page {
        max-width: 950px;
        margin: auto;
        padding: 32px 0 55px;
        animation: settingsEnter .5s ease both;
    }

    /* Header */
    .settings-hero {
        position: relative;
        overflow: hidden;
        padding: 29px 32px;
        margin-bottom: 25px;
        border: 1px solid rgba(201, 130, 159, .15);
        border-radius: 24px;
        background: linear-gradient(120deg, #fff8f7, #f9eaf0 60%, #f0eafa);
    }

    .settings-hero::after {
        content: "✿";
        position: absolute;
        top: -35px;
        right: 30px;
        color: rgba(201, 130, 159, .12);
        font-size: 145px;
        pointer-events: none;
    }

    .settings-eyebrow {
        display: inline-block;
        margin-bottom: 9px;
        color: var(--pink-dark, #a95e7e);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .settings-hero h2 {
        position: relative;
        z-index: 1;
        margin-bottom: 9px;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: clamp(25px, 4vw, 33px);
        font-weight: 700;
    }

    .settings-hero p {
        position: relative;
        z-index: 1;
        max-width: 570px;
        margin: 0;
        color: var(--muted, #8b7c83);
        font-size: 13px;
        line-height: 1.8;
    }

    /* Main card */
    .settings-card {
        overflow: hidden;
        border: 1px solid var(--border-soft, #f0e5e9);
        border-radius: 22px;
        background: #fff;
        box-shadow: var(--shadow-soft, 0 10px 30px rgba(73, 58, 66, .06));
    }

    .settings-card-header {
        padding: 23px 27px;
        border-bottom: 1px solid #f3e9ed;
    }

    .settings-card-header h5 {
        margin: 0 0 6px;
        color: #493a42;
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
    }

    .settings-card-header p {
        margin: 0;
        color: #95858d;
        font-size: 12px;
    }

    .settings-card-body {
        padding: 27px;
    }

    /* Setting fields */
    .setting-field {
        padding: 20px;
        margin-bottom: 17px;
        border: 1px solid #f0e6eb;
        border-radius: 16px;
        background: #fffdfd;
        transition: .2s ease;
    }

    .setting-field:hover {
        border-color: #e5bdcc;
        background: #fffafb;
    }

    .setting-field:last-of-type {
        margin-bottom: 23px;
    }

    .setting-field-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 17px;
    }

    .setting-icon {
        display: flex;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #f9eaf0;
        color: #b76d8d;
        font-size: 19px;
    }

    .setting-icon.lavender {
        background: #eee7f8;
        color: #8873ad;
    }

    .setting-field-heading h6 {
        margin: 2px 0 5px;
        color: #55434d;
        font-size: 13px;
        font-weight: 800;
    }

    .setting-field-heading p {
        margin: 0;
        color: #9a8b93;
        font-size: 11px;
        line-height: 1.6;
    }

    .setting-label {
        display: block;
        margin-bottom: 8px;
        color: #66535e;
        font-size: 12px;
        font-weight: 700;
    }

    .setting-input-group {
        position: relative;
        max-width: 250px;
    }

    .setting-input-group .form-control {
        min-height: 46px;
        padding: 10px 55px 10px 14px;
        border: 1px solid #ebdfe5;
        border-radius: 11px;
        background: #fff;
        color: #493a42;
        font-size: 15px;
        font-weight: 700;
        box-shadow: none;
        transition: .2s ease;
    }

    .setting-input-group .form-control:focus {
        border-color: #c9829f;
        box-shadow: 0 0 0 3px rgba(201, 130, 159, .12);
    }

    .setting-input-group .input-unit {
        position: absolute;
        top: 50%;
        right: 15px;
        color: #a08d97;
        font-size: 11px;
        pointer-events: none;
        transform: translateY(-50%);
    }

    .setting-help {
        display: block;
        margin-top: 9px;
        color: #a09299;
        font-size: 10px;
        line-height: 1.7;
    }

    /* Information */
    .settings-note {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 19px;
        margin-top: 22px;
        border: 1px solid #eae1f2;
        border-radius: 15px;
        background: linear-gradient(120deg, #faf7ff, #fff8fa);
    }

    .settings-note-icon {
        display: flex;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eee7f8;
        color: #8b75b1;
        font-size: 17px;
    }

    .settings-note h6 {
        margin: 1px 0 6px;
        color: #66547a;
        font-size: 12px;
        font-weight: 800;
    }

    .settings-note p {
        margin: 0;
        color: #82758d;
        font-size: 11px;
        line-height: 1.8;
    }

    /* Buttons */
    .settings-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 23px;
    }

    .btn-settings-save {
        display: inline-flex;
        min-height: 43px;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 19px;
        border: 0;
        border-radius: 11px;
        background: linear-gradient(120deg, #c9829f, #b76d8d);
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        box-shadow: 0 5px 13px rgba(201, 130, 159, .20);
        transition: .2s ease;
    }

    .btn-settings-save:hover {
        background: linear-gradient(120deg, #b76d8d, #a85b7d);
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-settings-back {
        display: inline-flex;
        min-height: 43px;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 17px;
        border: 1px solid #eee3e8;
        border-radius: 11px;
        background: #fff;
        color: #786671;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-settings-back:hover {
        border-color: #dba5ba;
        background: #fff6f8;
        color: #a95e7e;
    }

    .settings-alert {
        padding: 13px 16px;
        margin-bottom: 20px;
        border: 0;
        border-radius: 12px;
        font-size: 12px;
    }

    @keyframes settingsEnter {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .settings-page {
            padding-top: 20px;
        }

        .settings-hero {
            padding: 24px;
        }

        .settings-hero::after {
            right: 10px;
            font-size: 105px;
        }

        .settings-card-header,
        .settings-card-body {
            padding: 19px;
        }

        .setting-field {
            padding: 15px;
        }

        .setting-input-group {
            max-width: 100%;
        }

        .settings-actions > * {
            flex: 1;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .settings-page,
        .setting-field,
        .btn-settings-save,
        .btn-settings-back {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid settings-page">

    {{-- Header --}}
    <div class="settings-hero">
        <span class="settings-eyebrow">Femora · Personal preferences</span>
        <h2>Pengaturan Siklus</h2>
        <p>
            Sesuaikan informasi siklus menstruasimu agar Femora dapat
            membantu memberikan perkiraan berdasarkan data yang tersedia.
        </p>
    </div>

    {{-- Main settings card --}}
    <div class="settings-card">

        <div class="settings-card-header">
            <h5><i class="bi bi-sliders me-2" style="color:#c9829f"></i>Preferensi Siklusmu</h5>
            <p>Atur panjang siklus dan durasi menstruasi yang biasanya kamu alami.</p>
        </div>

        <div class="settings-card-body">

            {{-- Success notification --}}
            @if (session('success'))
                <div class="alert alert-success settings-alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger settings-alert">
                    <strong class="d-block mb-2">
                        Ada pengaturan yang perlu diperiksa:
                    </strong>

                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('settings.cycle.update') }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Cycle length --}}
                <div class="setting-field">

                    <div class="setting-field-heading">
                        <div class="setting-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>

                        <div>
                            <h6>Panjang Siklus Menstruasi</h6>
                            <p>Jarak hari dari awal satu menstruasi ke awal menstruasi berikutnya.</p>
                        </div>
                    </div>

                    <label for="cycle_length" class="setting-label">
                        Panjang Siklus (Hari)
                    </label>

                    <div class="setting-input-group">
                        <input
                            type="number"
                            name="cycle_length"
                            id="cycle_length"
                            class="form-control @error('cycle_length') is-invalid @enderror"
                            min="15"
                            max="60"
                            value="{{ old('cycle_length', $setting->cycle_length) }}"
                            placeholder="Contoh: 28"
                            required
                        >

                        <span class="input-unit">Hari</span>

                        @error('cycle_length')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <small class="setting-help">
                        Masukkan angka antara 15–60 hari. Contohnya, siklus
                        28 hari berarti jarak antara hari pertama menstruasi
                        dengan hari pertama menstruasi berikutnya adalah 28 hari.
                    </small>

                </div>

                {{-- Period duration --}}
                <div class="setting-field">

                    <div class="setting-field-heading">
                        <div class="setting-icon lavender">
                            <i class="bi bi-droplet-half"></i>
                        </div>

                        <div>
                            <h6>Durasi Menstruasi</h6>
                            <p>Lama hari menstruasi biasanya berlangsung.</p>
                        </div>
                    </div>

                    <label for="period_duration" class="setting-label">
                        Durasi Menstruasi (Hari)
                    </label>

                    <div class="setting-input-group">
                        <input
                            type="number"
                            name="period_duration"
                            id="period_duration"
                            class="form-control @error('period_duration') is-invalid @enderror"
                            min="1"
                            max="15"
                            value="{{ old('period_duration', $setting->period_duration) }}"
                            placeholder="Contoh: 5"
                            required
                        >

                        <span class="input-unit">Hari</span>

                        @error('period_duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <small class="setting-help">
                        Masukkan angka antara 1–15 hari sesuai durasi
                        menstruasi yang biasanya kamu alami.
                    </small>

                </div>

                {{-- Actions --}}
                <div class="settings-actions">

                    <button type="submit" class="btn-settings-save">
                        <i class="bi bi-check2-circle"></i>
                        Simpan Pengaturan
                    </button>

                    <a href="{{ route('dashboard') }}" class="btn-settings-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Dashboard
                    </a>

                </div>

            </form>

            {{-- Information --}}
            <div class="settings-note">

                <div class="settings-note-icon">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div>
                    <h6>Bagaimana Femora menggunakan pengaturan ini?</h6>

                    <p>
                        Pengaturan manual menjadi acuan alternatif ketika
                        riwayat menstruasi belum cukup untuk menghitung
                        rata-rata siklus secara otomatis. Jika data aktual
                        sudah tersedia, Femora memprioritaskan rata-rata
                        berdasarkan riwayat tersebut. Hasil prediksi hanya
                        berupa estimasi dan bukan diagnosis medis.
                    </p>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
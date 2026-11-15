
@extends('layouts.app')

@section('title', 'Edit Catatan Menstruasi - Femora')

@section('styles')
<style>
    .menstrual-edit-page {
        max-width: 950px;
        margin: auto;
        padding: 32px 0 55px;
        animation: menstrualEditEnter .5s ease both;
    }

    /* Header */
    .menstrual-edit-hero {
        position: relative;
        overflow: hidden;
        padding: 29px 32px;
        margin-bottom: 25px;
        border: 1px solid rgba(201, 130, 159, .15);
        border-radius: 24px;
        background: linear-gradient(120deg, #fff8f7, #f9eaf0 60%, #f0eafa);
    }

    .menstrual-edit-hero::after {
        content: "🌸";
        position: absolute;
        top: 12px;
        right: 35px;
        font-size: 75px;
        opacity: .12;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    .edit-eyebrow {
        display: inline-block;
        margin-bottom: 9px;
        color: var(--pink-dark, #a95e7e);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .menstrual-edit-hero h2 {
        position: relative;
        z-index: 1;
        margin-bottom: 9px;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: clamp(25px, 4vw, 33px);
        font-weight: 700;
    }

    .menstrual-edit-hero p {
        position: relative;
        z-index: 1;
        max-width: 550px;
        margin: 0;
        color: var(--muted, #8b7c83);
        font-size: 13px;
        line-height: 1.8;
    }

    /* Form card */
    .menstrual-edit-card {
        overflow: hidden;
        border: 1px solid var(--border-soft, #f0e5e9);
        border-radius: 22px;
        background: #fff;
        box-shadow: var(--shadow-soft, 0 10px 30px rgba(73, 58, 66, .06));
    }

    .menstrual-edit-card-header {
        padding: 23px 27px;
        border-bottom: 1px solid #f3e9ed;
    }

    .menstrual-edit-card-header h5 {
        margin: 0 0 6px;
        color: #493a42;
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
    }

    .menstrual-edit-card-header p {
        margin: 0;
        color: #95858d;
        font-size: 12px;
    }

    .menstrual-edit-card-body {
        padding: 27px;
    }

    .edit-section {
        margin-bottom: 25px;
    }

    .edit-label {
        display: block;
        margin-bottom: 9px;
        color: #594751;
        font-size: 12px;
        font-weight: 800;
    }

    .edit-label i {
        margin-right: 7px;
        color: #c9829f;
        font-size: 14px;
    }

    .edit-input {
        min-height: 45px;
        padding: 10px 13px;
        border: 1px solid #ebdfe5;
        border-radius: 11px;
        color: #493a42;
        font-size: 12px;
        box-shadow: none;
        transition: .2s ease;
    }

    .edit-input:focus {
        border-color: #c9829f;
        box-shadow: 0 0 0 3px rgba(201, 130, 159, .12);
    }

    .edit-help {
        display: block;
        margin-top: 8px;
        color: #a09299;
        font-size: 10px;
        line-height: 1.7;
    }

    .edit-info {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px;
        margin-bottom: 24px;
        border: 1px solid #eee5f3;
        border-radius: 13px;
        background: #faf7ff;
    }

    .edit-info-icon {
        display: flex;
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #eee7f8;
        color: #8873ad;
    }

    .edit-info p {
        margin: 0;
        color: #82758d;
        font-size: 11px;
        line-height: 1.8;
    }

    /* Buttons */
    .edit-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 22px;
        border-top: 1px solid #f2e9ed;
    }

    .btn-edit-save {
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

    .btn-edit-save:hover {
        background: linear-gradient(120deg, #b76d8d, #a85b7d);
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-edit-back {
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

    .btn-edit-back:hover {
        border-color: #dba5ba;
        background: #fff6f8;
        color: #a95e7e;
    }

    .edit-alert {
        padding: 14px 17px;
        margin-bottom: 22px;
        border: 0;
        border-radius: 12px;
        font-size: 12px;
    }

    @keyframes menstrualEditEnter {
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
        .menstrual-edit-page {
            padding-top: 20px;
        }

        .menstrual-edit-hero {
            padding: 24px;
        }

        .menstrual-edit-hero::after {
            right: 12px;
            font-size: 55px;
        }

        .menstrual-edit-card-header,
        .menstrual-edit-card-body {
            padding: 19px;
        }

        .edit-actions > * {
            flex: 1;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .menstrual-edit-page,
        .btn-edit-save,
        .btn-edit-back {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid menstrual-edit-page">

    {{-- Header --}}
    <div class="menstrual-edit-hero">
        <span class="edit-eyebrow">Femora · Menstrual tracking</span>

        <h2>Edit Catatan Menstruasi</h2>

        <p>
            Perbarui informasi menstruasimu agar riwayat siklus
            tetap sesuai dengan kondisi yang kamu alami.
        </p>
    </div>

    {{-- Form card --}}
    <div class="menstrual-edit-card">

        <div class="menstrual-edit-card-header">
            <h5>
                <i class="bi bi-pencil-square me-2" style="color:#c9829f"></i>
                Perbarui Catatan
            </h5>

            <p>Periksa kembali tanggal dan informasi sebelum menyimpan perubahan.</p>
        </div>

        <div class="menstrual-edit-card-body">

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger edit-alert">
                    <strong class="d-block mb-2">
                        Ada informasi yang perlu diperiksa:
                    </strong>

                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('menstrual.update', $cycle->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Start date --}}
                <div class="edit-section">

                    <label for="start_date" class="edit-label">
                        <i class="bi bi-calendar-heart"></i>
                        Tanggal Mulai Menstruasi
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        id="start_date"
                        class="form-control edit-input @error('start_date') is-invalid @enderror"
                        value="{{ old('start_date', $cycle->start_date->format('Y-m-d')) }}"
                        max="{{ date('Y-m-d') }}"
                        required
                    >

                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="edit-help">
                        Masukkan tanggal pertama menstruasi dimulai.
                    </small>

                </div>

                {{-- End date --}}
                <div class="edit-section">

                    <label for="end_date" class="edit-label">
                        <i class="bi bi-calendar-check"></i>
                        Tanggal Selesai Menstruasi
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        id="end_date"
                        class="form-control edit-input @error('end_date') is-invalid @enderror"
                        value="{{ old('end_date', $cycle->end_date?->format('Y-m-d')) }}"
                        min="{{ old('start_date', $cycle->start_date->format('Y-m-d')) }}"
                        max="{{ date('Y-m-d') }}"
                    >

                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="edit-help">
                        Kosongkan jika menstruasi masih berlangsung.
                    </small>

                </div>

                {{-- Information --}}
                <div class="edit-info">
                    <div class="edit-info-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <p>
                        Tanggal selesai tidak wajib diisi jika menstruasi
                        belum selesai. Pastikan tanggal selesai tidak
                        mendahului tanggal mulai.
                    </p>
                </div>

                {{-- Notes --}}
                <div class="edit-section">

                    <label for="notes" class="edit-label">
                        <i class="bi bi-journal-text"></i>
                        Catatan (Opsional)
                    </label>

                    <textarea
                        name="notes"
                        id="notes"
                        class="form-control edit-input @error('notes') is-invalid @enderror"
                        rows="4"
                        maxlength="2000"
                        placeholder="Tambahkan informasi mengenai menstruasimu..."
                    >{{ old('notes', $cycle->notes) }}</textarea>

                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="edit-help">
                        Tambahkan catatan jika ada informasi yang ingin kamu simpan.
                    </small>

                </div>

                {{-- Actions --}}
                <div class="edit-actions">

                    <button type="submit" class="btn-edit-save">
                        <i class="bi bi-check2-circle"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('menstrual.index') }}"
                       class="btn-edit-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Riwayat
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection
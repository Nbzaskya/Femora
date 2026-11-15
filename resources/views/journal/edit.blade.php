
@extends('layouts.app')

@section('title', 'Edit Jurnal - Femora')

@section('styles')
<style>
    .journal-edit-page {
        max-width: 950px;
        margin: auto;
        padding: 32px 0 55px;
        animation: journalEditEnter .5s ease both;
    }

    /* Header */
    .edit-hero {
        position: relative;
        overflow: hidden;
        padding: 29px 32px;
        margin-bottom: 25px;
        border: 1px solid rgba(201, 130, 159, .15);
        border-radius: 24px;
        background: linear-gradient(120deg, #fff8f7, #f9eaf0 60%, #f0eafa);
    }

    .edit-hero::after {
        content: "✿";
        position: absolute;
        top: -35px;
        right: 30px;
        color: rgba(201, 130, 159, .12);
        font-size: 145px;
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

    .edit-hero h2 {
        position: relative;
        z-index: 1;
        margin-bottom: 9px;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: clamp(25px, 4vw, 33px);
        font-weight: 700;
    }

    .edit-hero p {
        position: relative;
        z-index: 1;
        max-width: 550px;
        margin: 0;
        color: var(--muted, #8b7c83);
        font-size: 13px;
        line-height: 1.8;
    }

    /* Form card */
    .edit-card {
        overflow: hidden;
        border: 1px solid var(--border-soft, #f0e5e9);
        border-radius: 22px;
        background: #fff;
        box-shadow: var(--shadow-soft, 0 10px 30px rgba(73, 58, 66, .06));
    }

    .edit-card-header {
        padding: 23px 27px;
        border-bottom: 1px solid #f3e9ed;
    }

    .edit-card-header h5 {
        margin: 0 0 6px;
        color: #493a42;
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
    }

    .edit-card-header p {
        margin: 0;
        color: #95858d;
        font-size: 12px;
    }

    .edit-card-body {
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
        margin-top: 7px;
        color: #a09299;
        font-size: 10px;
    }

    /* Symptoms */
    .symptom-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
    }

    .symptom-option {
        display: flex;
        min-height: 47px;
        align-items: center;
        gap: 9px;
        padding: 10px 12px;
        border: 1px solid #f0e5e9;
        border-radius: 12px;
        background: #fffdfd;
        color: #796873;
        cursor: pointer;
        transition: .2s ease;
    }

    .symptom-option:hover {
        border-color: #dcaabd;
        background: #fff8fa;
        transform: translateY(-2px);
    }

    .symptom-option input {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        accent-color: #c9829f;
        cursor: pointer;
    }

    .symptom-option span {
        font-size: 11px;
        font-weight: 600;
    }

    .symptom-option:has(input:checked) {
        border-color: #c9829f;
        background: #fdf0f4;
        color: #a45d7c;
        box-shadow: 0 3px 10px rgba(201, 130, 159, .09);
    }

    /* Mood */
    .mood-select {
        max-width: 450px;
    }

    /* Notes */
    .notes-textarea {
        min-height: 125px;
        resize: vertical;
        line-height: 1.7;
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

    @keyframes journalEditEnter {
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
        .symptom-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 576px) {
        .journal-edit-page {
            padding-top: 20px;
        }

        .edit-hero {
            padding: 24px;
        }

        .edit-hero::after {
            right: 10px;
            font-size: 105px;
        }

        .edit-card-header,
        .edit-card-body {
            padding: 19px;
        }

        .edit-actions > * {
            flex: 1;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .journal-edit-page,
        .symptom-option,
        .btn-edit-save,
        .btn-edit-back {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid journal-edit-page">

    {{-- Header --}}
    <div class="edit-hero">
        <span class="edit-eyebrow">Femora · Daily journal</span>

        <h2>Edit Jurnal Harian</h2>

        <p>
            Perbarui catatan gejala, suasana hati, dan pengalaman
            yang ingin kamu simpan dalam jurnal harianmu.
        </p>
    </div>

    {{-- Form card --}}
    <div class="edit-card">

        <div class="edit-card-header">
            <h5>
                <i class="bi bi-pencil-square me-2" style="color:#c9829f"></i>
                Perbarui Catatan
            </h5>

            <p>Pastikan informasi yang kamu masukkan sudah sesuai.</p>
        </div>

        <div class="edit-card-body">

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

            <form action="{{ route('journal.update', $log->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Date --}}
                <div class="edit-section">

                    <label for="log_date" class="edit-label">
                        <i class="bi bi-calendar-heart"></i>
                        Tanggal Jurnal
                    </label>

                    <input
                        type="date"
                        name="log_date"
                        id="log_date"
                        class="form-control edit-input @error('log_date') is-invalid @enderror"
                        value="{{ old('log_date', $log->log_date->format('Y-m-d')) }}"
                        max="{{ now()->format('Y-m-d') }}"
                        required
                    >

                    @error('log_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="edit-help">
                        Pilih tanggal ketika kamu mengalami kondisi tersebut.
                    </small>

                </div>

                {{-- Symptoms --}}
                @php
                    $symptomOptions = [
                        'kram perut',
                        'sakit kepala',
                        'nyeri pinggang',
                        'kelelahan',
                        'mual',
                        'kembung',
                        'jerawat',
                        'nyeri payudara'
                    ];

                    $selectedSymptoms = old('symptoms', $log->symptoms ?? []);
                @endphp

                <div class="edit-section">

                    <label class="edit-label">
                        <i class="bi bi-heart-pulse"></i>
                        Gejala yang Dirasakan
                    </label>

                    <small class="edit-help mb-3">
                        Pilih satu atau beberapa gejala yang kamu alami.
                    </small>

                    <div class="symptom-grid">

                        @foreach ($symptomOptions as $symptom)
                            <label class="symptom-option">

                                <input
                                    type="checkbox"
                                    name="symptoms[]"
                                    value="{{ $symptom }}"
                                    {{ in_array($symptom, $selectedSymptoms) ? 'checked' : '' }}
                                >

                                <span>{{ ucfirst($symptom) }}</span>

                            </label>
                        @endforeach

                    </div>

                    @error('symptoms')
                        <div class="text-danger mt-2" style="font-size:11px">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Mood --}}
                <div class="edit-section">

                    <label for="mood" class="edit-label">
                        <i class="bi bi-emoji-smile"></i>
                        Bagaimana Suasana Hatimu?
                    </label>

                    <div class="mood-select">
                        <select
                            name="mood"
                            id="mood"
                            class="form-select edit-input @error('mood') is-invalid @enderror"
                        >
                            <option value="">Pilih suasana hati</option>

                            @foreach (['Senang', 'Tenang', 'Sedih', 'Mudah marah', 'Cemas', 'Lelah'] as $mood)
                                <option value="{{ $mood }}"
                                    {{ old('mood', $log->mood) == $mood ? 'selected' : '' }}>
                                    {{ $mood }}
                                </option>
                            @endforeach

                        </select>

                        @error('mood')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Notes --}}
                <div class="edit-section">

                    <label for="notes" class="edit-label">
                        <i class="bi bi-journal-text"></i>
                        Catatan Tambahan
                    </label>

                    <textarea
                        name="notes"
                        id="notes"
                        class="form-control edit-input notes-textarea @error('notes') is-invalid @enderror"
                        rows="4"
                        maxlength="2000"
                        placeholder="Ceritakan kondisi atau hal yang ingin kamu catat..."
                    >{{ old('notes', $log->notes) }}</textarea>

                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="edit-help">
                        Maksimal 2.000 karakter.
                    </small>

                </div>

                {{-- Actions --}}
                <div class="edit-actions">

                    <button type="submit" class="btn-edit-save">
                        <i class="bi bi-check2-circle"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('journal.index') }}"
                       class="btn-edit-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Jurnal
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection
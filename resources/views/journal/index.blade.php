@extends('layouts.app')

@section('title', 'Jurnal Harian - Femora')

@section('styles')
<style>
    .journal-page {
        max-width: 1440px;
        margin: auto;
        padding: 32px 0 55px;
        animation: journalEnter .5s ease both;
    }

    /* Header */
    .journal-hero {
        position: relative;
        overflow: hidden;
        padding: 30px 34px;
        margin-bottom: 25px;
        border: 1px solid rgba(201, 130, 159, .15);
        border-radius: 25px;
        background: linear-gradient(120deg, #fff8f7, #f9eaf0 60%, #f0eafa);
    }

    .journal-hero::after {
        content: "♡";
        position: absolute;
        top: -36px;
        right: 35px;
        color: rgba(201, 130, 159, .12);
        font-size: 155px;
        font-weight: 300;
        pointer-events: none;
    }

    .journal-eyebrow {
        display: inline-block;
        margin-bottom: 9px;
        color: var(--pink-dark, #a95e7e);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .journal-hero h2 {
        position: relative;
        z-index: 1;
        margin-bottom: 9px;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: clamp(25px, 4vw, 34px);
        font-weight: 700;
    }

    .journal-hero p {
        position: relative;
        z-index: 1;
        max-width: 550px;
        margin: 0;
        color: var(--muted, #8b7c83);
        font-size: 14px;
        line-height: 1.7;
    }

    /* Panels */
    .journal-panel {
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--border-soft, #f0e5e9);
        border-radius: 21px;
        background: #fff;
        box-shadow: var(--shadow-soft, 0 10px 30px rgba(73, 58, 66, .06));
    }

    .journal-panel-header {
        padding: 22px 23px;
        border-bottom: 1px solid #f3e9ed;
    }

    .journal-panel-header h5 {
        margin: 0 0 5px;
        color: var(--text, #493A42);
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
    }

    .journal-panel-header p {
        margin: 0;
        color: var(--muted, #8b7c83);
        font-size: 12px;
    }

    .journal-panel-body {
        padding: 23px;
    }

    /* Alerts */
    .journal-alert {
        padding: 14px 17px;
        margin-bottom: 20px;
        border: 0;
        border-radius: 13px;
        font-size: 13px;
    }

    /* Form */
    .journal-form .form-label {
        margin-bottom: 9px;
        color: #65515c;
        font-size: 12px;
        font-weight: 700;
    }

    .journal-form .form-control,
    .journal-form .form-select {
        min-height: 43px;
        border: 1px solid #eee3e8;
        border-radius: 11px;
        background-color: #fffdfd;
        color: #493a42;
        font-size: 13px;
        box-shadow: none;
        transition: .2s ease;
    }

    .journal-form textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .journal-form .form-control:focus,
    .journal-form .form-select:focus {
        border-color: #c9829f;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(201, 130, 159, .12);
    }

    .journal-field {
        margin-bottom: 22px;
    }

    .journal-field:last-of-type {
        margin-bottom: 18px;
    }

    .field-hint {
        display: block;
        margin-top: 6px;
        color: #a2959c;
        font-size: 10px;
    }

    /* Symptom choices */
    .symptom-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 9px;
    }

    .symptom-option {
        position: relative;
        display: flex;
        min-height: 42px;
        align-items: center;
        gap: 9px;
        padding: 9px 11px;
        border: 1px solid #f0e5e9;
        border-radius: 11px;
        background: #fffafa;
        color: #75636c;
        cursor: pointer;
        font-size: 11px;
        transition: .2s ease;
    }

    .symptom-option:hover {
        border-color: #dba5ba;
        background: #fff4f7;
    }

    .symptom-option input {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        margin: 0;
        accent-color: #c9829f;
        cursor: pointer;
    }

    .symptom-option:has(input:checked) {
        border-color: #dba5ba;
        background: #fcecf2;
        color: #96536f;
        font-weight: 700;
    }

    .journal-submit {
        display: inline-flex;
        min-height: 44px;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 10px 20px;
        border: 0;
        border-radius: 11px;
        background: linear-gradient(120deg, #c9829f, #b76d8d);
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        box-shadow: 0 5px 13px rgba(201, 130, 159, .20);
        transition: .2s ease;
    }

    .journal-submit:hover {
        background: linear-gradient(120deg, #b76d8d, #a85b7d);
        color: #fff;
        box-shadow: 0 8px 17px rgba(201, 130, 159, .25);
        transform: translateY(-2px);
    }

    /* Journal history */
    .journal-count {
        display: inline-flex;
        align-items: center;
        padding: 6px 11px;
        border-radius: 20px;
        background: #f9eaf0;
        color: #a45f7d;
        font-size: 10px;
        font-weight: 800;
    }

    .journal-record {
        padding: 17px;
        margin-bottom: 13px;
        border: 1px solid #f0e7eb;
        border-radius: 15px;
        background: linear-gradient(135deg, #fffdfd, #fff9fb);
        transition: .2s ease;
    }

    .journal-record:hover {
        border-color: #e4bdcc;
        box-shadow: 0 5px 16px rgba(73, 58, 66, .05);
        transform: translateY(-2px);
    }

    .journal-record:last-child {
        margin-bottom: 0;
    }

    .journal-record-date {
        margin: 0 0 7px;
        color: #493a42;
        font-size: 13px;
        font-weight: 800;
    }

    .journal-record-date i {
        margin-right: 6px;
        color: #c9829f;
    }

    .mood-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #eee7f8;
        color: #75619b;
        font-size: 10px;
        font-weight: 700;
    }

    .journal-record-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .journal-record-actions .btn {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
    }

    .journal-section-label {
        display: block;
        margin-bottom: 8px;
        color: #a08e98;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .symptom-badge {
        display: inline-block;
        padding: 6px 10px;
        margin: 0 4px 5px 0;
        border-radius: 20px;
        background: #fbeaf0;
        color: #96536f;
        font-size: 10px;
        font-weight: 600;
    }

    .journal-note {
        padding: 12px 14px;
        margin-top: 13px;
        border-left: 3px solid #d9b6e6;
        border-radius: 0 10px 10px 0;
        background: #faf7fc;
        color: #776b7c;
        font-size: 12px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .journal-note i {
        margin-right: 5px;
        color: #9a83bb;
    }

    /* Empty state */
    .journal-empty {
        padding: 45px 15px;
        text-align: center;
    }

    .journal-empty-icon {
        display: flex;
        width: 65px;
        height: 65px;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        border-radius: 22px;
        background: #f9eaf0;
        color: #c9829f;
        font-size: 25px;
    }

    .journal-empty h6 {
        margin-bottom: 7px;
        color: #493a42;
        font-weight: 800;
    }

    .journal-empty p {
        margin: 0;
        color: #9a8c94;
        font-size: 12px;
    }

    /* Pagination */
    .journal-pagination {
        margin-top: 20px;
    }

    .journal-pagination nav {
        display: flex;
        justify-content: center;
    }

    .journal-pagination .pagination {
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 0;
    }

    .journal-pagination .page-link {
        border: 1px solid #f0e5e9;
        border-radius: 8px !important;
        color: #9a6380;
        font-size: 11px;
    }

    .journal-pagination .active .page-link {
        border-color: #c9829f;
        background: #c9829f;
        color: #fff;
    }

    @keyframes journalEnter {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991px) {
        .journal-page {
            padding-top: 22px;
        }
    }

    @media (max-width: 576px) {
        .journal-hero {
            padding: 24px;
        }

        .journal-hero::after {
            right: 10px;
            font-size: 105px;
        }

        .journal-panel-header,
        .journal-panel-body {
            padding: 18px;
        }

        .journal-record {
            padding: 14px;
        }

        .journal-record-actions .btn {
            padding: 5px 8px;
        }

        .symptom-grid {
            gap: 7px;
        }

        .symptom-option {
            padding: 8px;
            font-size: 10px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .journal-page,
        .journal-record,
        .journal-submit,
        .symptom-option {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid journal-page">

    {{-- Header --}}
    <div class="journal-hero">
        <span class="journal-eyebrow">Femora · Your daily reflection</span>
        <h2>Jurnal Harian</h2>
        <p>
            Setiap hari punya cerita. Catat gejala, suasana hati,
            dan hal-hal yang kamu rasakan untuk lebih mengenali tubuhmu.
        </p>
    </div>

    {{-- Notifications --}}
    @if (session('success'))
        <div class="alert alert-success journal-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger journal-alert">
            <strong class="d-block mb-2">
                Ada beberapa data yang perlu diperiksa:
            </strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Form --}}
        <div class="col-12 col-lg-5">
            <div class="journal-panel">

                <div class="journal-panel-header">
                    <h5><i class="bi bi-pencil-square me-2" style="color:#c9829f"></i>Tulis Jurnal</h5>
                    <p>Luangkan sedikit waktu untuk mencatat kondisimu hari ini.</p>
                </div>

                <div class="journal-panel-body">

                    <form action="{{ route('journal.store') }}"
                          method="POST"
                          class="journal-form">

                        @csrf

                        {{-- Date --}}
                        <div class="journal-field">
                            <label for="log_date" class="form-label">
                                <i class="bi bi-calendar-heart me-1"></i>
                                Tanggal Jurnal
                            </label>

                            <input type="date"
                                   id="log_date"
                                   name="log_date"
                                   class="form-control @error('log_date') is-invalid @enderror"
                                   value="{{ old('log_date', now()->format('Y-m-d')) }}"
                                   max="{{ now()->format('Y-m-d') }}"
                                   required>

                            @error('log_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Symptoms --}}
                        <div class="journal-field">
                            <label class="form-label">
                                <i class="bi bi-heart-pulse me-1"></i>
                                Gejala yang Dirasakan
                            </label>

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
                            @endphp

                            <div class="symptom-grid">
                                @foreach ($symptomOptions as $symptom)
                                    <label class="symptom-option">
                                        <input type="checkbox"
                                               name="symptoms[]"
                                               value="{{ $symptom }}"
                                               {{ in_array($symptom, old('symptoms', [])) ? 'checked' : '' }}>
                                        <span>{{ ucfirst($symptom) }}</span>
                                    </label>
                                @endforeach
                            </div>

                            @error('symptoms')
                                <div class="text-danger mt-2" style="font-size:11px">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="field-hint">
                                Kamu bisa memilih lebih dari satu gejala.
                            </small>
                        </div>

                        {{-- Mood --}}
                        <div class="journal-field">
                            <label for="mood" class="form-label">
                                <i class="bi bi-emoji-smile me-1"></i>
                                Bagaimana Suasana Hatimu?
                            </label>

                            <select name="mood"
                                    id="mood"
                                    class="form-select @error('mood') is-invalid @enderror">

                                <option value="">Pilih suasana hati</option>

                                @foreach (['Senang', 'Tenang', 'Sedih', 'Mudah marah', 'Cemas', 'Lelah'] as $mood)
                                    <option value="{{ $mood }}"
                                        {{ old('mood') == $mood ? 'selected' : '' }}>
                                        {{ $mood }}
                                    </option>
                                @endforeach

                            </select>

                            @error('mood')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="journal-field">
                            <label for="notes" class="form-label">
                                <i class="bi bi-journal-text me-1"></i>
                                Catatan Tambahan
                            </label>

                            <textarea name="notes"
                                      id="notes"
                                      class="form-control @error('notes') is-invalid @enderror"
                                      rows="4"
                                      maxlength="2000"
                                      placeholder="Ceritakan kondisi atau hal yang ingin kamu catat...">{{ old('notes') }}</textarea>

                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="field-hint">
                                Maksimal 2.000 karakter.
                            </small>
                        </div>

                        <button type="submit" class="journal-submit">
                            <i class="bi bi-bookmark-heart"></i>
                            Simpan Jurnal
                        </button>

                    </form>
                </div>
            </div>
        </div>

        {{-- Journal history --}}
        <div class="col-12 col-lg-7">
            <div class="journal-panel">

                <div class="journal-panel-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5><i class="bi bi-journal-bookmark me-2" style="color:#c9829f"></i>Riwayat Jurnal</h5>
                            <p>Perjalanan catatan dan perasaanmu dari hari ke hari.</p>
                        </div>

                        <span class="journal-count">
                            {{ $logs->total() }} Catatan
                        </span>
                    </div>
                </div>

                <div class="journal-panel-body">

                    @forelse ($logs as $log)

                        <div class="journal-record">

                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                                <div>
                                    <h6 class="journal-record-date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $log->log_date->translatedFormat('d F Y') }}
                                    </h6>

                                    @if ($log->mood)
                                        <span class="mood-badge">
                                            <i class="bi bi-emoji-smile me-1"></i>
                                            {{ $log->mood }}
                                        </span>
                                    @endif
                                </div>

                                <div class="journal-record-actions">

                                    <a href="{{ route('journal.edit', $log->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('journal.destroy', $log->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash3 me-1"></i>
                                            Hapus
                                        </button>

                                    </form>
                                </div>

                            </div>

                            {{-- Symptoms --}}
                            @if ($log->symptoms && count($log->symptoms) > 0)
                                <div class="mt-3">
                                    <span class="journal-section-label">
                                        Gejala yang dirasakan
                                    </span>

                                    @foreach ($log->symptoms as $symptom)
                                        <span class="symptom-badge">
                                            {{ ucfirst($symptom) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Notes --}}
                            @if ($log->notes)
                                <div class="journal-note">
                                    <i class="bi bi-chat-left-text"></i>
                                    {{ $log->notes }}
                                </div>
                            @endif

                        </div>

                    @empty

                        <div class="journal-empty">
                            <div class="journal-empty-icon">
                                <i class="bi bi-journal-heart"></i>
                            </div>

                            <h6>Belum Ada Jurnal</h6>

                            <p>
                                Catatan harian yang kamu simpan akan muncul di sini.
                                Yuk, mulai tulis jurnal pertamamu.
                            </p>
                        </div>

                    @endforelse

                    {{-- Pagination --}}
                    @if ($logs->hasPages())
                        <div class="journal-pagination">
                            {{ $logs->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
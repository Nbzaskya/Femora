
@extends('layouts.app')

@section('title', 'Buat Akun - Femora')

@section('styles')
<style>
    .register-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
        animation: registerEnter .6s ease both;
    }

    .register-layout {
        display: grid;
        grid-template-columns: .9fr 1.1fr;
        width: 100%;
        max-width: 1000px;
        min-height: 610px;
        overflow: hidden;
        border: 1px solid #f0e5e9;
        border-radius: 26px;
        background: #fff;
        box-shadow: 0 15px 45px rgba(73, 58, 66, .08);
    }

    /* Brand panel */
    .register-brand-panel {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        padding: 40px;
        background: linear-gradient(145deg, #fff4f5, #f8e4ec 60%, #eee7f7);
    }

    .register-brand-panel::before,
    .register-brand-panel::after {
        position: absolute;
        content: "";
        border: 1px solid rgba(201, 130, 159, .18);
        border-radius: 50%;
        pointer-events: none;
    }

    .register-brand-panel::before {
        width: 290px;
        height: 290px;
        right: -120px;
        top: 120px;
    }

    .register-brand-panel::after {
        width: 210px;
        height: 210px;
        right: -80px;
        top: 160px;
    }

    .register-brand {
        position: relative;
        z-index: 1;
        color: #a95e7e;
        font-family: 'Playfair Display', serif;
        font-size: 30px;
        font-weight: 700;
    }

    .register-brand span {
        margin-right: 7px;
        font-family: sans-serif;
        font-size: 23px;
    }

    .register-brand-content {
        position: relative;
        z-index: 1;
        max-width: 340px;
        margin-top: 30px;
    }

    .register-eyebrow {
        color: #ae708b;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .register-brand-content h2 {
        margin: 15px 0;
        color: #59434f;
        font-family: 'Playfair Display', serif;
        font-size: clamp(29px, 4vw, 40px);
        font-weight: 700;
        line-height: 1.3;
    }

    .register-brand-content p {
        color: #88747f;
        font-size: 12px;
        line-height: 1.9;
    }

    .register-flower {
        position: relative;
        z-index: 1;
        align-self: center;
        margin: 15px 0;
        color: rgba(174, 112, 139, .75);
        font-size: 100px;
        line-height: 1;
        animation: registerFloat 4s ease-in-out infinite;
    }

    .register-brand-footer {
        position: relative;
        z-index: 1;
        color: #987f8c;
        font-size: 10px;
    }

    /* Form panel */
    .register-form-panel {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 38px 45px;
        background: #fff;
    }

    .register-form-content {
        width: 100%;
        max-width: 370px;
    }

    .register-heading {
        margin-bottom: 25px;
    }

    .register-heading .eyebrow {
        color: #b76d8d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .register-heading h3 {
        margin: 10px 0;
        color: #493a42;
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
    }

    .register-heading p {
        margin: 0;
        color: #998a92;
        font-size: 11px;
        line-height: 1.8;
    }

    .register-label {
        display: block;
        margin-bottom: 7px;
        color: #594751;
        font-size: 11px;
        font-weight: 700;
    }

    .register-input-group {
        position: relative;
    }

    .register-input-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        color: #b58a9c;
        font-size: 13px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .register-input {
        min-height: 43px;
        padding: 10px 13px 10px 39px;
        border: 1px solid #ebdfe5;
        border-radius: 10px;
        color: #493a42;
        font-size: 11px;
        box-shadow: none;
        transition: .2s ease;
    }

    .register-input:focus {
        border-color: #c9829f;
        box-shadow: 0 0 0 3px rgba(201, 130, 159, .12);
    }

    .register-input::placeholder {
        color: #b9aab1;
    }

    .register-error {
        margin-top: 5px;
        color: #dc6679;
        font-size: 10px;
    }

    .btn-register {
        display: flex;
        width: 100%;
        min-height: 44px;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 22px;
        border: 0;
        border-radius: 11px;
        background: linear-gradient(120deg, #c9829f, #b76d8d);
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        box-shadow: 0 6px 15px rgba(201, 130, 159, .22);
        transition: .2s ease;
    }

    .btn-register:hover {
        background: linear-gradient(120deg, #b76d8d, #a85b7d);
        color: #fff;
        transform: translateY(-2px);
    }

    .register-login-link {
        margin-top: 22px;
        color: #95858d;
        font-size: 10px;
        text-align: center;
    }

    .register-login-link a {
        color: #b76d8d;
        font-weight: 800;
        text-decoration: none;
    }

    .register-login-link a:hover {
        color: #944c6d;
        text-decoration: underline;
    }

    @keyframes registerEnter {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes registerFloat {
        0%, 100% {
            transform: translateY(0) rotate(-5deg);
        }
        50% {
            transform: translateY(-9px) rotate(5deg);
        }
    }

    @media (max-width: 768px) {
        .register-layout {
            grid-template-columns: 1fr;
            max-width: 480px;
        }

        .register-brand-panel {
            min-height: 220px;
            padding: 25px 28px;
        }

        .register-brand-content {
            margin-top: 25px;
        }

        .register-brand-content h2 {
            font-size: 28px;
        }

        .register-brand-content p {
            max-width: 310px;
            font-size: 11px;
        }

        .register-flower {
            position: absolute;
            right: 25px;
            bottom: 10px;
            margin: 0;
            font-size: 65px;
        }

        .register-brand-footer {
            display: none;
        }

        .register-form-panel {
            padding: 32px 28px;
        }
    }

    @media (max-width: 400px) {
        .register-page {
            padding: 20px 10px;
        }

        .register-form-panel {
            padding: 28px 20px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .register-page,
        .register-flower {
            animation: none !important;
        }

        .btn-register {
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="register-page">

    <div class="register-layout">

        {{-- Brand panel --}}
        <div class="register-brand-panel">

            <div class="register-brand">
                <span>🌸</span>Femora.
            </div>

            <div class="register-brand-content">
                <span class="register-eyebrow">
                    Your journey starts here
                </span>

                <h2>A Beautiful Journey Begins With Understanding Yourself.</h2>

                <p>
                    Setiap tubuh memiliki cerita dan pola yang berbeda.
                    Mulai catat perjalanan siklusmu bersama Femora.
                </p>
            </div>

            <div class="register-flower">✿</div>

            <div class="register-brand-footer">
                A little more understanding, a little more self-love.
            </div>

        </div>

        {{-- Register form --}}
        <div class="register-form-panel">

            <div class="register-form-content">

                <div class="register-heading">
                    <span class="eyebrow">Create your account</span>

                    <h3>Buat Akun Baru</h3>

                    <p>
                        Lengkapi informasi berikut untuk mulai menggunakan Femora.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 py-2"
                         style="font-size: 10px">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="register-label">
                            Nama Lengkap
                        </label>

                        <div class="register-input-group">
                            <i class="bi bi-person register-input-icon"></i>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control register-input @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama lengkap"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                required
                            >
                        </div>

                        @error('name')
                            <div class="register-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="register-label">
                            Alamat Email
                        </label>

                        <div class="register-input-group">
                            <i class="bi bi-envelope register-input-icon"></i>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control register-input @error('email') is-invalid @enderror"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                            >
                        </div>

                        @error('email')
                            <div class="register-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="register-label">
                            Password
                        </label>

                        <div class="register-input-group">
                            <i class="bi bi-lock register-input-icon"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control register-input @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        @error('password')
                            <div class="register-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi password --}}
                    <div class="mb-3">
                        <label for="password_confirmation"
                               class="register-label">
                            Konfirmasi Password
                        </label>

                        <div class="register-input-group">
                            <i class="bi bi-shield-check register-input-icon"></i>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control register-input"
                                placeholder="Masukkan ulang password"
                                autocomplete="new-password"
                                required
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="bi bi-person-plus"></i>
                        Buat Akun Femora
                    </button>

                </form>

                <div class="register-login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">
                        Login di sini
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
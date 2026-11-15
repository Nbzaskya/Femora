
@extends('layouts.app')

@section('title', 'Login - Femora')

@section('styles')
<style>
    .auth-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px 15px;
        animation: authEnter .6s ease both;
    }

    .auth-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 100%;
        max-width: 970px;
        min-height: 570px;
        overflow: hidden;
        border: 1px solid #f0e5e9;
        border-radius: 26px;
        background: #fff;
        box-shadow: 0 15px 45px rgba(73, 58, 66, .08);
    }

    /* Brand panel */
    .auth-brand-panel {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        padding: 42px;
        background: linear-gradient(145deg, #fff4f5, #f8e4ec 60%, #eee7f7);
    }

    .auth-brand-panel::before,
    .auth-brand-panel::after {
        position: absolute;
        content: "";
        border: 1px solid rgba(201, 130, 159, .18);
        border-radius: 50%;
        pointer-events: none;
    }

    .auth-brand-panel::before {
        width: 280px;
        height: 280px;
        right: -100px;
        top: 90px;
    }

    .auth-brand-panel::after {
        width: 210px;
        height: 210px;
        right: -65px;
        top: 125px;
    }

    .auth-brand {
        position: relative;
        z-index: 1;
        color: #a95e7e;
        font-family: 'Playfair Display', serif;
        font-size: 30px;
        font-weight: 700;
    }

    .auth-brand span {
        margin-right: 7px;
        font-family: sans-serif;
        font-size: 23px;
    }

    .auth-brand-content {
        position: relative;
        z-index: 1;
        max-width: 360px;
        margin-top: 25px;
    }

    .auth-brand-content .eyebrow {
        color: #ae708b;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .auth-brand-content h2 {
        margin: 15px 0;
        color: #59434f;
        font-family: 'Playfair Display', serif;
        font-size: clamp(30px, 4vw, 43px);
        font-weight: 700;
        line-height: 1.25;
    }

    .auth-brand-content p {
        color: #88747f;
        font-size: 13px;
        line-height: 1.9;
    }

    .auth-flower {
        position: relative;
        z-index: 1;
        align-self: center;
        margin: 15px 0;
        color: rgba(174, 112, 139, .75);
        font-size: 105px;
        line-height: 1;
        animation: flowerFloat 4s ease-in-out infinite;
    }

    .auth-brand-footer {
        position: relative;
        z-index: 1;
        color: #987f8c;
        font-size: 10px;
    }

    /* Login panel */
    .auth-form-panel {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 45px;
        background: #fff;
    }

    .auth-form-content {
        width: 100%;
        max-width: 350px;
    }

    .auth-heading {
        margin-bottom: 30px;
    }

    .auth-heading .welcome-label {
        color: #b76d8d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .auth-heading h3 {
        margin: 10px 0;
        color: #493a42;
        font-family: 'Playfair Display', serif;
        font-size: 29px;
        font-weight: 700;
    }

    .auth-heading p {
        margin: 0;
        color: #998a92;
        font-size: 12px;
        line-height: 1.8;
    }

    .auth-label {
        display: block;
        margin-bottom: 8px;
        color: #594751;
        font-size: 12px;
        font-weight: 700;
    }

    .auth-input-group {
        position: relative;
    }

    .auth-input-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        color: #b58a9c;
        font-size: 14px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .auth-input {
        min-height: 46px;
        padding: 11px 13px 11px 40px;
        border: 1px solid #ebdfe5;
        border-radius: 11px;
        color: #493a42;
        font-size: 12px;
        box-shadow: none;
        transition: .2s ease;
    }

    .auth-input:focus {
        border-color: #c9829f;
        box-shadow: 0 0 0 3px rgba(201, 130, 159, .12);
    }

    .auth-input::placeholder {
        color: #b9aab1;
    }

    .auth-error {
        margin-top: 6px;
        color: #dc6679;
        font-size: 11px;
    }

    .auth-remember {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 18px 0 23px;
    }

    .auth-remember input {
        width: 15px;
        height: 15px;
        margin: 0;
        accent-color: #c9829f;
        cursor: pointer;
    }

    .auth-remember label {
        color: #897a82;
        font-size: 11px;
        cursor: pointer;
    }

    .btn-auth-login {
        display: flex;
        width: 100%;
        min-height: 46px;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 0;
        border-radius: 11px;
        background: linear-gradient(120deg, #c9829f, #b76d8d);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        box-shadow: 0 6px 15px rgba(201, 130, 159, .22);
        transition: .2s ease;
    }

    .btn-auth-login:hover {
        background: linear-gradient(120deg, #b76d8d, #a85b7d);
        color: #fff;
        transform: translateY(-2px);
    }

    .auth-register-link {
        margin-top: 25px;
        color: #95858d;
        font-size: 11px;
        text-align: center;
    }

    .auth-register-link a {
        color: #b76d8d;
        font-weight: 800;
        text-decoration: none;
    }

    .auth-register-link a:hover {
        color: #944c6d;
        text-decoration: underline;
    }

    @keyframes authEnter {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes flowerFloat {
        0%, 100% {
            transform: translateY(0) rotate(-5deg);
        }
        50% {
            transform: translateY(-9px) rotate(5deg);
        }
    }

    @media (max-width: 768px) {
        .auth-layout {
            grid-template-columns: 1fr;
            max-width: 480px;
        }

        .auth-brand-panel {
            min-height: 235px;
            padding: 25px 28px;
        }

        .auth-brand-content {
            margin-top: 28px;
        }

        .auth-brand-content h2 {
            font-size: 29px;
        }

        .auth-brand-content p {
            max-width: 320px;
            font-size: 11px;
        }

        .auth-flower {
            position: absolute;
            right: 25px;
            bottom: 15px;
            margin: 0;
            font-size: 70px;
        }

        .auth-brand-footer {
            display: none;
        }

        .auth-form-panel {
            padding: 35px 28px;
        }
    }

    @media (max-width: 400px) {
        .auth-page {
            padding: 20px 10px;
        }

        .auth-brand-panel {
            min-height: 215px;
        }

        .auth-form-panel {
            padding: 30px 20px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .auth-page,
        .auth-flower {
            animation: none !important;
        }

        .btn-auth-login {
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="auth-page">

    <div class="auth-layout">

        {{-- Brand panel --}}
        <div class="auth-brand-panel">

            <div class="auth-brand">
                <span>🌸</span>Femora.
            </div>

            <div class="auth-brand-content">
                <span class="eyebrow">A little space for yourself</span>

                <h2>Understand Your Cycle, Embrace Yourself.</h2>

                <p>
                    Kenali pola siklusmu, catat setiap perubahan,
                    dan luangkan waktu untuk memahami dirimu sendiri.
                </p>
            </div>

            <div class="auth-flower">✿</div>

            <div class="auth-brand-footer">
                Your cycle, your story, your journey.
            </div>

        </div>

        {{-- Login form --}}
        <div class="auth-form-panel">

            <div class="auth-form-content">

                <div class="auth-heading">
                    <span class="welcome-label">Welcome back</span>

                    <h3>Senang melihatmu lagi!</h3>

                    <p>
                        Masuk ke akun Femora untuk melanjutkan
                        perjalanan memahami siklusmu.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 py-2"
                         style="font-size:11px">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">

                        <label for="email" class="auth-label">
                            Alamat Email
                        </label>

                        <div class="auth-input-group">
                            <i class="bi bi-envelope auth-input-icon"></i>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control auth-input @error('email') is-invalid @enderror"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                            >
                        </div>

                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Password --}}
                    <div class="mb-3">

                        <label for="password" class="auth-label">
                            Password
                        </label>

                        <div class="auth-input-group">
                            <i class="bi bi-lock auth-input-icon"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control auth-input @error('password') is-invalid @enderror"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                            >
                        </div>

                        @error('password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Remember --}}
                    <div class="auth-remember">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <label for="remember">
                            Ingat saya
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-auth-login">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk ke Femora
                    </button>

                </form>

                <div class="auth-register-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">
                        Daftar sekarang
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
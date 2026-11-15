<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Femora')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --pink: #C9829F;
            --pink-dark: #A85F7D;
            --pink-light: #F8DDE5;
            --pink-soft: #FDF0F3;
            --cream: #FFF9F5;
            --white: #FFFFFF;
            --text: #493A42;
            --muted: #927E88;
            --purple: #E9E2F5;
            --lavender: #F2EDF8;
            --border-soft: #F0E3E9;
            --shadow-soft: 0 8px 28px rgba(93, 58, 76, .06);
            --shadow-hover: 0 14px 34px rgba(147, 91, 119, .13);
            --sidebar-width: 265px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(circle at 5% 5%, rgba(248,221,229,.55), transparent 27%),
                radial-gradient(circle at 95% 15%, rgba(233,226,245,.55), transparent 25%),
                var(--cream);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        h1, h2, h3, h4, h5 {
            color: var(--text);
            font-family: 'Playfair Display', serif;
            letter-spacing: -.4px;
        }

        a {
            color: var(--pink);
            text-decoration: none;
            transition: color .2s ease;
        }

        a:hover {
            color: var(--pink-dark);
        }

        /* AUTHENTICATION */

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            background: linear-gradient(135deg, #FFF9F5, #F8DDE5);
        }

        .auth-card {
            width: 100%;
            max-width: 450px;
            padding: 40px;
            background: var(--white);
            border: 1px solid rgba(240,227,233,.8);
            border-radius: 22px;
            box-shadow: var(--shadow-soft);
        }

        .brand {
            color: var(--pink);
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
        }

        /* FORM */

        .form-control,
        .form-select {
            padding: 12px 15px;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            background-color: #FFFEFD;
            transition: border-color .25s ease, box-shadow .25s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 4px rgba(201,130,159,.12);
        }

        .btn-femora {
            padding: 12px 20px;
            color: white;
            background: linear-gradient(135deg, #D18AA6, #B86F8D);
            border: none;
            border-radius: 13px;
            font-weight: 600;
            box-shadow: 0 5px 14px rgba(184,111,141,.2);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .btn-femora:hover {
            color: white;
            background: linear-gradient(135deg, #C47B99, #A85F7D);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(184,111,141,.3);
        }

        .btn-femora:active {
            transform: scale(.97);
        }

        /* GENERAL CARD */

        .dashboard-card {
            padding: 24px;
            background: var(--white);
            border: 1px solid rgba(240,227,233,.85);
            border-radius: 22px;
            box-shadow: var(--shadow-soft);
            transition: transform .3s ease, box-shadow .3s ease;
            animation: femoraFadeUp .65s ease both;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        /* MOBILE TOPBAR */

        .femora-mobile-header {
            display: none;
            position: sticky;
            top: 0;
            z-index: 1020;
            align-items: center;
            justify-content: space-between;
            padding: 13px 20px;
            background: rgba(255,255,255,.9);
            border-bottom: 1px solid var(--border-soft);
            backdrop-filter: blur(16px);
        }

        .mobile-brand {
            color: var(--pink);
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
        }

        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            color: var(--pink-dark);
            background: var(--pink-soft);
            border: 1px solid var(--border-soft);
            border-radius: 13px;
            font-size: 21px;
        }

        /* SIDEBAR */

        .femora-sidebar {
            width: var(--sidebar-width);
            background: rgba(255,255,255,.94);
            border-right: 1px solid rgba(240,227,233,.9);
        }

        .sidebar-inner {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 30px 20px 22px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 12px;
            margin-bottom: 42px;
        }

        .sidebar-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            color: var(--pink-dark);
            background: var(--pink-soft);
            border-radius: 15px;
            font-size: 22px;
        }

        .sidebar-brand-name {
            margin: 0;
            color: var(--pink);
            font-family: 'Playfair Display', serif;
            font-size: 29px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .sidebar-label {
            padding: 0 13px;
            margin-bottom: 13px;
            color: #B09DA6;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            color: #806D77;
            border-radius: 13px;
            font-size: 14px;
            font-weight: 600;
            transition: all .25s ease;
        }

        .sidebar-link:hover {
            color: var(--pink-dark);
            background: var(--pink-soft);
            transform: translateX(3px);
        }

        .sidebar-link.active {
            color: var(--pink-dark);
            background: linear-gradient(110deg, #FCEAF0, #F8DDE5);
            box-shadow: inset 3px 0 0 var(--pink);
        }

        .sidebar-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 23px;
            font-size: 18px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 24px;
        }

        .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 13px 10px;
            margin-bottom: 12px;
            background: #FFF8FA;
            border: 1px solid var(--border-soft);
            border-radius: 15px;
        }

        .profile-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 39px;
            height: 39px;
            color: var(--pink-dark);
            background: var(--pink-light);
            border-radius: 13px;
            font-size: 17px;
        }

        .profile-name {
            overflow: hidden;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-caption {
            color: var(--muted);
            font-size: 10px;
        }

        .sidebar-logout {
            width: 100%;
            padding: 11px 13px;
            color: #A56D80;
            background: transparent;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            transition: all .25s ease;
        }

        .sidebar-logout:hover {
            color: #9D4F6B;
            background: var(--pink-soft);
            border-color: var(--pink-light);
        }

        /* MAIN CONTENT */

        .femora-main {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding: 1px 0 35px;
        }

        /* ANIMATION */

        @keyframes femoraFadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* RESPONSIVE */

        @media (min-width: 992px) {
            .femora-sidebar {
                position: fixed !important;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1030;
                visibility: visible !important;
                transform: none !important;
            }

            .femora-sidebar .offcanvas-body {
                display: flex;
                flex-direction: column;
                flex: 1;
                overflow-y: auto;
                padding: 0;
            }

            .sidebar-inner {
                min-height: 100vh;
            }
        }

        @media (max-width: 991.98px) {
            .femora-mobile-header {
                display: flex;
            }

            .femora-main {
                margin-left: 0;
            }

            .femora-sidebar {
                width: 285px;
                border-right: 1px solid var(--border-soft);
            }

            .sidebar-inner {
                min-height: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .auth-card {
                padding: 28px 22px;
            }

            .femora-mobile-header {
                padding: 11px 15px;
            }
        }
    </style>

    @yield('styles')
</head>

<body>

    @auth
        <!-- HEADER KHUSUS MOBILE -->
        <header class="femora-mobile-header">
            <a href="{{ route('dashboard') }}" class="mobile-brand">
                Femora.
            </a>

            <button
                class="sidebar-toggle"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#femoraSidebar"
                aria-controls="femoraSidebar"
                aria-label="Buka menu navigasi">
                ☰
            </button>
        </header>

        <!-- SIDEBAR -->
        <aside
            class="offcanvas-lg offcanvas-start femora-sidebar"
            tabindex="-1"
            id="femoraSidebar"
            aria-labelledby="femoraSidebarLabel">

            <div class="sidebar-inner">

                <div class="offcanvas-header d-lg-none justify-content-between px-2 pt-2">
                    <span class="mobile-brand" id="femoraSidebarLabel">Femora.</span>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="offcanvas"
                        data-bs-target="#femoraSidebar"
                        aria-label="Tutup menu">
                    </button>
                </div>

                <div class="offcanvas-body">
                    <!-- BRAND -->
                    <a href="{{ route('dashboard') }}" class="sidebar-brand">
                        <span class="sidebar-brand-icon">🌸</span>
                        <span class="sidebar-brand-name">Femora.</span>
                    </a>

                    <!-- MENU -->
                    <div class="sidebar-label">Menu Utama</div>

                    <nav class="sidebar-nav">

                        <a href="{{ route('dashboard') }}"
                           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="sidebar-icon">⌂</span>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('menstrual.index') }}"
                           class="sidebar-link {{ request()->routeIs('menstrual.*') ? 'active' : '' }}">
                            <span class="sidebar-icon">🌸</span>
                            <span>Menstruasi</span>
                        </a>

                        <a href="{{ route('calendar.index') }}"
                           class="sidebar-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                            <span class="sidebar-icon">▦</span>
                            <span>Kalender</span>
                        </a>

                        <a href="{{ route('journal.index') }}"
                           class="sidebar-link {{ request()->routeIs('journal.*') ? 'active' : '' }}">
                            <span class="sidebar-icon">📔</span>
                            <span>Jurnal Harian</span>
                        </a>

                        <a href="{{ route('settings.cycle') }}"
                           class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                            <span class="sidebar-icon">⚙</span>
                            <span>Pengaturan</span>
                        </a>

                    </nav>

                    <!-- PROFIL DAN LOGOUT -->
                    <div class="sidebar-bottom">

                        <div class="sidebar-label">Akun</div>

                        <div class="sidebar-profile">
                            <div class="profile-avatar">♡</div>

                            <div class="overflow-hidden">
                                <div class="profile-name">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="profile-caption">
                                    Anggota Femora
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="sidebar-logout">
                                ↪ &nbsp; Keluar dari akun
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </aside>
    @endauth

    <!-- KONTEN HALAMAN -->
    <main class="{{ auth()->check() ? 'femora-main' : '' }}">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>
</html>
<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>DocSys – เอกสารสำหรับดาวน์โหลด</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css?v5') }}">
    <link rel="stylesheet" href="{{ asset('icon/bootstrap-icons.min.css?v5') }}">
    <link rel="stylesheet" href="{{ asset('css/font-face.css?v5') }}">
    <style>
        :root {
            --card-radius: 14px;
        }

        .doc-card {
            border-radius: var(--card-radius);
        }

        .doc-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(13, 110, 253, .08);
        }

        .badge-type {
            text-transform: uppercase;
            letter-spacing: .02em;
        }

        .sticky-top-blur {
            position: sticky;
            top: 0;
            z-index: 1020;
            backdrop-filter: blur(6px);
            background-color: color-mix(in srgb, var(--bs-body-bg) 85%, transparent);
        }

        .nav-docs > a.nav-link.active {
            color: var(--bs-success-text-emphasis) !important;
            background-color: var(--bs-success-bg-subtle) !important;
            border-color: var(--bs-success-border-subtle) !important;
        }

        .accordion-button {
            box-shadow: none !important;
            outline: none !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--bs-success-bg-subtle) !important;
            color: var(--bs-success-text-emphasis) !important;
            font-weight: 600 !important;
        }

        button.rounded-top-4.accordion-button.collapsed {
            border-bottom-left-radius: var(--card-radius) !important;
            border-bottom-right-radius: var(--card-radius) !important;
        }
    </style>
</head>

<body class="bg-body-tertiary">
    <!-- Header -->
    <nav class="sticky-top-blur shadow-sm">
        <div class="container py-3">
            <div class="d-inline-flex position-relative">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('images/logo-public.png') }}" width="44" alt="Logo DocSys">
                    <div>
                        <h1 class="h5 mb-0">
                            <a href="{{ route('public') }}"
                                class="text-decoration-none link-body-emphasis stretched-link">
                                DocSys – เอกสารสำหรับดาวน์โหลด
                            </a>
                        </h1>
                        <small class="text-secondary">รายการเอกสารสาธารณะ/ภายในองค์กร</small>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @include('layout.search-form')

    <!-- List -->
    <main class="pb-5">
        <div class="container">
            @yield('content')
            <div class="text-center text-secondary small mt-3">
                © 2025 DocSys
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

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
            border-bottom: 1px solid var(--bs-border-color);
        }

        #accordionDocSys {
            --bs-accordion-active-bg: var(--bs-success-bg-subtle);
            --bs-accordion-active-color: var(--bs-success-text-emphasis);
        }

        #accordionDocSys .accordion-button {
            outline: none !important;
            box-shadow: none !important;
            --bs-bg-opacity: 1;
        }

        #accordionDocSys .accordion-button.collapsed {
            background-color: rgba(var(--bs-tertiary-bg-rgb), var(--bs-bg-opacity)) !important;
        }

        @media (min-width: 992px) {
            .container-narrow {
                max-width: 920px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="sticky-top-blur">
        <div class="container container-narrow py-3">
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
        <div class="container container-narrow">
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

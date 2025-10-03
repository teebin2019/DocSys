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

    <!-- Toolbar -->
    <section class="py-3">
        <div class="container container-narrow">
            <form class="row g-2 align-items-center">
                <div class="col-12 col-md">
                    <label for="q" class="visually-hidden">ค้นหาเอกสาร</label>
                    <div class="input-group">
                        <span class="input-group-text bg-body">
                            <i class="bi bi-search"></i>
                        </span>
                        <input id="q" name="q" class="form-control"
                            placeholder="ค้นหาเอกสาร ชื่อ/คำอธิบาย" value="{{ $q }}">
                    </div>
                </div>
                <div class="col-6 col-md-auto">
                    <select class="form-select" name="category">
                        <option value="">ทุกหมวดหมู่</option>
                        @foreach ($categories as $_category)
                            <option value="{{ $_category->id }}"{{ $category == $_category->id ? ' selected' : '' }}>{{ $_category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-auto">
                    <select class="form-select" name="type">
                        <option value="">ทุกประเภท</option>
                        @foreach ($file_types as $item)
                            <option value="{{ $item }}"{{ $type == $item ? ' selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> ค้นหา</button>
                </div>
            </form>
        </div>
    </section>

    <!-- List -->
    <main class="pb-5">
        <div class="container container-narrow">

            @if ($documents->isEmpty())
                <div class="text-center text-muted mt-3">-- ไม่พบเอกสาร --</div>
            @endif

            @foreach ($documents as $document)
                <div class="card doc-card mb-3 border-light-subtle shadow-sm">
                    <div class="card-body">
                        <div class="d-flex gap-3">
                            <div class="doc-icon flex-shrink-0">
                                <i class="bi {{ $document->icon }} fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <h2 class="h6 mb-0">
                                        <a href="{{ $document->url }}" class="text-decoration-none lh-base" target="_blank">
                                            {{ $document->title }}
                                        </a>
                                    </h2>
                                    <span class="badge text-bg-light border">
                                        <i class="bi bi-bookmark-fill text-warning me-1"></i>
                                        {{ $document->category->name }}
                                    </span>
                                </div>

                                @if ($document->description != '')
                                    <div class="mt-1 text-secondary small">
                                        {{ $document->description }}
                                    </div>
                                @endif

                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <span class="badge rounded-pill border small text-muted">
                                        {{ $document->size }}
                                    </span>
                                    <span class="badge rounded-pill border small text-muted">
                                        <i class="bi bi-download me-1"></i> {{ $document->downloads }} ครั้ง
                                    </span>
                                    <span class="text-muted small ms-auto">
                                        {{ $document->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <div class="mt-3 d-flex flex-wrap gap-2">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ $document->url }}"
                                        target="_blank" rel="noopener">
                                        <i class="bi bi-box-arrow-up-right me-1"></i> เปิดดู
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="{{ $document->url }}"
                                        download="{{ $document->title }}" download>
                                        <i class="bi bi-download me-1"></i> ดาวน์โหลด
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            {{ $documents->withQueryString()->links('pagination::custom') }}

            <div class="text-center text-secondary small mt-3">
                © 2025 DocSys
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

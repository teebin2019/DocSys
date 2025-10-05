@extends('layout.main-public')

@section('content')
    <div class="mt-4">
        <div class="mb-4">
            <div id="carouselDocSysIndicators" class="carousel slide rounded-4 shadow" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($slides as $key => $slide)
                        <button type="button" data-bs-target="#carouselDocSysIndicators"
                            data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                            aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="{{ $slide->title }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner rounded-4">
                    @foreach ($slides as $key => $slide)
                        <div class="carousel-item rounded-4{{ $key == 0 ? ' active' : '' }}">
                            @if ($slide->url != null)
                                <a href="{{ $slide->url }}" target="_blank">
                                    <img src="{{ asset('storage/' . $slide->file_path) }}" class="rounded-4 d-block w-100"
                                        alt="{{ $slide->title }}">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $slide->file_path) }}" class="rounded-4 d-block w-100"
                                    alt="{{ $slide->title }}">
                            @endif
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDocSysIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDocSysIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="shadow bg-white px-3 py-4 rounded-4">
            <div class="d-md-flex justify-content-between align-items-center">
                <h1 class="fs-5">
                    <i class="bi bi-file-earmark"></i> เอกสารเผยแพร่
                </h1>

                <form action="{{ route('search') }}" class="row g-2">
                    <div class="col-12 col-md">
                        <label for="q" class="visually-hidden">ค้นหา</label>
                        <div class="input-group">
                            <span class="input-group-text bg-body">
                                <i class="bi bi-search"></i>
                            </span>
                            <input id="q" name="q" class="form-control" placeholder="ป้อนคำค้นหา"
                                value="{{ $q ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <button class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> ค้นหา</button>
                    </div>
                </form>
            </div>

            <nav class="nav nav-docs small gap-2 mt-3">
                @foreach ($categories as $index => $_category)
                    <a class="nav-link px-3 py-1 rounded-pill border shadow-sm{{ $_category->id == $category ? ' active' : '' }}"
                        href="{{ route('public', ['category' => $_category->id]) }}">{{ $_category->name }}</a>
                @endforeach
            </nav>
        </div>

        <div class="mt-3">
            @foreach ($departments as $index => $_department)
                <div class="accordion mb-3 shadow rounded-4" id="accordionDocSys">
                    <div class="accordion-item rounded-4 border-0">
                        <h2 class="accordion-header rounded-top-4">
                            <button class="rounded-top-4 accordion-button{{ $index > 0 ? ' collapsed' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $index }}">
                                <i class="bi bi-folder text-success me-2"></i> {{ $_department->name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}"
                            class="accordion-collapse collapse{{ $index == 0 ? ' show' : '' }}">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($_department->documents->take(100) as $_document)
                                        <li class="list-group-item d-flex justify-content-between py-1">
                                            <div>
                                                <i class="bi {{ $_document->icon }} me-1"></i>
                                                <a href="{{ $_document->url }}" target="_blank"
                                                    class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover"{{ $_document->file_type != 'pdf' ? ' download="' . htmlspecialchars(trim($_document->title)) . '"' : '' }}>{{ $_document->title }}</a>
                                                <span class="badge rounded-pill border small text-muted">
                                                    {{ $_document->size }}
                                                </span>
                                                <span class="badge rounded-pill border small text-muted">
                                                    <i class="bi bi-download me-1"></i> {{ $_document->downloads }}
                                                    ครั้ง
                                                </span>
                                            </div>
                                            <div class="text-nowrap">
                                                <span class="text-muted small ms-auto"
                                                    title="{{ $_document->created_at->format('d/m/Y H:i') }} น.">
                                                    {{ $_document->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($departments->isEmpty())
                <div class="text-muted p-4 text-center shadow rounded-4 bg-white mt-3">
                    -- ไม่พบเอกสาร --
                </div>
            @endif
        </div>
    </div>
@endsection

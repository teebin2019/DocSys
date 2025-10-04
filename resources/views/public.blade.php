@extends('layout.main-public')

@section('content')
    <div class="mt-4">

        <div class="d-flex justify-content-between">
            <h1 class="fs-5">
                <i class="bi bi-file-earmark"></i> เอกสารเผยแพร่
            </h1>

            <a href="{{ route('search') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-search"></i> ค้นหา
            </a>
        </div>

        <div class="mt-2">
            <ul class="nav nav-tabs">
                @foreach ($categories as $index => $_category)
                    <li class="nav-item">
                        <a class="nav-link{{ $_category->id == $category ? ' active' : '' }}"
                            href="{{ route('public', ['category' => $_category->id]) }}">
                            {{ $_category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="border border-top-0 p-3 rounded-bottom">
                <div class="accordion" id="accordionDocSys">
                    @foreach ($departments as $index => $_department)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button{{ $index > 0 ? ' collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $index }}">
                                    <i class="bi bi-folder text-primary me-2"></i> {{ $_department->name }}
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
                                                    <span class="text-muted small ms-auto" title="{{ $_document->created_at->format('d/m/Y H:i') }} น.">
                                                        {{ $_document->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($departments->isEmpty())
                        <div class="text-muted">-- ไม่พบเอกสาร --</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

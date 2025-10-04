@extends('layout.main-public')

@section('content')
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
                            <a class="btn btn-sm btn-outline-primary" href="{{ $document->url }}" target="_blank"
                                rel="noopener">
                                <i class="bi bi-box-arrow-up-right me-1"></i> เปิดดู
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ $document->url }}" download="{{ $document->title }}"
                                download>
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
@endsection

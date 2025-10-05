@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">เรียงลำดับภาพสไลด์</h4>
    <div class="small">
        * ลากเพื่อเรียงลำดับใหม่ตามต้องการ
    </div>

    <div class="mt-2">
        <form action="{{ route('slides_order_update') }}" method="POST">
            @csrf
            <div id="sort">
                @foreach ($slides as $slide)
                    <div class="row bg-light mb-2 mw-100">
                        <div class="col-md-3">
                            <div class="py-2 rounded-3">
                                <img src="{{ asset('storage/' . $slide->file_path) }}"
                                    class="img-fluid rounded-3 move-cursor" alt="{{ $slide->title }}"
                                    data-order="{{ $slide->order_by }}">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="py-2">{{ $slide->title }}</div>
                            <div class="small text-muted">{{ $slide->description }}</div>
                            <input type="hidden" name="order[]" value="{{ $slide->id }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-success">บันทึก</button>
                <a href="{{ route('slides') }}" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>
@endsection

@push('script_src')
    <script src="{{ asset('js/sortable.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        new Sortable(sort, {
            animation: 200,
            ghostClass: 'blue-background-class'
        });
    </script>
@endpush

@push('styles')
    <style>
        .blue-background-class {
            margin-right: 0;
            background-color: #C8EBFB;
            border-radius: var(--bs-border-radius-lg) !important;
        }
    </style>
@endpush

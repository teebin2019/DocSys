@extends('layout.main')

@section('content')
    <h1 class="text-center fs-4">หมวดหมู่เอกสารทั้งหมด</h1>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-archive-fill pe-2 text-warning"></i>
                            <a href="{{ route('categories_show', $category->id) }}">{{ $category->name }}</a>
                        </span>
                        <span class="badge text-bg-primary rounded-pill">{{ $category->file_count }} ไฟล์</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

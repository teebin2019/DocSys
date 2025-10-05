@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">แก้ไขภาพสไลด์</h4>
    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">

            @include('layout.form-error', [$errors])

            <form action="{{ route('slides_update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">ภาพสไลด์</label>
                    <div class="mb-1">
                        <img src="{{ asset('storage/' . $slide->file_path) }}" alt="{{ $slide->title }}" class="img-fluid rounded-3">
                    </div>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อภาพสไลด์ <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $slide->title) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">คําอธิบาย</label>
                    <textarea name="description" class="form-control">{{ old('description', $slide->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">ลิงก์</label>
                    <textarea name="url" class="form-control">{{ old('url', $slide->url) }}</textarea>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <a href="{{ route('slides') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
@endsection

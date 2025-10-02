@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'แก้ไขหมวดหมู่เอกสาร' }}</h4>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">
            <form action="{{ route('categories_update', $category->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">
                        ชื่อหมวดหมู่ <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        ลิงก์ (slug) <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">คำอธิบาย</label>
                    <textarea name="description" class="form-control">{{ $category->description }}</textarea>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <a href="{{ route('categories') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    @endsection

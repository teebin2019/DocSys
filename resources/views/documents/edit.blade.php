@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">แก้ไขข้อมูลเอกสาร</h4>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('documents_update', ['id' => $document->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">
                        ชื่อเอกสาร
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" placeholder="ปล่อยว่างหากต้องการใช้ชื่อไฟล์"
                        value="{{ old('title', $document->title) }}">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        หมวดหมู่ <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" required>
                        <option value="" disabled>-- เลือกหมวดหมู่ --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">ไฟล์เอกสาร (PDF, DOCX, XLSX, PPTX)</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                        name="file" accept=".pdf,.docx,.xlsx,.pptx">
                    @if ($document->file_path)
                        <div class="form-text">
                            ไฟล์ปัจจุบัน:
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">
                                {{ basename($document->file_path) }}
                            </a>
                        </div>
                    @endif
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="{{ route('categories_show', ['id' => $document->category_id]) }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
@endsection

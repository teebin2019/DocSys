@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'เพิ่มข้อมูลเอกสาร' }}</h4>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">
            @include('layout.form-error', [$errors])
            <form action="{{ route('documents_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">
                        ชื่อเอกสาร
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" placeholder="ปล่อยว่างหากต้องการใช้ชื่อไฟล์" value="{{ old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">
                        รายละเอียด
                    </label>
                    <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        หมวดหมู่ <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" required>
                        <option value="" selected>-- เลือกหมวดหมู่ --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="department_id" class="form-label">
                        หน่วยงาน/แผนกที่เกี่ยวข้อง
                    </label>
                    <select class="form-select @error('department_id') is-invalid @enderror" id="department_id"
                        name="department_id">
                        <option value="">-- เลือกหน่วยงาน/แผนก --</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">ไฟล์เอกสาร (PDF, DOCX, XLSX, PPTX) <span
                            class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                        name="file" accept=".pdf,.docx,.xlsx,.pptx" required>
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="{{ route('documents') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
@endsection

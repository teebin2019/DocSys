@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">เพิ่มหน่วยงาน</h4>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">
            @include('layout.form-error', [$errors])
            <form action="{{ route('departments_store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">ชื่อหน่วยงาน <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">รายละเอียด</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <a href="{{ route('departments') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
@endsection

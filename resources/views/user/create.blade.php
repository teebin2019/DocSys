@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'ผู้ใช้งาน' }}</h4>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-xxl-6">
            @include('layout.form-error', [$errors])
            <form action="{{ route('user_store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">
                        ชื่อ - สกุล <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="ใส่ชื่อ - สกุล"
                        value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        อีเมล <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="ใส่อีเมล"
                        value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="officer_id" class="form-label">
                        รหัสพนักงาน <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="officer_id" id="officer_id" value="{{ old('officer_id') }}"
                        required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                รหัสผ่าน <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                ยืนยันรหัสผ่าน <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" value="{{ old('password_confirmation') }}">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">
                        ระดับผู้ใช้ <span class="text-danger">*</span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="level0" value="user">
                        <label class="form-check-label" for="level0">
                            ผู้ใช้ทั่วไป
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="level1" value="admin" checked>
                        <label class="form-check-label" for="level1">
                            ผู้ดูแลระบบ (Admin)
                        </label>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy"></i> บันทึก
                    </button>

                    <a href="{{ route('user') }}" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

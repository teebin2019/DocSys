@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'หน่วยงาน/แผนก' }}</h4>
    <div class="row mb-2">
        <div class="col-6">
            <a href="{{ route('departments_create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i>
                เพิ่ม<span class="d-none d-md-inline">ข้อมูล</span>
            </a>
        </div>
        <div class="col-6">
            <form action="{{ route('departments') }}" class="d-inline" method="get" id="search-form">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control form-control-sm border-secondary-subtle"
                        placeholder="ใส่คำค้น" value="{{ $q }}">
                    <button class="btn btn-outline-secondary border-secondary-subtle" type="submit" id="search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('departments') }}" class="btn btn-outline-secondary border-secondary-subtle">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="10%">ลําดับ</th>
                    <th>ชื่อหน่วยงาน/แผนก</th>
                    <th class="text-center" width="15%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td class="text-center">
                            {{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $department->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('departments_edit', ['id' => $department->id]) }}"
                                class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                                แก้ไข
                            </a>
                            <form action="{{ route('departments_delete', ['id' => $department->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบหน่วยงาน/แผนกนี้?')">
                                    <i class="bi bi-trash"></i>
                                    ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if (!$departments->total())
                    <tr>
                        <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $departments->links() }}
    </div>

@endsection

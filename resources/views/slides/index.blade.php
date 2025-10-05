@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">ภาพสไลด์</h4>
    <div class="row mb-2">
        <div class="col-6">
            <a href="{{ route('slides_create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i>
                เพิ่ม<span class="d-none d-md-inline">ข้อมูล</span>
            </a>

            <a href="{{ route('slides_order') }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-sort-down-alt"></i>
                เรียงลำดับ<span class="d-none d-md-inline">ข้อมูล</span>
            </a>
        </div>
        <div class="col-6">
            <form action="{{ route('slides') }}" class="d-inline" method="get" id="search-form">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control form-control-sm border-secondary-subtle"
                        placeholder="ใส่คำค้น" value="{{ $q }}">
                    <button class="btn btn-outline-secondary border-secondary-subtle" type="submit" id="search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('slides') }}" class="btn btn-outline-secondary border-secondary-subtle">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center" width="10%">ลําดับ</th>
                    <th width="20%">ภาพสไลด์</th>
                    <th>ชื่อภาพสไลด์</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center" width="15%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slides as $slide)
                    <tr>
                        <td class="text-center">
                            {{ ($slides->currentPage() - 1) * $slides->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $slide->file_path) }}" alt="{{ $slide->title }}"
                                class="img-fluid rounded-3" width="250">
                        </td>
                        <td>{{ $slide->title }}</td>
                        <td class="text-center">
                            @if ($slide->status == 1)
                                <span class="badge bg-success">เปิดใช้งาน</span>
                            @else
                                <span class="badge bg-danger">ปิดใช้งาน</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('slides_edit', ['id' => $slide->id]) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                                แก้ไข
                            </a>
                            <form action="{{ route('slides_delete', ['id' => $slide->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบภาพสไลด์นี้?')">
                                    <i class="bi bi-trash"></i>
                                    ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $slides->withQueryString()->links() }}
    </div>
@endsection

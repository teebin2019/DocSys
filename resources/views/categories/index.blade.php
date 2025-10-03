@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'หมวดหมู่เอกสาร' }}</h4>
    <div class="row mb-2">
        <div class="col-6">
            <a href="{{ route('categories_create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i>
                เพิ่ม<span class="d-none d-md-inline">ข้อมูล</span>
            </a>
        </div>
        <div class="col-6">
            <form action="{{ route('categories') }}" class="d-inline" method="get" id="search-form">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control form-control-sm border-secondary-subtle"
                        placeholder="ใส่คำค้น" value="{{ $q }}">
                    <button class="btn btn-outline-secondary border-secondary-subtle" type="submit" id="search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('categories') }}" class="btn btn-outline-secondary border-secondary-subtle">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center" width="10%">ลําดับ</th>
                    <th scope="col">ชื่อหมวดหมู่</th>
                    <th scope="col" class="text-center" width="20%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">
                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <a href="{{ route('categories_show', $category->id) }}">{{ $category->name }}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('categories_edit', ['id' => $category->id]) }}"
                                class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                                แก้ไข
                            </a>
                            <form action="{{ route('categories_delete', ['id' => $category->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบหมวดหมู่นี้?')">
                                    <i class="bi bi-trash"></i>
                                    ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if (!$categories->total())
                    <tr>
                        <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $categories->withQueryString()->links() }}
    </div>
@endsection

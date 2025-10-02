@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'เอกสาร' }}</h4>

    <div class="row mb-2">
        <div class="col-6">
            <a href="{{ route('documents_create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i>
                เพิ่ม<span class="d-none d-md-inline">ข้อมูล</span>
            </a>
        </div>
        <div class="col-6">
            <form action="{{ route('documents') }}" class="d-inline" method="get" id="search-form">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control form-control-sm border-secondary-subtle"
                        placeholder="ใส่คำค้น" value="{{ $q }}">
                    <button class="btn btn-outline-secondary border-secondary-subtle" type="submit" id="search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('documents') }}" class="btn btn-outline-secondary border-secondary-subtle">
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
                    <th scope="col">ชื่อเอกสาร</th>
                    <th scope="col" class="text-center" width="20%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td class="text-center">
                            {{ ($documents->currentPage() - 1) * $documents->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $document->title }}</td>
                        <td>
                            <a href="{{ route('documents_edit', ['id' => $document->id]) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                                แก้ไข
                            </a>
                            <form action="{{ route('documents_delete', ['id' => $document->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบเอกสารนี้?')">
                                    <i class="bi bi-trash"></i>
                                    ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $documents->withQueryString()->links() }}
    </div>
@endsection

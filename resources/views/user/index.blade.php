@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'ผู้ใช้งาน' }}</h4>

    <div class="row mb-2">
        <div class="col-6">
            <a href="{{ route('user_create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> เพิ่ม<span class="d-none d-md-inline">ข้อมูล</span>
            </a>
        </div>
        <div class="col-6">
            <form action="{{ route('user') }}" class="d-inline" method="get" id="search-form">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control form-control-sm border-secondary-subtle"
                        placeholder="ใส่คำค้น" value="{{ $q }}">
                    <button class="btn btn-outline-secondary border-secondary-subtle" type="submit" id="search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('user') }}" class="btn btn-outline-secondary border-secondary-subtle">
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
                    <th class="text-center">ลําดับ</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อีเมล</th>
                    <th class="text-center" width="15%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center" nowrap>
                            <a href="{{ route('user_edit', ['id' => $user->id]) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> แก้ไข
                            </a>
                            @if ($me->id == $user->id)
                                <button type="button" class="btn btn-sm btn-danger" disabled>
                                    <i class="bi bi-trash"></i> ลบ
                                </button>
                            @else
                                <form action="{{ route('user_delete', ['id' => $user->id]) }}" method="post"
                                    class="d-inline" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger confirm">
                                        <i class="bi bi-trash"></i> ลบ
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
@endsection

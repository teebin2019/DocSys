@extends('layout.main')

@section('content')
    <h4 class="mb-3 text-center">{{ $title ?? 'แสดงข้อมูลหมวดหมู่เอกสาร' }}</h4>

    <div class="mb-3">
        <form action="{{ route('categories_upload', ['id' => $category->id]) }}" method="post">
            @csrf
            <div id="dropzone" class="dropzone dz-message needsclick"></div>
        </form>
    </div>

    <div class="row mb-2">
        <div class="col-6">
        </div>
        <div class="col-6">
            <form action="{{ route('categories_show', ['id' => $category->id, 'q' => $q]) }}" class="d-inline" method="get"
                id="search-form">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control form-control-sm border-secondary-subtle"
                        placeholder="ใส่คำค้น" value="{{ $q }}">
                    <button class="btn btn-outline-secondary border-secondary-subtle" type="submit" id="search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('categories_show', ['id' => $category->id, 'department' => $department]) }}"
                        class="btn btn-outline-secondary border-secondary-subtle">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <a href="{{ route('categories_show', ['id' => $category->id, 'q' => $q, 'department' => '']) }}"
                    class="list-group-item list-group-item-action{{ $department == '' ? ' active' : '' }}">
                    ทุกหน่วยงาน
                </a>
                @foreach ($departments as $item)
                    <a href="{{ route('categories_show', ['id' => $category->id, 'q' => $q, 'department' => $item->id]) }}"
                        class="list-group-item list-group-item-action{{ $department == $item->id ? ' active' : '' }}">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" width="10%">ลําดับ</th>
                            <th scope="col">ชื่อเอกสาร</th>
                            <th scope="col" class="text-center" width="25%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td class="text-center">
                                    {{ ($documents->currentPage() - 1) * $documents->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    <a href="{{ $document->url }}" target="_blank">{{ $document->title }}</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('documents_edit', ['id' => $document->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                        แก้ไข
                                    </a>
                                    <form action="{{ route('categories_document_delete', ['id' => $document->id]) }}"
                                        method="POST" class="d-inline">
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

                        @if (!$documents->total())
                            <tr>
                                <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $documents->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/dropzone/dropzone.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#dropzone", {
            url: "{{ route('categories_upload', ['id' => $category->id, 'department' => $department ?? '']) }}",
            paramName: "file",
            maxFilesize: 10, // MB
            timeout: 0,
            dictDefaultMessage: '<i class="bi bi-file-earmark-arrow-down"></i> เลือกหรือวางไฟล์ที่ต้องการอัปโหลดที่นี่',
            acceptedFiles: ".pdf,.jpg,.jpeg,.png,.gif,.webp,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').getAttribute('value')
            },
            init: function() {
                this.on("success", function(file, response) {
                    setTimeout(() => window.location.reload(), 500);
                });
                this.on("error", function(file, err) {
                    console.error(err);
                    alert('อัปโหลดไม่สำเร็จ: ' + (err?.message || 'ตรวจรูปแบบไฟล์/ขนาด'));
                });
            }
        });

        // $('#uploadFile').click(function() {
        //     myDropzone.processQueue();
        // });
    </script>
@endpush

@push('styles')
    <style>
        #dropzone {
            border: 2px dashed #ccc;
        }
    </style>
@endpush

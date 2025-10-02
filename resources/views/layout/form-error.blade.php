@if ($errors->any())
    <div class="bs-callout bs-callout-danger mt-0 rounded-3">
        <div class="fw-bold">
            <i class="bi bi-exclamation-triangle"></i> พบข้อผิดพลาดดังนี้
        </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<ul class="list-unstyled admin-menu ps-0">
    <li class="mb-1">
        <div class="d-grid">
            <button class="btn btn-toggle d-inline-flex justify-content-between align-items-center rounded border-0"
                data-bs-toggle="collapse" data-bs-target="#d-0-collapse" aria-expanded="true">
                เมนูการใช้งาน
            </button>
        </div>
        <div class="collapse show" id="d-0-collapse" style="">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{ route('index') }}"
                        class="link-body-emphasis d-flex text-decoration-none rounded{{ Request::is('index') ? ' active' : '' }}">
                        <i class="bi bi-house-door pe-2"></i> หน้าหลัก
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @if (Auth::check() && Auth::user()->role == 'admin')
        <li class="mb-1">
            <div class="d-grid">
                <button class="btn btn-toggle d-inline-flex justify-content-between align-items-center rounded border-0"
                    data-bs-toggle="collapse" data-bs-target="#d-1-collapse" aria-expanded="true">
                    ส่วนผู้ดูแลระบบ
                </button>
            </div>
            <div class="collapse show" id="d-1-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('documents') }}"
                            class="link-body-emphasis d-flex text-decoration-none rounded{{ Request::is('documents*') ? ' active' : '' }}">
                            <i class="bi bi-files pe-2"></i> ข้อมูลไฟล์เอกสาร
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories') }}"
                            class="link-body-emphasis d-flex text-decoration-none rounded{{ Request::is('categories*') ? ' active' : '' }}">
                            <i class="bi bi-archive pe-2"></i> หมวดหมู่เอกสาร
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments') }}"
                            class="link-body-emphasis d-flex text-decoration-none rounded{{ Request::is('departments*') ? ' active' : '' }}">
                            <i class="bi bi-building pe-2"></i> หน่วยงาน/แผนก
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user') }}"
                            class="link-body-emphasis d-flex text-decoration-none rounded{{ Request::is('user*') ? ' active' : '' }}">
                            <i class="bi bi-people pe-2"></i> ข้อมูลผู้ใช้ระบบ
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>

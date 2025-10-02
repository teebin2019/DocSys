<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title : config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css?v5') }}">
    <link rel="stylesheet" href="{{ asset('icon/bootstrap-icons.min.css?v5') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css?v5') }}">
    @stack('styles')
</head>

<body class="h-100">

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid justify-content-start">
            <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand py-0 me-md-auto" href="{{ route('index') }}">
                <img src="{{ asset('images/logo.png') }}" height="38" width="100%"
                    alt="logo admin">
            </a>
            @auth
                <div class="dropdown d-none d-md-block">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person"></i> {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        {{-- <li>
                            <a class="dropdown-item" href="{{ route('personal_profile') }}">
                                <i class="bi bi-person-badge"></i> ข้อมูลส่วนตัว
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('personal_change_password') }}">
                                <i class="bi bi-file-earmark-lock"></i> เปลี่ยนรหัสผ่าน
                            </a>
                        </li> --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-left"></i> ออกจากระบบ
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </nav>

    <div class="container-fluid ps-layout">

        <aside class="ps-sidebar">
            <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="offcanvasResponsive"
                aria-labelledby="offcanvasResponsiveLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">เมนูการใช้งาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="my-3 w-100 me-0 me-lg-3">
                        @include('layout.sidebar')
                    </div>
                </div>
            </div>
        </aside>
        <main class="order-1 pt-1 pt-lg-3 mb-4">
            @include('layout.breadcrumbs')
            <div class="m-0">@yield('content')</div>
        </main>
    </div>

    <div id="ps_loader" style="display: none;">
        <div class="ps-loader-content">
            <div class="text-center">
                <div class="ps-loader"></div>
                <div class="mt-3">กำลังดำเนินการ...</div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('script_src')
    @stack('script_include')
    @include('sweetalert::alert')
    @stack('scripts')
</body>

</html>

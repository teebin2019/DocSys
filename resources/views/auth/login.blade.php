<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css?v5') }}">
    <style>
        body {
            background: radial-gradient(rgb(210, 241, 223), rgb(211, 215, 250), rgb(186, 216, 244)) 0% 0%/400% 400% !important;
        }
    </style>
</head>

<body>
    <section class="py-3 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 offset-xl-4 col-md-12 col-12">
                    <div class="text-center">
                        <div class="mb-0">
                            <img src="{{ asset('images/logo.png') }}" height="100" alt="logo admin">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 col-12">
                    <div class="card border-0 shadow-sm mb-4 rounded-4">
                        <div class="card-body p-4 pb-5">
                            <h4 class="text-center">ระบบยืนยันตัวตน</h4>
                            <p class="text-center">กรอกอีเมลและรหัสผ่านที่ถูกต้อง</p>
                            <form action="{{ route('login_store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" autofocus required>
                                    @if ($errors->has('email'))
                                        <div class="text-danger small mt-2">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg btn-primary">เข้าสู่ระบบ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('sweetalert::alert')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitButton = form.querySelector("button[type=submit]");

            form.addEventListener("submit", function() {
                submitButton.textContent = "กำลังเข้าสู่ระบบ..";
                submitButton.disabled = true;
            });
        });
    </script>
</body>

</html>

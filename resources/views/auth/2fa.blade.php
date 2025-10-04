<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css?v5') }}">
    <link rel="stylesheet" href="{{ asset('css/font-face.css?v5') }}">
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
                            <h4 class="text-center">ระบบยืนยันตัวตนขั้นตอนที่สอง</h4>
                            <p class="text-center">กรอกรหัสความปลอดภัยจากมือถือของท่าน</p>
                            <form action="{{ route('login_2fa_store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="secret_code" class="form-label">
                                        รหัสความปลอดภัย 6 หลัก <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="secret_code" id="secret_code"
                                        autocomplete="off" maxlength="6" minlength="6" autofocus required>
                                    @if ($errors->has('secret_code'))
                                        <div class="text-danger small mt-2">{{ $errors->first('secret_code') }}</div>
                                    @endif
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg btn-primary">ยืนยัน</button>
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

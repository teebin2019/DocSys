@if (config('sweetalert.animation.enable'))
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
@endif

@if (config('sweetalert.theme') != 'default')
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-{{ config('sweetalert.theme') }}" rel="stylesheet">
@endif

@if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@endif
<script>
    const btns = document.querySelectorAll(".confirm");
    btns.forEach((b) => {
        b.addEventListener('click', function(event) {
            var form = b.closest("form");
            console.log(form);
            event.preventDefault();
            var title = b.getAttribute('confirm-title') || 'ยืนยันการดำเนินการ';
            var message = b.getAttribute('confirm-message') ||
                'เมื่อลบแล้ว จะไม่สามารถกู้คืนได้ โปรดยืนยัน';
            var icon = b.getAttribute('confirm-icon') || 'warning';
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#0a58ca',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    var valid = form[0]?.checkValidity();
                    if (valid) {
                        form.submit();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด',
                            text: 'โปรดกรอกข้อมูลให้ครบถ้วน'
                        })
                    }
                }
            })
        });
    });

    @if (Session::has('alert.config'))
        Swal.fire({!! Session::pull('alert.config') !!});
    @endif
</script>

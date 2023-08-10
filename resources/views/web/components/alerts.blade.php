@if ($success = session('success'))
    <script>
        Swal.fire(
            'Thành Công',
            '{{$success}}',
            'success',
        )
    </script>
@elseif ($warning = session('warning'))
    <script>
        Swal.fire(
            'Cảnh báo',
            '{{$warning}}',
            'warning',
        )
    </script>
@elseif ($error = session('error'))
    <script>
        Swal.fire(
            'Lỗi',
            '{{$error}}',
            'error',
        )
    </script>
@elseif ($info = session('info'))
    <script>
        Swal.fire(
            'Thông báo',
            '{{$info}}',
            'info',
        )
    </script>
@elseif ($notification = session('notification'))
    <script>
        Swal.fire(
            '<strong>Bạn đã hoàn thành bài thi</strong>',
            '{{$notification}}',
            'info',
        )
    </script>
@elseif ($complete = session('complete'))
    <script>
        Swal.fire({
            title: '<strong>Bạn đã hoàn thành bài thi</strong>',
            icon: 'info',
            text: '{{$complete}}',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Ứng tuyển',
            cancelButtonText:
                'Đóng',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ session()->get('link') }}';
                } else{
                    Swal.clickCancel();
                }

            })
    </script>
@endif

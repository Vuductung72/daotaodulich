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
@endif
{{-- @push('scripts')
    <script>
        setTimeout(() => {
          $('#alerts').addClass("d-none")
        },4000);
    </script>
@endpush --}}

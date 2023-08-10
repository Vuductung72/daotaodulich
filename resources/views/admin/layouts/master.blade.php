<!DOCTYPE html>
<!--suppress ALL -->
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('page_title')</title>

    @yield('head')

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset(config('constant.logo')) }}" />
    <meta name="keywords" content="đào tạo du lịch, đào tạo lễ tân, đào tạo nghiệp vụ nhà hàng, đào tạo nghiệp vụ khách sạn" />
    <meta name="description" content="Đào tạo kiến thức về các ngành nghề du lịch, nhà hàng, khách sạn" />
    <meta property="og:title" content="@yield('page_title')" />
    <meta property="og:site_name" content="daotaonghedulich.com" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:description" content="Đào tạo kiến thức về các ngành nghề du lịch, nhà hàng, khách sạn" />
    <meta property="og:url" content="@yield('page_og:url')" />
    <meta property="og:image" content="{{ asset('images/logo-atm.jpg') }}" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="{{ asset('assets/css_account/d-AppContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css_account/d-Deposit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css_account/d-MemberCenter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css_account/d-MemberCenterProfile.css') }}">
    @stack('css')
    <style>
        .tox-tinymce-aux {
            z-index: 10000000 !important;
        }

        .hide-not-important {
            display: none;
        }

        .portlet-body .pagination {
            margin: 0 !important;
            float: unset;
        }
        .display-none{
            display: none;
        }
        .page-footer {
            position: fixed;
            bottom: 0;
            background: rgb(43,54,67);
            width: 100%;
            z-index: 99999999;
        }
        .scroll-to-top>i{
            position: absolute;
            top: -50px;
            left: -10px;
        }
        .page-sidebar{
            position: fixed !important;
        }
    </style>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('global/plugins/sweetalert2@11.js') }}"></script>
</head>

<body class="loaded page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
    <div id="box-loading">
        <div class="bg-over-loading" style="left: 0; max-width: 100%;">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div id="app">
        <div class="page-wrapper">

            @include('admin.layouts.includes.header')

            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <div class="page-container">
                @include('admin.layouts.includes.sidebar')
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        @include('admin.layouts.includes.breadcrumb')
                        <!-- BEGIN PAGE TITLE-->
                        {{--                        <h1 class="page-title"> --}}
                        {{--                            @yield('page_title') --}}
                        {{--                        </h1> --}}
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        @include('admin.components.errors')

                        @yield('content')

                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>

            @include('admin.layouts.includes.footer')
        </div>
    </div>

    <!--[if lt IE 9]>
    <script src="{{ asset('global/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('global/plugins/excanvas.min.js') }}"></script>
    <script src="{{ asset('global/plugins/ie8.fix.min.js') }}"></script>
    <![endif]-->

    <script type="text/javascript">
        let baseUrl = '{{ url('/') }}';
        window.flashMessages = [];

        @if ($success = session('success'))
            window.flashMessages = [{
                'type': 'success',
                'message': "{{ $success }}"
            }];
        @elseif ($warning = session('warning'))
            window.flashMessages = [{
                'type': 'warning',
                'message': "{{ $warning }}"
            }];
        @elseif ($error = session('error'))
            window.flashMessages = [{
                'type': 'error',
                'message': "{{ $error }}"
            }];
        @elseif ($info = session('info'))
            window.flashMessages = [{
                'type': 'info',
                'message': "{{ $info }}"
            }];
        @endif

        //Helper function
        function commaSeparateNumber(val) {
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d+)(\d{3})/, '$1' + '.' + '$2');
            }
            return val;
        }

        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        function previewMedia(input, elementId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(elementId).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $(elementId).attr('src', '{{ asset('images/no_image.png') }}');
            }
        }
    </script>

    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/loader.js') }}" type="text/javascript"></script>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    @stack('scripts')
    <script>
        function deleteRecord(){
            event.preventDefault();
            var form = event.target;
            Swal.fire({
                title: 'Thông báo',
                text: "Bạn có thực sự muốn xóa không?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
        }
    </script>
</body>

</html>

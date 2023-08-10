<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title> 

    <link rel="shortcut icon" type="image/png" href="{{ asset(config('constant.logo')) }}" />
    <link rel="stylesheet" href="{{ asset('web/asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/asset/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/asset/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/asset/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/asset/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/asset/select2/select2.min.css') }}">
    <meta name="keywords" content="@yield('page_keywords')" />              
    <meta name="description" content="@yield('page_description')" />
    <meta property="og:title" content="@yield('page_title')" />
    <meta property="og:site_name" content="daotaonghedulich.com" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:description" content="@yield('page_description')" />
    <meta property="og:url" content="{{request()->url()}}" />
    <meta property="og:image" content="@yield('page_og:image')" />

    @stack('css')
    <script src="{{ asset('global/plugins/sweetalert2@11.js') }}"></script>
</head>

<body>
    {{-- check alerts of web  --}}
    @include('customer.components.alerts')

    {{-- check erorrs of web  --}}
    @include('customer.components.errors')
    {{-- header --}}
    @include('customer.layouts.includes.header')
    <!--end header -->

    <main id="page-home">
        
        @yield('content')

        <!-- overlay mobille -->
        <div class="navbarMobile--overlay"></div>


    </main>

    {{-- footer --}}
    @include('customer.layouts.includes.footer')
    {{-- end footer --}}

    <div class="scroll-to-top"><span class="fa fa-angle-double-up"></span></div>


    <!--  -->
    <script src="{{ asset('web/asset/js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('web/asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('web/asset/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/asset/js/popper.min.js') }}"></script>
    <script src="{{ asset('web/asset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/asset/js/wow.min.js')}}"></script>
    <script src="{{ asset('web/asset/js/main.js') }}"></script>

    <script src="{{ asset('web/asset/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('web/asset/select2/select2.min.js') }}"></script>

    {{-- <script src="{{ asset('web/js/splide.min.js') }}"></script>
    <script src="{{ asset('web/js/splide-extension-auto-scroll.min.js') }}"></script> --}}
    <script src="{{ asset('web/asset/js/validate.js') }}"></script>
    <script>
        new WOW().init();
    </script>

    @stack('scripts')
</body>

</html>

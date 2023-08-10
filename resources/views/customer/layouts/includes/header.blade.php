<header>
    <div class="header__bottom">
        <div class="container">
            <nav class="navbar navbar navbar-expand-lg navbar-dark ">

                <!-- btn toggle -->
                <div class="d-flex">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false"
                    aria-label="Toggle navigation">
                        <span class="nav-toggler">
                            <i class="fa-solid fa-bars bars"></i>
                            <i class="fa-solid fa-xmark xmark"></i>
                        </span>
                    </button>
                </div>
                
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        @if (Auth::guard('customer')->check())
                            @if (auth('customer')->user()->type == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('us.expert.index')}}">Thông tin</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('us.internship.index')}}">Thông tin</a>
                            </li>
                            @endif
                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('us.login.index')}}">Đăng nhập</a>
                            </li>                  
                        @endif
                        
                    </ul>
                </div>

                <a class="navbar-logo-customer" href="/">
                    <img src="{{ asset( 'images/logo-atm.webp') }}" alt="">
                </a>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">               
                        @if (Auth::guard('customer')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('us.login.logout')}}">Đăng xuất</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('us.register.create')}}">Đăng ký</a> 
                            </li>                  
                        @endif
                    </ul>
                </div>


            </nav>
            <!-- Mobile -->
            <nav class="navbarMobile" id="navbarMobile">
                <ul class="nav navbar-nav">
                    @if (Auth::guard('customer')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="/">Thông tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('us.login.logout')}}">Đăng xuất</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('us.login.index')}}">Đăng nhập</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('us.register.create')}}">Đăng ký</a> 
                        </li>  
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.input_submit').submit(function(e){
                $('#formSearch').submit();
            });
        })
    </script>
@endpush

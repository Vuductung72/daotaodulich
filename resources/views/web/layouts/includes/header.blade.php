<header>
    <div class="container">
        <div class="header__top">
            <div class="header__top--right">
                <div class="header__search">
                    <form action="{{route('w.course.search')}}" method="GET" id="formSearch">
                        @csrf
                        <input type="text" class="search__input" name="course" value="{{ isset($key_course) ? $key_course : ''}}" placeholder="Tìm kiếm khóa học">
                        <button class="search__button input_submit">
                            <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                                <g>
                                    <path
                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                </path>
                            </g>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="header__top--left  d-flex">      
                @if (Auth::guard('user')->check())

                    <a href="{{ route('w.course.bought')}}" class="mycourse-btn">Khóa học đã mua</a>
                    <ul class="header__info">
                        <li class="info__item">
                            <a href="{{ route('w.tai-khoan.index') }}" title="" class="info__link d-flex">
                                <img src="{{ customer()->user()->avatar ? asset(customer()->user()->avatar) : asset('web/asset/images/avatar-mac-dinh.png') }}" alt="">
                                <div class="info__username">
                                    <span class="text-dark">{{ customer()->user()->name }}</span>
                                </div>
                            </a>
                            <ul class="info__menu">
                                <li class="info__menu__item">
                                    <a href="{{ route('w.tai-khoan.index') }}" title="">Thông tin tài khoản</a>
                                </li>
                                <li class="info__menu__item">
                                    <a href="{{ route('w.payment.recharge') }}" title="">Nạp tiền</a>
                                </li>
                                <li class="info__menu__item">
                                    <a href="{{ route('w.course.bought')}}" title="">Khóa học đã mua</a>
                                </li>
                                <li class="info__menu__item">
                                    <a href="{{route('w.logout')}}" title="">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    </ul>   

                @else
                    <a class="btn-header" href="{{route('w.get_register')}}">Đăng kí</a> 
                    <a class="btn-header" href="{{route('w.get_login')}}">Đăng nhập</a>                    
                @endif
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <nav class="navbar navbar navbar-expand-lg navbar-dark">
                <!-- btn toggle -->
                <div class="d-flex">
                    @if (Auth::guard('user')->check())
                    <a href="{{ route('w.tai-khoan.index') }}" class="header-action-user">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    @endif
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false"
                    aria-label="Toggle navigation">
                        <span class="nav-toggler">
                            <i class="fa-solid fa-bars bars"></i>
                            <i class="fa-solid fa-xmark xmark"></i>
                        </span>
                    </button>
                     
                </div>

                <!-- search mobile -->
                <div class="header__search search__mobille">
                    <input type="text" class="search__input" placeholder="Tìm kiếm khóa học">
                    <button class="search__button">
                        <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                            <g>
                                <path
                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
                

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is(['gioi-thieu*']) ? 'active' : '' }}" href="{{ route('w.introduce') }}">Giới thiệu</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['khoa-hoc*']) ? 'active' : '' }}" href="{{route('w.course.index')}}">Khóa học</a>
                            <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                                @foreach ($list_profession as $profession)
                                    <a class="dropdown-item" href="{{route('w.course.get_courses',$profession->slug)}}">{{ucfirst($profession->name)}}</a>  
                                @endforeach                                 
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['chuyen-gia*']) ? 'active' : '' }}" href="{{route('w.expert.index')}}">Chuyên gia</a>
                            <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                                @foreach ($list_profession as $profession)
                                    <a class="dropdown-item" href="{{route('w.expert.search_by_profession',$profession->slug)}}">{{ucfirst($profession->name)}}</a>  
                                @endforeach                             
                            </div>
                        </li>
                    </ul>
                </div>

                <a class="navbar-logo" href="{{route('w.home')}}">
                    <img src="{{ asset( config('constant.logo')) }}" alt="">
                </a>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['thuc-tap*']) ? 'active' : '' }}" href="{{route('w.internship.index')}}">Thực tập</a>
                            <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                                @foreach ($list_profession as $profession)
                                    <a class="dropdown-item" href="{{route('w.internship.search_by_profession',$profession->slug)}}">{{ucfirst($profession->name)}}</a>  
                                @endforeach 
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['danh-sach-bai-viet*']) ? 'active' : '' }}" href="{{route('w.blog.index')}}"> Tin tức </a>
                            <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                                @foreach ($list_category as $category)
                                    <a class="dropdown-item" href="{{route('w.blog.getBySlug',$category->slug)}}">{{ucfirst($category->name)}}</a>                                    
                                @endforeach                              
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is(['lien-he*']) ? 'active' : '' }}" href="{{ route('w.contact.index') }}">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Mobile -->
            <nav class="navbarMobile" id="navbarMobile">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is(['gioi-thieu*']) ? 'active' : '' }}" href="{{ route('w.introduce') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['khoa-hoc*']) ? 'active' : '' }}" href="{{route('w.course.index')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Khóa học</a>
                        <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('w.course.index')}}">Tất cả khóa học</a>
                            @foreach ($list_profession as $profession)
                                <a class="dropdown-item" href="{{route('w.course.get_courses',$profession->slug)}}">{{ucfirst($profession->name)}}</a>  
                            @endforeach 
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['chuyen-gia*']) ? 'active' : '' }}" href="{{route('w.expert.index')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chuyên gia</a>
                        <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('w.expert.index')}}">Tất cả chuyên gia</a> 
                            @foreach ($list_profession as $profession)
                                <a class="dropdown-item" href="{{route('w.expert.search_by_profession',$profession->slug)}}">{{ucfirst($profession->name)}}</a>  
                            @endforeach                                     
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['thuc-tap*']) ? 'active' : '' }}" href="{{route('w.internship.index')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thực tập</a>
                        <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('w.internship.index')}}">Tất cả đơn vị thực tập</a> 
                            @foreach ($list_profession as $profession)
                                <a class="dropdown-item" href="{{route('w.internship.search_by_profession',$profession->slug)}}">{{ucfirst($profession->name)}}</a>  
                             @endforeach 
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['danh-sach-bai-viet*']) ? 'active' : '' }}" href="{{route('w.blog.index')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Tin tức </a>
                        <div class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('w.blog.index')}}">Tất cả bài viết</a>  
                            @foreach ($list_category as $category)
                                    <a class="dropdown-item" href="{{route('w.blog.getBySlug',$category->slug)}}">{{ucfirst($category->name)}}</a>                                    
                            @endforeach                                      
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is(['lien-he*']) ? 'active' : '' }}" href="{{ route('w.contact.index') }}">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::guard('user')->check())
                            <a class="btn-header" href="{{route('w.logout')}}">Đăng xuất</a>
                        @else
                            <a class="btn-header" href="{{route('w.get_register')}}">Đăng kí</a> 
                            <a class="btn-header" href="{{route('w.get_login')}}">Đăng nhập</a>                    
                        @endif
                    </li>
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

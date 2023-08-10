@extends('web.layouts.master')
@section('page_title', 'ATM - ACADEMY')
@section('page_keywords', config('constant.page_keywords'))
@section('page_description', config('constant.page_description'))
@section('content')
    @include('web.layouts.includes.slider')

    <div id="page-home">
        {{-- training profession  --}}
        <section id="introduce"> 
            <div class="container"> 
                <h3>Ngành nghề đào tạo</h3> 
                <div class="introduce__top"> 
                    <a href="{{ $configs['link_nghe_le_tan'] }}" title="" class="introduce__career" > 
                        <div class="introduce__career--icon"> 
                            <img class="lazyload" data-src="{{ asset( 'web/asset/images/icon1.webp') }}" alt=""> 
                        </div> 
                        <div class="introduce__career__title"> 
                            <span>Nghề lễ tân</span> 
                        </div> 
        
                    </a> 
                    <a href="{{ $configs['link_nghe_buong'] }}" title="" class="introduce__career" > 
                        <div class="introduce__career--icon"> 
                            <img class="lazyload" data-src="{{ asset( 'web/asset/images/icon3.webp') }}" alt=""> 
                        </div> 
                        <div class="introduce__career__title"> 
                            <span>Nghề Buồng</span> 
                        </div> 
        
                    </a> 
                </div> 
        
                <div class="introduce__logo"> 
                    <img class="img-logo lazyload" data-src="{{ asset( 'web/asset/images/logo-atm.webp') }}" alt="" > 
                    <div class="circle1"></div> 
                    <div class="circle2"></div> 
                    <div class="circle3"></div> 
                    <div class="circle4"></div> 
                    <div class="arrow-1 arrow"> 
                        <img class="lazyload" data-src="{{ asset('web/asset/images/arrow-1.png')}}" alt=""> 
                    </div> 
                    <div class="arrow-2 arrow"> 
                        <img class="lazyload" data-src="{{ asset('web/asset/images/arrow-2.png')}}" alt=""> 
                    </div> 
                    <div class="arrow-3 arrow"> 
                        <img class="lazyload" data-src="{{ asset('web/asset/images/arrow-3.png')}}" alt=""> 
                    </div> 
                    <div class="arrow-4 arrow"> 
                        <img class="lazyload" data-src="{{ asset('web/asset/images/arrow-4.png')}}" alt=""> 
                    </div> 
                </div> 
                <div class="introduce__footer"> 
                    <a href="{{ $configs['link_mien_phi'] }}" title="" class="introduce__career" > 
                        <div class="introduce__career--icon"> 
                            <img class="lazyload" data-src="{{ asset( 'web/asset/images/icon2.webp') }}" alt=""> 
                        </div> 
                        <div class="introduce__career__title"> 
                            <span>Miễn phí</span> 
                        </div> 
        
                    </a> 
                    <a href="{{ $configs['link_nghe_nha_hang'] }}" title="" class="introduce__career" > 
                        <div class="introduce__career--icon"> 
                            <img class="lazyload" data-src="{{ asset( 'web/asset/images/icon4.webp') }}" alt=""> 
                        </div> 
                        <div class="introduce__career__title"> 
                            <span>Nghề Nhà Hàng</span> 
                        </div> 
        
                    </a> 
                </div> 
            </div> 
        </section>


        <section id="atm-reason">
            <div class="container">
                <h3>Lí do bạn nên học ở ATM ACADEMY</h3>
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="reason wow animate__animated animate__fadeInDown" >
                            <img class="lazyload" data-src="{{ asset('web/asset/images/icon-ts-1.webp')}}" alt="">
                            <h4>Giảng viên uy tín</h4>
                            <span>Bài giảng chất lượng</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="reason wow animate__animated animate__fadeInUp" >
                            <img class="lazyload" data-src="{{ asset('web/asset/images/icon-ts-2.webp')}}" alt="">
                            <h4>Thanh toán một lần</h4>
                            <span>Học linh hoạt</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="reason wow animate__animated animate__fadeInDown" >
                            <img class="lazyload" data-src="{{ asset('web/asset/images/icon-ts-3.webp')}}" alt="">
                            <h4>Học trực tuyến</h4>
                            <span>Hỗ trợ trực tiếp</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="reason wow animate__animated animate__fadeInDown" >
                            <img class="lazyload" data-src="{{ asset('web/asset/images/icon-ts-4.webp')}}" alt="">
                            <h4>Nhận chứng chỉ</h4>
                            <span>100% có việc làm</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- phan hoi khach hang -->
        <!-- feedback of customer-->
        {{-- <section id="feedback">
            <div class="container">
                <h3>Mọi người nói gì về chúng tôi</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="feedback-customer wow animate__animated animate__fadeIn">
                            <h4 class="text-center title-section my-4">Học viên nói gì về chúng tôi</h4>
                            <div id="slider-feedback-customer">
                                @foreach ($feedbacksStudent as $key=>$item)
                                    <input type="radio" name="slider" id="s{{ $item->position_display }}" {{$key == 1 ? 'checked' : ''}}>
                                @endforeach
                                @foreach ($feedbacksStudent as $item)
                                    <label for="s{{ $item->position_display }}" id="slide{{ $item->position_display }}" class="d-flex">
                                        <div class="box-images">
                                            <img src="{{ $item->avatar }}"
                                                alt="avatar-student">
                                        </div>
                                        <div class="box-text">
                                            <h5 class="name-customer">{{ $item->name }}</h5>
                                            <p class="khoa-hoc"> {{ $item->position }}</p>
                                            <p class="desc">{!! $item->content !!}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="feedback-partners wow animate__animated animate__fadeIn">
                            <h4 class="text-center title-section my-4">Đối tác nói gì về chúng tôi</h4>
                            <div id="slider-feedback-partners">
                                @foreach ($feedbacksPartner as $key=>$item)
                                    <input type="radio" name="slider2" id="p{{ $item->position_display }}" {{$key == 1 ? 'checked' : ''}}>
                                @endforeach
                                @foreach ($feedbacksPartner as $item)
                                    <label for="p{{ $item->position_display }}" id="feedback-parner-{{ $item->position_display }}" class="d-flex">
                                        <div class="box-images">
                                            <img src="{{ $item->avatar }}"
                                                alt="avatar-student">
                                        </div>
                                        <div class="box-text">
                                            <h5 class="name-customer">{{ $item->name }}</h5>
                                            <p class="khoa-hoc"> {{ $item->position }}</p>
                                            <p class="desc">{!! $item->content !!}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}


        <section id="feedback">
            <div class="container">
                <h3>mọi người nói gì về chúng tôi</h3>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="feedback-student">
                            <h4 class="text-center">Học viên</h4>
                            <div class="feedback-body">
                                <div class="slider-feedback owl-carousel owl-theme">
                                    @foreach ($feedbacksStudent as $item)
                                        <div class="item">
                                            <div class="feedback-info">
                                                <div class="user-img">
                                                    <img class="owl-lazy" data-src="{{ $item->user_id > 0 ? $item->user->avatar : $item->avatar }}" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <h5>{{ $item->user_id > 0 ? $item->user->name : $item->name }}</h5>
                                                    <div class="show-star">
                                                        @for ($i = 0; $i < $item->star; $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $item->star; $i++)
                                                            <i class="fa-regular fa-star"></i>
                                                        @endfor
                                                        <span class="num-vote">({{ $item->star }}/5)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="verifyed">
                                                <span>
                                                    <i class="fa fa-check-double"></i>
                                                    Đã từng học tại ATM ACADEMY
                                                </span>
                                            </div>
                                            <div class="user-content">
                                                <p>
                                                    {!! $item->content !!}
                                                </p>
                                                @if ($item->course)
                                                    <small>
                                                        Khóa học: 
                                                        <a href="{{route('w.course.show',$item->course->slug)}}">{{ $item->course->name }}</a>
                                                    </small>                                                    
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feedback-partner">
                            <h4 class="text-center">Đối tác</h4>
                            <div class="feedback-body">
                                <div class="slider-feedback owl-carousel owl-theme">
                                    @foreach ($feedbacksPartner as $item)
                                    <div class="item">
                                        <div class="feedback-info">
                                            <div class="user-img">
                                                <img class="owl-lazy" data-src="{{ $item->avatar }}" alt="">
                                            </div>
                                            <div class="user-info">
                                                <h5>{{ $item->name }}</h5>
                                                <div class="show-star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="num-vote">(5/5)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="verifyed">
                                            <span>
                                                <i class="fa fa-check-double"></i>
                                                {{ $item->position }}
                                            </span>
                                        </div>
                                        <div class="user-content">
                                            <p>
                                                {!! $item->content !!}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- partner's logo-->
        <section id="our-partners">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Đối tác</h4>
                        <div class="slider-logo-partners owl-carousel owl-theme">
                            @foreach ($partner as $item)
                            <div class="item">
                                <a href="{{$item->url == null ? route('w.home') : $item->url}}" class="logo-partner" target="_blank">
                                    <img class="lazyload" data-src="{{ $item->image }}" alt="logo net5s">
                                </a> 
                            </div>
                            @endforeach
                            
                            {{-- <div class="item">
                                <h4>
                                    <div class="logo-partner">
                                        <img class="lazyload" data-src="{{ asset('web/asset/images/logo_doi_tac/net5s.png') }}" alt="logo net5s">
                                    </div>
                                </h4>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

        </section>

        {{-- news --}}
        <section id="recent-news">
            <div class="container">
                <h3>Tin tức gần đây</h3>
                <div class="list-news">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-12 col-lg-4">
                                <div class="news-item">
                                    <a href="{{route('w.blog.show',['category_slug' => $blog->category->slug,'blog_slug' => $blog->slug])}}" class="news-item-link">
                                        <img class="w-100" src="{{ asset($blog->image) }}" alt="Image-HasTech">
                                        <div class="news-item-meta">
                                            <div class="news-item-date"><i class="fa-regular fa-calendar-days"></i>{{ \Carbon\Carbon::createFromDate($blog->created_at)->format('d/m/Y') }}</div>
                                            {{-- <div class="news-item-views"><i class="fa-regular fa-eye"></i> 290 Views</div> --}}
                                        </div>
                                        <h4 class="news-item-title">{{ $blog->name }}</h4>
                                        {{-- <p class="news-item-desc">{{ $blog->description }}</p> --}}
                                    </a>
                                </div>  
                            </div>                    
                        @endforeach
                        <div class="col-12 text-center">
                            <a href="{{route('w.blog.index')}}" class="btn-header btn-news">Xem thêm >> </a>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

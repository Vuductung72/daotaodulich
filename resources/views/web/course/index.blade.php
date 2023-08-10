@extends('web.layouts.master')
@section('page_title', 'Danh sách khóa học')
@section('page_keywords', config('constant.page_keywords_course'))
@section('page_description', config('constant.page_description_course'))
@section('page_og:image',config('constant.page_images_course'))
@section('content')
    <section id="page-course">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 col-md-4">
                    <div class="shop-sidebar">
                        <div class="d-flex align-items-center">
                            <button class="btn_menu-shop"><i class="fa-solid fa-bars"></i></button>
                            <span
                            class="ml-3 d-block d-md-none text-white title">Danh mục con</span>
                        </div>
                        <div id="grey_back"></div>
                        <div id="menu_shop">
                            <div class="by-industry">
                                <h4 class="title">NGÀNH NGHỀ</h4>
                                @foreach ($professions as $profession)
                                    <a href="{{route('w.course.get_courses',$profession->slug)}}" class="d-flex align-items-center">
                                        <i class="fa-solid fa-graduation-cap"></i><h5 class="{{request()->is(['nganh-nghe/'.$profession->slug]) ? 'text-primary professionId' : ''}}" id="{{$profession->id}}">{{$profession->name}}</h5>
                                    </a>                                    
                                @endforeach
                            </div>
                            <div class="by-filter">
                                <form data-url="{{route('w.course.arrange')}}" id="formArrange">
                                    <h4 class="title">SẮP XẾP THEO</h4>
                                    <div class="custom-checkbox">
                                        <label for="sale" class="form-check-label">
                                            <input class="form-check-input click_submit" type="checkbox" name="sale" value="" id="sale"> <span>Đang giảm giá</span>
                                        </label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <label for="news" class="form-check-label">
                                            <input class="form-check-input click_submit" type="checkbox"  id="news" value="" name="news"> <span>Mới nhất</span>
                                        </label>
                                    </div>
                                </form>
                            </div>  
                        </div>               
                    </div>
                </div>
                <div class="col-12 col-lg-9 col-md-8 show-product-search">
                    <div class="row show-product">
                        @if ($courses->count())
                            @foreach ($courses as $course)
                                <div class="col-12 col-lg-4">
                                    <div class="product-learning">
                                        <div class="box-images">
                                            <a href="{{route('w.course.show',$course->slug)}}" class="link-img">
                                                <img src="{{ asset($course->thumb)}}" alt="assc">
                                            </a>
                                        </div>
                                        <div class="box-info">
                                            <div class="course-name">
                                                <a href="{{route('w.course.show',$course->slug)}}">{{ ucwords($course->name)}}</a>
                                                @if ($course->time_sale > \Carbon\Carbon::now())
                                                    <small class="text-info">(Khuyến mãi đến: {{ \Carbon\Carbon::createFromDate($course->time_sale)->format('H:i | d-m-Y') }})</small>
                                                @endif
                                            </div>
                                            <div class="course-scorms">
                                                <p class="course-fee" style="position: relative;">
                                                    <i style="position: absolute; top: -1px;"><svg version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            width="13px" height="13px" viewBox="0 0 20 20"
                                                            style="overflow:visible;enable-background:new 0 0 20 20;"
                                                            xml:space="preserve">
                                                            <defs> </defs>
                                                            <path
                                                                d="M10,0C4.48,0,0,4.48,0,10s4.48,10,10,10s10-4.48,10-10S15.52,0,10,0z M8,14.5v-9l6,4.5L8,14.5z"
                                                                fill="#ef6c6c"></path>
                                                        </svg></i>
                                                    <span style="padding-left: 20px;">{{ $course->lessons->count()}}</span> Bài học
                                                </p>
                                                <p class="course-fee" style="position: relative;">
                                                    @if ( customer()->user())
                                                        @if (auth('user')->user()->courseBuys ? auth('user')->user()->courseBuys->where('course_id',$course->id)->count() : 0)
                                                            <i class="fa-solid fa-square-check" style="color:green"></i>    
                                                            <span style="color:green;padding-left: 5px;"> Đã đăng ký</span>
                                                        @else
                                                            <i class="fa-solid fa-money-bill-1-wave"></i> Giá:
                                                            {{-- <h1>{{ $course}}</h1> --}}
                                                            {{-- @if ($course->price_sale)
                                                                <span style="padding-left: 5px;color:red"> {{ number_format($course->price_sale ,0,",",".")}}</span> đ
                                                            @endif
                                                            <span style="padding-left: 5px;{{($course->price_sale) ? 'text-decoration-line:line-through' : 'color:red'}}">{{ number_format($course->price ,0,",",".")}}</span> đ --}}
                                                            @if ($course->price_sale !== null)
                                                                @if ( $course->time_sale === null)
                                                                    @if ($course->price_sale === 0)
                                                                        <span style="padding-left: 5px;color:red">Khóa học miễn phí</span> 
                                                                    @else
                                                                        <span style="padding-left: 5px;color:red"> {{ number_format($course->price_sale ,0,",",".")}}</span> đ                                                                    
                                                                        <span style="padding-left: 5px;text-decoration-line:line-through">{{ number_format($course->price ,0,",",".")}}</span> đ
                                                                    @endif
                                                                @elseif ($course->time_sale > \Carbon\Carbon::now())
                                                                    @if ($course->price_sale === 0)
                                                                        <span style="padding-left: 5px;color:red">Khóa học miễn phí</span> 
                                                                    @else
                                                                        <span style="padding-left: 5px;color:red">{{ number_format($course->price_sale ,0,",",".")}}</span> đ
                                                                        <span style="padding-left: 5px;text-decoration-line:line-through">{{ number_format($course->price ,0,",",".")}}</span> đ
                                                                    @endif
                                                                @else
                                                                    @if ($course->price === 0)
                                                                    <span style="padding-left: 5px;color:red">Khóa học miễn phí</span> 
                                                                    @else
                                                                        <span style="padding-left: 5px;color:red">{{ number_format($course->price ,0,",",".")}}</span> đ                                                            
                                                                    @endif                                                                
                                                                @endif
                                                            @else
                                                                @if ($course->price === 0)
                                                                    <span style="padding-left: 5px;color:red">Khóa học miễn phí</span> 
                                                                @else
                                                                    <span style="padding-left: 5px;color:red">{{ number_format($course->price ,0,",",".")}}</span> đ                                                            
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @else
                                                        <i class="fa-solid fa-money-bill-1-wave"></i> Giá:
                                                        @if ($course->price_sale !== null)
                                                                @if ( $course->time_sale == null || $course->time_sale > \Carbon\Carbon::now())
                                                                    @if ($course->price_sale === 0)
                                                                        <span style="padding-left: 5px;color:red">Khóa học miễn phí</span> 
                                                                    @else
                                                                        <span style="padding-left: 5px;color:red"> {{ number_format($course->price_sale ,0,",",".")}}</span> đ                                                                    
                                                                        <span style="padding-left: 5px;text-decoration-line:line-through">{{ number_format($course->price ,0,",",".")}}</span> đ
                                                                    @endif
                                                                @elseif ($course->time_sale < \Carbon\Carbon::now())
                                                                    <span style="padding-left: 5px;color:red"> {{ number_format($course->price ,0,",",".")}}</span> đ                                                                 
                                                                @endif
                                                            @else
                                                                @if ($course->price === 0)
                                                                    <span style="padding-left: 5px;color:red">Khóa học miễn phí</span> 
                                                                @else
                                                                    <span style="padding-left: 5px;color:red">{{ number_format($course->price ,0,",",".")}}</span> đ                                                            
                                                                @endif
                                                            @endif
                                                    @endif
                                                </p>
                                                
                                                <span class="course-register"><i class="fa-solid fa-user"></i> {{$course->courseBuys ? $course->courseBuys->count() : '0'}} lượt đăng kí</span>
                                            
                                            </div>
                                            <a href="{{route('w.course.show',$course->slug)}}" title="Xem chi tiết" class="course-view-more "><i class="fa-solid fa-eye mr-1"></i> <span>Xem chi tiết</span></a>
                                            @if ( auth('user')->user())
                                                @if (auth('user')->user()->courseBuys ? auth('user')->user()->courseBuys->where('course_id',$course->id)->count() : 0)
                                                    <a href="{{route('w.learn.index',$course->slug)}}" title="Học ngay" class="course-view-more bg-warning"><i class="fa-solid fa-chalkboard mr-1"></i> Học ngay</a>
                                                @else
                                                    @if ($course->price === 0)
                                                        <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square mr-1"></i> Khóa học miễn phí</a>                                                
                                                    @elseif ($course->price_sale === 0)
                                                        @if ($course->time_sale == null || $course->time_sale > \Carbon\Carbon::now())
                                                            <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square mr-1"></i> Khóa học miễn phí</a>   
                                                        @else
                                                            <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square mr-1"></i> Đăng kí ngay</a>                                               
                                                        @endif
                                                    @else    
                                                        <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square mr-1"></i>Đăng kí ngay!</a>                                            
                                                    @endif
                                                @endif
                                            @else
                                                <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square mr-1"></i> Đăng ký</a>                                                                                                    
                                            @endif
                                        </div>
                                    </div>
                                </div>                            
                            @endforeach
                            <div class="col-12 text-center">
                                {{ $courses->links()}}    
                            </div>
                        @else
                            <div class="col-12">
                                <h5 class="text-center">Không tìm thấy khóa học phù hợp</h5>    
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('scripts')
    <script>
        function checkValueElement(element){
            if(element.val() == ''){
                element.val('1');
            }else if(element.val() == 1){
                element.val('');
            }
        }
        $(document).ready(function(){
            $('.click_submit').click(function(e){
                let professionId = null;
                let url = $('#formArrange').attr('data-url');
                var element = $(`#${e.target.id}`);
                checkValueElement(element);
                let sale = $('#sale').val();
                let news = $('#news').val();
                professionId = $('.professionId').attr('id');
                let token = $('[name=csrf-token]').attr('content');

                $.ajax({
                    url: url,
                    type:'POST',
                    data: {_token: token, sale:sale, news:news, profession_id: professionId},
                    success: function(data) {
                        $('.show-product-search').html(data);
                    }
                });  
            });
        })
    </script>
@endpush
@endsection

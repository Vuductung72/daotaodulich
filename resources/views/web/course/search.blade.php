<div class="row show-product">
    @if ($courses->count())
        @foreach ($courses as $course)
            <div class="col-md-6 col-lg-4 col-12 col-sm-6">
                <div class="product-learning">
                    <div class="box-images">
                        {{-- <div class="icon-hot">hot</div> --}}
                        <a href="{{route('w.course.show',$course->id)}}" class="link-img">
                            <img src="{{ asset($course->thumb)}}" alt="assc">
                        </a>
                    </div>
                    <div class="box-info">
                        <div class="course-name">
                            <a href="{{route('w.course.show',$course->slug)}}">{{ $course->name}}</a>
                        </div>
                        {{-- <p class="name-teacher">Giáo viên:
                            <a href="">Cô Trần Thị Vân Anh</a>
                        </p> --}}
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
                                @if ( auth('user')->user())
                                    @if (auth('user')->user()->courseBuys ? auth('user')->user()->courseBuys->where('course_id',$course->id)->count() : 0)
                                        <i class="fa-solid fa-square-check" style="color:green"></i>    
                                        <span style="color:green;padding-left: 5px;"> Đã đăng ký</span>
                                    @else
                                        <i class="fa-solid fa-money-bill-1-wave"></i> Giá:
                                        @if ($course->price_sale)
                                            <span style="padding-left: 5px;color:red"> {{ number_format($course->price_sale ,0,",",".")}}</span> đ
                                        @endif
                                        <span style="padding-left: 5px;{{($course->price_sale)?'text-decoration-line:line-through':'color:red'}}">{{ number_format($course->price ,0,",",".")}}</span> đ
                                    @endif
                                @else
                                    <i class="fa-solid fa-money-bill-1-wave"></i> Giá:
                                    @if ($course->price_sale)
                                        <span style="padding-left: 5px;color:red"> {{ number_format($course->price_sale ,0,",",".")}}</span> đ
                                    @endif
                                    <span style="padding-left: 5px;{{($course->price_sale)?'text-decoration-line:line-through':'color:red'}}">{{ number_format($course->price ,0,",",".")}}</span> đ
                                @endif
                            </p>
                            <span class="course-register"><i class="fa-solid fa-user"></i> {{$course->courseBuys ? $course->courseBuys->count() : '0'}} lượt đăng kí</span>
                        </div>
                        <a href="{{route('w.course.show',$course->slug)}}" title="Xem chi tiết" class="course-view-more "><i class="fa-solid fa-eye"></i> <span>Xem chi tiết</span></a>
                        @if ( auth('user')->user())
                            @if (auth('user')->user()->courseBuys ? auth('user')->user()->courseBuys->where('course_id',$course->id)->count() : 0)
                                <a href="{{route('w.learn.index',$course->slug)}}" title="Học ngay" class="course-view-more bg-warning"><i class="fa-solid fa-chalkboard"></i> Học ngay</a>
                            @else
                                <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square"></i> Đăng ký</a>                                                                                                    
                                @endif
                                @else
                                <a href="{{route('w.course.register',$course)}}" title="Đăng ký" class="course-view-more bg-danger"><i class="fa-solid fa-pen-to-square"></i> Đăng ký</a>                                                                                                    
                        @endif
                        {{-- <a href="{{route('w.course.show',$course->id)}}" title="Xem chi tiết" class="course-view-more ">Xem chi tiết</a> --}}
                    </div>
                </div>
            </div>                            
        @endforeach
        {{-- <div class="col-12 text-center">
            {{ $courses->links()}}     
        </div> --}}
    @else
        <div class="col-12">
            <h5 class="text-center">Không tìm thấy khóa học phù hợp</h5>    
        </div> 
    @endif
</div>
 {{-- <div class="row show-paginate d-flex justify-content-center mt-3">
    {{ $courses->links() }}
</div>     --}}

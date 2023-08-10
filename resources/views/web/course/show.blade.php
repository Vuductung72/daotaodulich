@extends('web.layouts.master')
@section('page_title', 'Thông tin chi tiết khóa học '.$course->name)
@section('page_keywords', $course->keyword)
@section('page_description', $course->description)
@section('page_og:image', asset($course->thumb))
@section('content')

<section id="page-course-details">
    <div class="page-course-header">
        <div class="container">
            <h2 class="course-title">{{ ucfirst($course->name)}}</h2>
            <p class="course-desc">{{ ucfirst($course->description)}}</p>
            <div class="course-more-info">
                <div class="show-star">
                    @for ($i = 0; $i < $avg_star; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @for ($i = 0; $i < 5 - $avg_star; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                    <span class="num-vote">({{$feedbacks->count()}} đánh giá)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="page-course-body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">

                    @if ($course->benefits->count())
                        <div class="what-you-learn">
                            <div class="info-head">
                                <h3>Bạn nhận được những gì</h3>
                            </div>
                            <div class="what-you-learn-body">
                                <ul>
                                    @foreach ($course->benefits as $benefit)
                                        <li>
                                            <i class="fa fa-check" style="color: #0ced50; font-size: 20px"></i>
                                            <span>{{ ucfirst($benefit->content)}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="course-content">
                        <div class="info-head">
                            <h3>Nội dung khóa học</h3>
                        </div>
                        @if ($course->lessons->count())
                            <div class="course-content-body info-body">
                                <ul class="course-list">
                                    <li>
                                        <a href="javascript:void(0);" class="lesson-part" >
                                            <div class="lesson-title">
                                                <span>
                                                    <i class="fa-solid fa-chevron-up"></i>
                                                    Danh sách các bài học
                                                </span>
                                            </div>
                                            <div class="lesson-quantity">
                                                <span>{{ $course->lessons->count()}} bài</span>
                                            </div>
                                        </a>
                                        <ul class="list-lecture">
                                            @foreach ($course->lessons as $lesson)
                                                <li>
                                                    <div class="lecture-item">
                                                        <span>
                                                            <i class="fa-solid fa-book" style="color: #1558cb;"></i>
                                                            {{$lesson->name}}
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="suitable-for-course">
                        {!! $course->describe !!}
                    </div>

                    {{-- feeback of student --}}
                    <div class="feedback-course mt-3">
                        @if ($feedbacks->count())
                            <div class="info-head">
                                <h3 class="m-0">Cảm nhận về khóa học</h3>
                            </div>
                            <div class="feedback-course-body info-body">
                                <ul class="list-feedback-course">
                                    @foreach ($feedbacks as $feedback)
                                        <li class="my-3">
                                            <div class="reviews-item">
                                                <div class="student-info">
                                                    <div class="user-img">
                                                        <img src="{{ asset(($feedback->user_id > 0) ? $feedback->user->avatar : $feedback->avatar) }}" alt="">
                                                    </div>
                                                    <div class="user-info">
                                                        <h5>{{ ($feedback->user_id > 0) ? $feedback->user->name : $feedback->name }}</h5>
                                                        <div class="show-star">
                                                            @for ($i = 0 ; $i < $feedback->star; $i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                            <span class="num-vote">({{ $feedback->star}}/5)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="verifyed">
                                                    <span>
                                                        <i class="fa fa-check-double"></i>
                                                        Đã từng học tại ATM ACADEMY
                                                    </span>
                                                </div>
                                                <div class="message">
                                                    <p>{!! $feedback->content !!}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="col-12 text-center">
                                        {{ $feedbacks->links()}}
                                    </div>
                                </ul>
                            </div>
                        @endif

                        {{-- feeback of yourself --}}
                        @if ($course_buyed)
                            <div class="feedback-course-input">
                                <div class="info-head">
                                    <h3>Cảm nhận về khóa học của bạn</h3>
                                </div>
                                <form action="{{route('w.course.feedback',$course)}}" id="feedback-course-form" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <textarea name="content" id="content" cols="5" rows="8" class="form-control" placeholder="Cảm nhận về khóa học của bạn ..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <h4>Đánh giá về khóa học của bạn:</h4>
                                        <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                            <input type="radio" id="star5" name="star" value="5" /><label for="star5" title="5 star"></label>
                                            <input type="radio" id="star4" name="star" value="4" /><label for="star4" title="4 star"></label>
                                            <input type="radio" id="star3" name="star" value="3" /><label for="star3" title="3 star"></label>
                                            <input type="radio" id="star2" name="star" value="2" /><label for="star2" title="2 star"></label>
                                            <input type="radio" id="star1" name="star" value="1" /><label for="star1" title="1 star"></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-button text-center">
                                        <button  id="submit" class="form-submit w-100">Đánh giá</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="course-order">
                        @if (!$course_buyed)
                            <div class="course-fee">
                                @if ($course->price_sale !== null)
                                    @if ($course->time_sale === null || $course->time_sale > \Carbon\Carbon::now())
                                        @if ($course->price_sale === 0)
                                            <span class="new-fee" style="margin: 0 auto;">Khóa học miễn phí</span>
                                        @else
                                            <span class="new-fee">{{ number_format($course->price_sale ,0,",",".")}} VND</span>
                                            <span class="{{ $course->price_sale != null ? 'old-fee' : 'new-fee'}}">{{ number_format($course->price ,0,",",".")}} VND</span>
                                        @endif
                                    @elseif ($course->time_sale < \Carbon\Carbon::now())
                                        @if ($course->price === 0)
                                            <span class="new-fee" style="margin: 0 auto;">Khóa học miễn phí</span>
                                        @else
                                            <span class="new-fee" style="margin: 0 auto;">{{ number_format($course->price ,0,",",".")}} VND</span>
                                        @endif
                                    @endif
                                @else
                                    @if ($course->price === 0)
                                        <span class="new-fee" style="margin: 0 auto;">Khóa học miễn phí</span>
                                    @else
                                        <span class="new-fee" style="margin: 0 auto;">{{ number_format($course->price ,0,",",".")}} VND</span>
                                    @endif
                                @endif
                            </div>
                            @if ( $course->time_sale > \Carbon\Carbon::now())
                                <div class="course-end-discount">
                                    <p class="text-center"><b>Giảm giá đến</b>: {{ \Carbon\Carbon::createFromDate($course->time_sale)->format('H:i | d-m-Y') }}</p>
                                </div>
                            @endif
                        @endif
                        <div class="course-purchase">
                            @if ($course_buyed)
                                <a href="{{route('w.learn.index',$course->slug)}}" class=" btn-course">Click ngay để học</a>
                                <div class="box-btn-exam">
                                    @if ($course_examed && $course_success)
                                        <a class="bg-success btn-course w-100">Đã hoàn thành</a>
                                    @elseif($course_examed)
                                        <a class="btn-course-exam w-100" id="retest">Thi lại</a>
                                    @else
                                        @if ($courseUser == null)
                                            <a href="{{ route('w.certificate.index', $course->slug) }}" class="btn-course-exam w-100">Thi ngay</a>
                                        @else
                                            @if ($courseUser->status == 0)
                                                <div class="btn-course-exam">Yêu cầu thi ngay của bạn đang xử lý</div>
                                            @else
                                                <a href="{{route('w.exam.exam',$course->slug)}}" class="btn-course-exam w-100">Làm bài thi</a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            @else
                                <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>
                            @endif

                            <span>Học sớm đi làm sớm</span>
                            <div class="course-includes">
                                <h4>Bao gồm:</h4>
                                <ul>
                                    <li><i class="fa-regular fa-file"></i> {{ $course->lessons->count()}} bài học</li>
                                    <li><i class="fa-regular fa-clock"></i> Hỗ trợ hỏi đáp 8h - 22h mỗi ngày</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="order-fixed">
        <div class="course-fee">
            @if (!$course_buyed)
                @if ($course->price_sale !== null)
                    @if ($course->time_sale === null || $course->time_sale > \Carbon\Carbon::now())
                        @if ($course->price_sale === 0)
                            <span class="new-fee free btn btn-danger">Khóa học miễn phí</span>
                            <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>

                        @else
                            <span class="new-fee">{{ number_format($course->price_sale ,0,",",".")}} VND</span>
                            <span class="{{ $course->price_sale != null ? 'old-fee' : 'new-fee'}}">{{ number_format($course->price ,0,",",".")}} VND</span>
                        @endif
                    @elseif ($course->time_sale < \Carbon\Carbon::now())
                        @if ($course->price === 0)
                            <span class="new-fee free btn btn-danger">Khóa học miễn phí</span>
                            <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>

                        @else
                            <span class="new-fee">{{ number_format($course->price ,0,",",".")}} VND</span>
                            <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>
                        @endif
                    @endif

                @else
                    @if ($course->price === 0)
                        <span class="new-fee free btn btn-danger">Khóa học miễn phí</span>
                        <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>

                    @else
                        <span class="new-fee">{{ number_format($course->price ,0,",",".")}} VND</span>
                        <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>
                    @endif
                @endif

            @endif
            @if ($course_buyed)
                <a href="{{route('w.learn.index',$course->slug)}}" class=" btn-course w-50">Click ngay để học</a>
                @if ($courseUser == null)
                    <a href="{{ route('w.certificate.index', $course->slug) }}" class="btn-course-exam w-50">Thi lấy chứng chỉ</a>
                @else
                    @if ($courseUser->status == 0)
                        <div class=" btn-course-exam">Yêu cầu thi ngay của bạn đang chờ xác thực</div>
                    @else
                        <a href="{{route('w.exam.exam',$course->slug)}}" class="btn-course-exam w-50">Làm bài thi lấy chứng chỉ</a>
                    @endif
                @endif
            @else
                {{-- <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a> --}}
            @endif
        </div>
        @if (!$course_buyed)
            @if ($course->price_sale !== null)
                @if ($course->time_sale > \Carbon\Carbon::now())
                    <div class="course-end-discount text-center">
                        <span><b>Giảm giá đến</b>: {{ \Carbon\Carbon::createFromDate($course->time_sale)->format('H:i | d-m-Y') }}</span>
                    </div>
                @endif
            @endif
            @if ( $course->price !== 0  && $course->price_sale !== 0 && $course->price_sale !== null)
                <a href="{{route('w.course.register',$course)}}" class="btn-course">Đăng kí ngay!</a>
            @endif
        @endif
    </div>
</section>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#retest').click(function(e){
            e.preventDefault();
            Swal.fire({
                title: '<strong>Thông báo</strong>',
                icon: 'info',
                text: 'Phí thi lại là 20.000 vnđ. Bạn có muốn thi không?',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{route('w.exam.exam',$course->slug)}}';
                }
            })
        });
    })
</script>
@endpush
@endsection

@extends('web.layouts.master')
@section('page_title', ($lesson) ? 'Bài học '.$lesson->name : 'Bài học đang được cập nhật')
@section('page_keywords')
@section('page_description')
@section('page_og:image',asset(($lesson) ? $lesson->thumb : ''))
@section('content')
    <section id="page-learning">
        <div class="container">
            <div class="row">
                @if ($lesson)
                    @if ($lessons->count())
                        <div class="col-lg-3 col-12">
                            <div class="sidebar-learning" class="bdr-15">
                                <div class="d-flex align-items-center">
                                    <button class="btn-menu-learning "><i class="fa-solid fa-bars"></i></button>
                                    <span class="ml-3 d-block d-md-none text-white title">Danh sách bài học</span>
                                </div>
                                <div id="overlay-learning"></div>
                                <div id="list-lesson" class="bdr-15">
                                    <h2>DANH SÁCH BÀI HỌC</h2>
                                    <ul>
                                        @foreach ($lessons as $item)
                                        <li><a  class="{{$lesson->id == $item->id ? 'active': ''}}" title="{{ $item->name}}"><i class="fa-solid fa-file-lines"></i> {{ $item->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($lesson)
                        <div class="col-lg-9 col-12">
                            <div class="main-learning">
                                <h2 class="name-lesson text-center">{{ $lesson->name}}</h2>
                                @if ($lesson->audio)
                                    <div class="read-blog text-right">
                                        <audio controls class="w-100">
                                            <source src="{{ asset($lesson->audio)}}" type="audio/mpeg">
                                        </audio>
                                    </div>
                                @endif
                                <hr>
                                <div>
                                    {!! $lesson->content !!}
                                </div>

                                @if ($lesson->lessonQuestions->count())
                                    <div class="lesson-test">
                                        <div class="content-body">
                                            <div class="quiz-wrapper results-wrapper rounded">
                                                <h2>Câu hỏi ôn tập</h2>
                                                <ol>
                                                    <form action="{{route('w.learn.review',$lesson)}}" method="POST">
                                                        @csrf
                                                        @foreach ($lesson->lessonQuestions as $lessonQuestion)
                                                            <li>
                                                                <p><span class="number-question">{{$lessonQuestion->question->name}}:</span> {{ucfirst($lessonQuestion->question->content)}}</p>
                                                                <ul>
                                                                    @foreach ($lessonQuestion->question->answers as $answer)
                                                                        <li>
                                                                            <input type="checkbox" name="{{$lessonQuestion->question->id}}[]" value="{{$answer->id}}" class="answer" id="answer{{$answer->id}}">
                                                                            <label for="answer{{$answer->id}}">{{$answer->name}}</label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                        <button type="submit" class="btn btn-primary w-100">Nộp bài</button>
                                                    </form>
                                                </ol>
                                            </div>
                                        </div>

                                    </div>
                                @endif

                                {{-- control lesson --}}
                                <div class="nextprev d-flex justify-content-between align-items-center">
                                    @if ($previous_lesson ?? $previous_lesson = '')
                                        <a href="{{ route('w.learn.show.previous',[$course->slug, $lesson->slug]) }}" class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i>Bài trước</a>
                                    @endif
                                    @if ($countLearned)
                                        @if ($next_lesson ?? $next_lesson = '')
                                            <a href="{{ route( 'w.learn.show.next',[$course->slug, $lesson->slug]) }}" class="btn btn-next"> Bài tiếp theo<i class="fa-solid fa-chevron-right"></i></a>
                                        @endif
                                    @endif
                                </div>

                                {{-- exam  --}}
                                @if ($allowExam)
                                    @if (!$exam_success)
                                        <hr>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('w.exam.test',$course->slug)}}" class="btn btn-blue bg-primary mr-5 bdr-20 px-4">Thi thử <i class="fa-regular fa-pen-to-square"></i></a>
                                            @if ($examed)
                                                <a href="{{route('w.exam.exam',$course->slug)}}" class="btn btn-blue bg-fail bdr-20 px-4" data-money="{{$course->exam->money}}" id="retest">Thi lại <i class="fa-solid fa-pen-to-square"></i></a>
                                            @else
                                                <a href="{{route('w.exam.exam',$course->slug)}}" class="btn btn-blue bg-success bdr-20 px-4">Thi <i class="fa-solid fa-pen-to-square"></i></a>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <div class="mt-5 w-100">
                        @include('web.components.alert_text',['text_alert' => 'Bài học đang được cập nhật. Vui lòng quay trở lại sau!'])
                        @include('web.components.btn_pre_page')
                    </div>
                @endif
            </div>
        </div>
    </section>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#retest').click(function(e){
            e.preventDefault();
            let money = $(this).attr('data-money');
            Swal.fire({
            title: '<strong>Thông báo</strong>',
            icon: 'info',
            text: `Phí thi lại là ${money} vnđ. Bạn có muốn thi không?`,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText: 'Có',
            cancelButtonText:
                'Không',
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

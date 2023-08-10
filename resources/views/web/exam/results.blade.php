@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Kết quả bài thi')
@section('content')
    <div id="exam-results">
        <div class="container">
            <div class="test-page">
                <div class="content-body">
                    <div class="quiz-wrapper results-wrapper bg-white rounded">
                        <h2 class="text-center">Kết quả bài thi</h2>
                        <div class="number-question">
                            @foreach ($answer as $key => $answer)
                            <div class="number-item {{ $answer == '0' ? 'false' : 'true'}}">
                                <span>
                                    <strong>Câu: {{++$loop->index}} </strong>
                                    : {{ $answer == '0' ? 'Sai' : 'Đúng' }}
                                </span>
                                <span><i class="fa-solid {{ $answer == '0' ? 'fa-x' : 'fa-check'}}"></i></span>                                
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
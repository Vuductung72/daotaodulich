@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Thi')
@section('content')
<div id="page-test">
    <div class="container">
        <div class="test-page">
            <nav class="navbar-exam">
                <div style="width: 100%; display: flex; padding: 7px 10px; background-image: linear-gradient(90deg, #77baeb, #0a7ed0, #77baeb); color: #fff; align-items: center;">
                    <div class="" style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                        <span class="timer-clock"><i class="far fa-clock"></i> <span id="timer">{{$exam->time}}:00</span></span>
                        <span id="submit-test" data-action="" >
                            <i class="far fa-paper-plane"></i>
                            <input class="submit-exam" type="submit" form="formExam" value="NỘP BÀI" data-toggle="modal" data-target="#exampleModal">
                        </span>
                    </div>
                </div>
                <div class="scroll-slider scroll-off">
                    <div class="scroll-on">
                        <ul class="nav-tabs">
                            @foreach ($list_question as $key => $value)
                                <li class="number-question questions {{ ++$key == 1 ? 'active' : '' }}" number-question="" question-id="" total-number="50">
                                    <span class="question" data-id="#question_{{$value}}" data-url="{{route('w.exam.question',$value)}}">{{$key}}</span>
                                </li>                        
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
    
            <div class="content-body">
                <div class="quiz-wrapper bg-white rounded">
                    <ol>
                        <form action="{{route('w.exam.auditions',['course' => $course, 'exam_id' => $exam->id])}}" id="formExam" method="POST">
                            @csrf
                            @foreach ($list_question as $key => $question)
                                <li class="answers {{ ++$key != 1 ? 'd-none' : '' }}" id="question_{{$question}}"></li>             
                            @endforeach
                        </form>
                    </ol>
                </div>
            </div>
            
            <nav class="navbar">
                <button type="button" class="btn-exam btn-primary mx-auto" id="previous-question">Câu trước</button>
                <button type="button" class="btn-exam btn-primary mx-auto" id="next-question">Câu tiếp theo</button>
            </nav>
        </div>
    </div>
</div>
<a href="" style="color: #fff"></a>


@push('scripts')
<script>
    $(document).ready(function(){
        //funtion show info question and answer
        function renderQuestion(questions, answers){
            let question = `<h3> ${questions.name} </h3>`
                          +`<p> ${questions.content} </p>`;
            let answer = '<ul>';
            $('#question_'+questions.id).html(question);
            answers.forEach((item)=>{
                answer += `<li><input type="checkbox" name="${questions.id}[]" value="${item.id}" class="answer" id="question${questions.id}_answer${item.id}"><label for="question${questions.id}_answer${item.id}"> ${item.name} </label></li>`;
            });
            answer += '</ul> ';
            $('#question_'+questions.id).append(answer);
        }  

        // get info of the first answer
        let url = $('.nav-tabs .active .question').attr('data-url');
        fetch(url).then(res => res.json()).then(
            (data)=>{
                renderQuestion(data[0], data[1]);
            }
        );    

        // get info of the answer when user change questions
        $('.question').click(function(e){
            let url = e.target.dataset.url;
            let haveText= $(e.target.dataset.id).text();
            if(!haveText){
                fetch(url).then(res => res.json()).then(
                    (data)=>{
                        renderQuestion(data[0], data[1]);
                    }
                );
            }
        })
    })
</script>
@endpush
@endsection
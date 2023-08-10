@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Lịch sử thi')
@section('content')
    <div id="page-exam-history">
        <div class="container">
            <div class="main-content">
                <div class="row">
                    @include('web.account.sidebar')

                    <div class="col-12 col-lg-9">
                        <div class="exam-history-information">
                            <div class="header-exam-history">
                                <h3 class="title-page">Lịch sử thi</h5>
                            </div>
                            <div class="history-exem">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane overflow-auto fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr class="text-center">
                                                    <th scope="col">Bài thi</th>
                                                    <th scope="col">Kết quả</th>
                                                    <th scope="col">Thể loại</th>
                                                    <th scope="col">Ngày thi</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Đáp án</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($historys as $history)
                                                        <tr class="text-center {{$history->status ? 'bg-true text-white' :  'bg-false'}} ">
                                                            <td scope="col">{{$history->exam->name}}</td>
                                                            <td scope="col">
                                                            @php
                                                                if($history->answer != [] OR $history->answer != '' ){
                                                                    $arrQuestion = json_decode($history->answer,true);
                                                                    $numberQuestion = array_count_values($arrQuestion);
                                                                    $numberQuestion = isset($numberQuestion['1']) ? $numberQuestion['1'] : 0;
                                                                    echo $numberQuestion. '/' .$history->exam->examQuestions->count() . ' câu';
                                                                }else{
                                                                    echo '0/' .$history->exam->examQuestions->count() . ' câu';
                                                                }
                                                            @endphp
                                                            </td>
                                                            <td scope="col">{{$history->type ? 'Thi thật' : 'Thi thử'}}</td>
                                                            <td scope="col">{{\Carbon\Carbon::createFromDate($history->created_at)->format('d/m/Y')}}</td>
                                                            <td scope="col">{{$history->status ? 'Đạt' : 'Chưa đạt'}}</td>
                                                            @if (json_decode($history->answer))
                                                                <td scope="col">
                                                                    <a href="{{route('w.exam.result',$history)}}" class="btn btn-primary btn-history-exam">Xem lại</a>
                                                                </td>
                                                            @else
                                                                <td scope="col">
                                                                    <Span>Không có câu trả lời</Span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

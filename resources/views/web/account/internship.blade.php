@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Thông tin thực tập')
@section('content')
    <div id="page-mycourse">
        <div class="container">
            <div class="main-content">
                <div class="row">
                    @include('web.account.sidebar')

                    <div class="col-12 col-lg-9">
                        <div class="mycourse-information">
                            <div class="header-mycourse">
                                <h3 class="title-page">Thông tin thực tập</h3>
                            </div>
                            <div class="mycouse-list">
                                <h3>Danh sách tin đã ứng tuyển</h3>
                                <ul>
                                    @foreach ($userCustomers as $item)
                                        <li class="mycourse-item">
                                            <a href="{{route('w.internship.show', $item->internship->slug)}}">
                                                <img src="{{asset($item->internship->customer->avatar)}}" alt="">
                                                <div class="mycourse-title">
                                                    <h5 class="text-info">{{ $item->internship->title}}</h5>
                                                    <span>Ngày ứng tuyển: {{\Carbon\Carbon::createFromDate($item->created_at)->format('d/m/Y')}}</span>
                                                </div>
                                                <div class="mycourse-status">
                                                    <span>Trạng thái:
                                                        <span class="text-primary">
                                                            @if ($item->status == 1 )
                                                                Chờ xác nhận
                                                            @elseif ($item->status == 2)
                                                                Đã xác nhận
                                                            @else
                                                                Yêu cầu đã bị huỷ
                                                            @endif
                                                        </span>
                                                    </span>
                                                    {{-- <a href="#" class="btn btn-account">
                                                        Đánh giá của bạn
                                                    </a> --}}
                                                </div>
                                            </a>
                                            @if ($item->status == 2)
                                                <a href="{{route('w.account.evaluate', $item)}}" class="text-center btn btn-primary text-white d-block m-0">
                                                    Đánh giá của bạn
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .mycourse-status{
            width: 35%;
        }

        .mycourse-item a{
            margin: 8px 0 0;
        }
    </style>
@endpush

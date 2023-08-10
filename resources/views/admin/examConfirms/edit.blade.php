@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Xác nhận thông tin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.exam-confirm.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.exam-confirm.update', $courseUser)}}" method="POST" @submit.prevent="onSubmit">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_id">Học viên</label>
                                    <input type="text" id="user_id" class="form-control" name="user_id"  value="{{$courseUser->user->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="course_id">Khóa học</label>
                                    <input type="text" id="course_id" class="form-control" name="course_id"  value="{{$courseUser->course->name}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content">Thông tin khác</label>
                                    <textarea readonly class="form-control tinymce" name="content" id="content" rows="5" >{!!$courseUser->content!!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            @if ($courseUser->status == 0)
                                <button class="btn btn-primary">Xác nhận</button>                              
                            @endif
                            
                            <a href="{{route('ad.exam-confirm.index')}}" class="btn btn-default">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@prepend('scripts')
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')
@endprepend


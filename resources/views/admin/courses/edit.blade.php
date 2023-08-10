@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Chỉnh sửa khóa học')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i aria-hidden="true" class="fa fa-plus-circle"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.courses.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.courses.update',$course) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên khóa học <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tên khóa học&quot;" value="{{ $course->name}}" placeholder="Nhập tên khóa học....">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                                <div class="form-group" :class="[errors.has('price') ? 'has-error' : '']">
                                    <label for="price">Giá khóa học<span class="required">*</span></label>
                                    <input type="number" class="form-control input-price" id="price" placeholder="ví dụ: 1000000" name="price" v-validate="'required'" data-vv-as="&quot;Giá khóa học&quot;" value="{{ $course->price }}">
                                    <div class="convert-price">
                                        <p>= <span>0</span> VND</p>
                                    </div>
                                    <span class="help-block" v-if="errors.has('price')">@{{ errors.first('price') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="price_sale">Giá khuyến mãi</label>
                                    <input type="number" class="form-control input-price-sale" id="price_sale" placeholder="ví dụ: 1000000 " name="price_sale" value="{{ $course->price_sale }}">
                                    <div class="convert-price-sale">
                                        <p>= <span>0</span> VND</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="time_sale">Thời gian hết hạn khuyến mãi</label>
                                    <input type="datetime-local" value="{{ $course->time_sale }}" class="form-control" id="time_sale"  name="time_sale">
                                </div>
                                <div class="form-group">
                                    <label for="profession">Ngành nghề <span class="required">*</span></label>
                                    <select class="form-control" name="profession_id" id="profession">
                                        @if ($list_profession->count())
                                            @foreach ($list_profession as $profession)
                                                <option value="{{$profession->id}}" {{ $profession->id == $course->profession_id ? 'selected' : ''}}>{{$profession->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="0" selected>Chưa chọn</option>
                                        @endif
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exam_id">Đề thi <span class="required">*</span></label>
                                    <select class="form-control" name="exam_id" id="exam_id">
                                        @if ($list_exam->count())
                                            @foreach ($list_exam as $exam)
                                                <option value="{{$exam->id}}" {{ $course->exam_id == $exam->id ? 'selected' : ''}}>{{$exam->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="0" selected>Chưa chọn</option>
                                        @endif
                                    </select>
                                </div>  --}}
                                <div class="form-group">
                                    <label for="exam_id_test">Đề thi thử <span class="required">*</span></label>
                                    <select class="form-control" name="exam_id_test" id="exam_id_test">

                                        @if ($list_exam_test->count())
                                            @foreach ($list_exam_test as $exam_test)
                                                <option value="{{$exam_test->id}}" {{ $course->exam_id_test == $exam_test->id ? 'selected' : ''}}>{{$exam_test->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="0" selected>Chưa chọn</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumb">Ảnh đại diện <span class="required">*</span></label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width:150px">
                                                <img class="img-responsive" src="{{ asset($course->thumb) }}" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:150px"></div>
                                            <div class="">
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Chọn ảnh</span>
                                                    <span class="fileinput-exists">Đổi ảnh</span>
                                                    <input type="file" accept="image/*" name="thumb">
                                                </span>
                                                <a href="javascript:void(0);" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" :class="[errors.has('description') ? 'has-error' : '']">
                                    <label for="description">Mô tả ngắn <span class="required">*</span></label>
                                    <textarea id="description" class="form-control" name="description" rows="3" v-validate="'required'" data-vv-as="&quot;Mô tả ngắn&quot;"  placeholder="Nhập mô tả ngắn....">{{ old('description',$course->description) }}</textarea>
                                    <span class="help-block" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="keyword">Keywords</label>
                                    <input type="text" id="keyword" class="form-control" name="keyword" value="{{ old('keyword',$course->keyword ) }}" placeholder="Nhập từ khóa....">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label for="describe">Những giá trị mà khóa học mang lại</label>
                                    <div id="boxBenefit">
                                        <div class="mb-1">
                                            <div style="position: relative;">
                                                <input id="textBenefit" type="text" name="content[]" class=" form-control" placeholder="Nhập giá trị mà khóa học mang lại....">
                                                <i id="btnAddBenefit" style="position: absolute;top: 50%;right: 0px;transform: translateY(-50%);" class="text-right col-md-1 fa fa-plus-square" aria-hidden="true"></i>
                                            </div>
                                            <small class="txtError text-danger display-none">Giá trị chưa được nhập</small>
                                        </div>
                                        @foreach ($course->benefits as $benefit)
                                            <input type="text" class="mb-1 form-control" value="{{$benefit->content}}">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="describe">Mô tả</label>
                                    <textarea  type="text" id="describe" class="form-control tinymce" name="describe" placeholder="Nhập mô tả....">{!! $course->describe !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.courses.index') }}" class="btn btn-default">Quay lại</a>
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
<script src="{{ asset('js/editPrice.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')
<script>
    $(document).ready(function(){

        // benefit
        let txtBenefit = $("#textBenefit");
        txtBenefit.focus(()=>{
            $(".txtError").addClass("display-none");
        });
        $("#btnAddBenefit").click(()=>{
            if(txtBenefit.val() === ""){
                $(".txtError").removeClass("display-none");
            }else{
                let content = txtBenefit.val();
                let itemBenefit = '<input type="text" class="mb-1 form-control" name="content[]" value="'+ content +'">';
                $('#boxBenefit').append(itemBenefit);
                txtBenefit.val('');
            }
        });
    })
</script>
@endprepend


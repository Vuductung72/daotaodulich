@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Chi tiết câu hỏi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary btn-circle" form="formAnswer">Cập nhật</button>
                        <a class="btn btn-circle btn-default" href="{{ route('ad.question.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <table class="table">
                    {{-- content question --}}
                    <thead>
                        <tr class="row">
                            <th style="vertical-align: text-top;">
                                <h5 style="font-weight:700">Câu hỏi: </h5>
                            </th>
                            <th>
                                <h5 style="font-weight:700">{{ $question->content}} ?</h5>
                            </th>
                        </tr>
                    </thead>
                    {{-- answers  --}}
                    <tbody>
                        <tr class="row">
                            <td  class="col-md-2">
                                <h5 style="font-weight:700">Câu trả lời:</h5>
                            </td>
                            <td class="col-md-10">
                                <form action="{{route('ad.question.answer',$question)}}" method="POST" id="formAnswer">
                                    @csrf
                                    {{-- list answers  --}}
                                    @if ($answers)
                                        @foreach ($answers as $answer)
                                            <div class="row form-group" id="{{$answer->id}}">
                                                <div class="col-md-8">
                                                    <input type="text" name="id[]" value="{{$answer->id}}" id="" hidden>
                                                    <input type="text" class="form-control" name="name[]" id="" value="{{$answer->name}}" placeholder="Nhập câu trả lời....">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="status[]" id="">
                                                    <option value="0" {{$answer->status == 0 ? 'selected': ''}}>Chưa chọn</option>
                                                    <option value="1" {{$answer->status == 1 ? 'selected': ''}}>Đúng</option>
                                                    <option value="2" {{$answer->status == 2 ? 'selected': ''}}>Sai</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="w-100 btn btn-danger" onclick="deleteAnswer({{$answer->id}})">Xóa</a>
                                                </div>
                                            </div>                                    
                                        @endforeach
                                    @endif
                                    {{-- list new answers  --}}
                                    <div id="newAnswer">
                                        <div class="row form-group">
                                            <div class="col-md-8" :class="[errors.has('text') ? 'has-error' : '']">
                                                <input type="text" value="" id="" hidden>
                                                <input class="w-100 form-control answer" type="text" name="text" placeholder="Nhập câu trả lời...." v-validate="'required'" data-vv-as="&quot;Câu trả lời&quot;">
                                                {{-- <span class=" text-danger display-none p-1" id="err">Bạn chưa nhập câu trả lời !</span> --}}
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control status" >
                                                <option value="0" selected>Chưa chọn</option>
                                                <option value="1">Đúng</option>
                                                <option value="2">Sai</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <a class="w-100  btn btn-primary" id="btnAdd">Thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"/>
@endpush

@prepend('scripts')
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')
<script>
    // disable event enter
    $(document).keypress(
        function(event){
            if (event.which == '13') {
            event.preventDefault();
            }
        }
    );
    
    // add new answer
    $("#btnAdd").click(function(){
        let answer =  $(".answer").val();
        let status =  $(".status").val();
        let id = Math.floor(Math.random() * 1000000);

        // check input form empty 
        if(answer){
            if(status == 1){
                statusText = 'Đúng';
            }else if(status == 2){
                statusText = 'Sai';
            }else{
                statusText = 'Chưa chọn';
            }

            // create answer
            $('<div class="row form-group" id="'+id+'">'+
                    '<div class="col-md-8">'+
                        '<input type="text" name="id[]" value="" id="" hidden>'+
                        '<input class="w-100 form-control" type="text" name="name[]" value="'+ answer +'" placeholder="Nhập câu trả lời....">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<select class="form-control" name="status[]" value="">'+
                            '<option value="0" '+ (status == 0 ? 'selected' : '') +'>Chưa chọn</option>'+
                            '<option value="1" '+ (status == 1 ? 'selected' : '') +'>Đúng</option>'+
                            '<option value="2" '+ (status == 2 ? 'selected' : '') +'>Sai</option>'+
                        '</select>'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<a class="w-100 btn btn-danger" onclick="deleteAnswer(0,'+id+')">Xóa</a>'+
                    '</div>'+                
                '</div>'
            ).prependTo('#newAnswer');

            // update new input value 
            $(".answer").val('');            
        }else{
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Vui lòng nhập "Câu trả lời"',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });

    // delete answer
    function deleteAnswer(idAnswer, id = 0){
        if(idAnswer == 0){
            $(`#${id}`).remove();
        }else{
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            jQuery.ajax({
                url: `{{asset('admin/answer/${idAnswer}')}}`,
                method: 'delete',
                success: function(result){
                    if(result){
                        $(`#${idAnswer}`).remove();
                    }else{
                        alert('xóa câu trả lời thất bại');
                    }
                },
                error: function(result){
                    console.log(result);
                    alert('xóa câu trả lời thất bại');
                }
            });
        }
    }

</script>
@endprepend

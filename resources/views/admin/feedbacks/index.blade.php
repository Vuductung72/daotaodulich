@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý đánh giá')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.feedback.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th width="40">STT</th>
                                <th>Tên</th>
                                <th>Avatar</th>
                                <th>Chức vụ</th>
                                <th>Vị trí</th>
                                <th>Nội dung</th>
                                <th width="140">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $loop->index +1}}</td>
                                <td>{{ $feedback->user_id > 0 ?  $feedback->user->name : $feedback->name}}</td>
                                <td>
                                    <img src="{{asset($feedback->user_id > 0 ?  $feedback->user->avatar : $feedback->avatar)}}" alt="slider" width="50px">
                                </td>
                                <td>{{ $feedback->position }}</td>
                                <td>{{ $feedback->position_type == '1' ? 'Học viên' : 'Đối tác'}}</td>
                                <td>{{ $feedback->content }}</td>
                                <td>
                                    <a title="Chỉnh sửa tài khoản" class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.feedback.edit', $feedback) }}"><i class="fa fa-pencil"></i></a>

                                    <form title="Xóa tài khoản" action="{{ route('ad.feedback.destroy', $feedback) }}" style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>

                                    <form action="{{ route('ad.feedback.status', $feedback) }}" id="delete-course-item-form" style="display: inline-block" method="POST" >
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-circle btn-sm {{ $feedback->status == '0' ? 'btn-primary' : 'btn-info'}}">
                                            <i class="fa {{ $feedback->status == '0' ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
@endpush

@push('scripts')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{-- <script src="{{ asset('global/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL SCRIPTS -->
    {{-- <script>
        $(document).ready(function(){
            $('#btn-status').click(function() {
                var id = $(this).data('id');
                var token = $(this).data('token');
                $.ajax({
                    url: '/feedback/status/' + id,
                    type: 'post',
                    data: {
                        _token: token ,
                    },
                    success: function(response) {
                        console.log(response);
                        // if (response.success) {
                        //     location.reload();
                        // }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            })
        });
    </script> --}}
@endpush



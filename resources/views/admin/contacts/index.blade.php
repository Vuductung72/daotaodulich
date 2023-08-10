@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách thông tin liên hệ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                {{-- <div class="portlet-title">
                    <form action="{{route('ad.user.search')}}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nameSearch">Họ Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="nameSearch" placeholder="Nhập tên....">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="emailSearch">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="emailSearch" placeholder="Nhập email....">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="" style="">&nbsp;</label>
                                    <button class="btn btn-primary form-control" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th width="3%">STT</th>
                                <th width="10%">Tên khách hàng</th>
                                <th width="7%">Email</th>
                                <th width="10%">Số điện thoại</th>
                                <th width="15%">Ghi chú</th>
                                <th width="10%">Thời gian gửi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $key => $contact)
                                <tr>
                                    <td >{{ $key+1 }}</td>
                                    <td >{{ $contact->name}}</td>
                                    <td >{{ $contact->email }}</td>
                                    <td >{{ $contact->phone }}</td>
                                    <td >{{ $contact->note ? $contact->note : '....'}}</td>
                                    <td >{{ \Carbon\Carbon::createFromDate($contact->created_at)->format('H:i:s | d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{-- {{ $users->withQueryString()->links('web.layouts.paginate') }} --}}
                    </div>
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
@endpush

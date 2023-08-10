@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý Customer')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <hr>
                <div class="portlet-title">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="exampleInputEmail1" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="exampleInputEmail1" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="">&nbsp;</label>
                                    <button class="btn btn-primary form-control" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th width="3%">ID</th>
                                <th width="10%">Tên</th>
                                <th width="10%">Email</th>
                                <th width="7%">SĐT</th>
                                <th width="7%">Năm Sinh</th>
                                <th width="15%">Nội dung</th>
                                <th width="5%">Nơi đăng ký</th>
                                <th width="15%">Tên bài nơi đăng ký</th>
                                <th width="10%">ngày</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td >{{ $customer->id }}</td>
                                <td >{{ $customer->name }}</td>
                                <td >{{ $customer->email }}</td>
                                <td >{{ $customer->phone }}</td>
                                <td >{{ $customer->date_of_birth }}</td>
                                <td >{{ $customer->note }}</td>
                                <td >@php
                                        if ($customer->formable_type == \App\Models\Blog::class) {
                                            echo 'blog';
                                        } else if ($customer->formable_type == \App\Models\Course::class) {
                                            echo 'course';
                                        } else {
                                            if ($customer->ladipage) {
                                                echo 'ladipage';
                                            } else {
                                                echo 'slider';
                                            }
                                        }
                                    @endphp
                                <td>@php
                                        if($customer->formable) {
                                            echo $customer->formable->name;
                                        } else {
                                            if ($customer->ladipage) {
                                                echo 'lading page: ' .  $customer->ladipage;
                                            } else {
                                                echo 'blog slider';
                                            }
                                        }
                                          @endphp</td>
                                <td>{{ \Carbon\Carbon::createFromDate($customer->created_at)->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $customers->withQueryString()->links('web.layouts.paginate') }}
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

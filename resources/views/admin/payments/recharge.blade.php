@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý Nạp tiền')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                        <tr>
                            <th width="3%">ID</th>
                            <th width="7%">User ID</th>
                            <th width="10%">Tài khoản</th>
                            <th width="10%">Số tiền (VNĐ)</th>
                            <th width="10%">Order ID</th>
                            <th width="20%">Method</th>
                            <th width="7%">Trạng thái</th>
                            <th width="20%">Ngày nạp</th>
                            {{-- <th width="10%">Action</th> --}}

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td >{{ $payment->id }}</td>
                                 <td >{{ $payment->user->id }}</td>
                                <td>{{ $payment->user->name }}</td>
                                <td >{{ number_format($payment->amount) }}</td>
                                <td >{{ $payment->order_code }}</td>
                                <td >
                                    @if($payment->method == 'bank_transfer')
                                        Chuyển khoản ngân hàng
                                    @elseif($payment->method == 'bank_qr')
                                        Ngân hàng quét mã
                                    @elseif($payment->method == 'momo_qr')
                                        Momo Pay
                                    @elseif($payment->method == 'zalo_qr')
                                        Zalo Pay
                                    @endif
                                </td>
                                <td class="{{$payment->status == 0 ? 'blue':'green'}}">
                                    {{$payment->status == 0 ? 'Chưa nạp/Lỗi':'Thành công'}}
                                </td>
                                <td >{{ \Carbon\Carbon::createFromDate($payment->created_at)->format('H:i:s d/m/Y') }}</td>
                                {{-- <td>
                                    <form action="{{ route('ad.payment.recharge', $payment->id) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn duyệt giao dịch này?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="type" value="0">
                                        <button {{($payment->status == 0)?'':'disabled'}} class="btn btn-circle btn-sm btn-danger">Duyệt</button>
                                    </form>
                                    <form action="{{ route('ad.payment.recharge', $payment->id) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy giao dịch này?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="type" value="1">
                                        <button {{($payment->status == 0)?'':'disabled'}} class="btn btn-circle btn-sm btn-danger">Hủy</button>
                                    </form>
                                </td> --}}
{{--                                <td>--}}
{{--                                    <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.user.edit', $payment->id) }}"><i class="fa fa-pencil"></i></a>--}}
{{--                                    <form action="{{ route('ad.user.destroy', $payment->id) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <style>
        .blue {
            color: blue;
        }
        .green {
            color: green;
        }
    </style>
    <!-- END PAGE LEVEL PLUGINS -->
@endpush

@push('scripts')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{-- <script src="{{ asset('global/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL SCRIPTS -->
@endpush

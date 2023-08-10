@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Lịch sử nạp tiền')
@section('content')
    {{-- <section class="section-bank"> --}}
        <div id="page-account">
            <div class="container main-content">
                <div class="row">

                    {{-- sidebar account --}}
                    @include('web.account.sidebar')

                    {{-- content account --}}
                    <div class="col-12 col-lg-9">
                        <div class="history-loading-money">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr class="text-center">
                                                <th scope="col">Ngày</th>
                                                <th scope="col">Phương thức</th>
                                                <th scope="col">Số tiền</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($histories as $history)
                                                <tr class="text-center">
                                                    <th scope="row">
                                                        {{ \Carbon\Carbon::createFromDate($history->created_at)->format('d/m/Y H:i:s') }}
                                                    </th>
                                                    <td >
                                                        @if($history->method == 'bank_transfer')
                                                            Chuyển khoản ngân hàng
                                                        @elseif($history->method == 'bank_qr')
                                                            Ngân hàng quét mã
                                                        @elseif($history->method == 'momo_qr')
                                                            Momo Pay
                                                        @elseif($history->method == 'zalo_qr')
                                                            Zalo Pay
                                                        @endif
                                                    </td>
                                                    <td>{{ number_format($history->amount) }} VNĐ</td>
                                                    <td>
                                                        @if ($history->status == 0)
                                                            <span>Chưa chuyển / Lỗi</span>
                                                        @elseif($history->status == 1)
                                                            <span class="text-success">Thành công</span>
                                                        @else
                                                            <span class="text-danger">Chưa chuyển / Lỗi</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $histories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- </section> --}}
@endsection

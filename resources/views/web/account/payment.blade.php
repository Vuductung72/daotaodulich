@extends('web.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Nạp tiền')
@section('content')
    <section id="section-bank">
        <div id="page-account">
            <div class="container">
                <div class="main-content">
                    <div class="row">
                        @include('web.account.sidebar')

                        <div class="col-lg-9">
                            <div class="list-bank">
                                <div class="load-money-header">
                                    <h3>Quản lí chung</h3>
                                    <span>Thanh toán</span>
                                </div>

                                <div class="payment-tab">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="payment-widget payment-widget-active" data-target="#banking">
                                                <i class="icon fas fa-university" aria-hidden="true"></i>
                                                <div class="text">Banking</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-widget" data-target="#momo">
                                                <i class="icon fa-solid fa-wallet"></i>
                                                <div class="text">MoMo</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-method-box">
                                    <div class="payment-list" id="banking">
                                        <div class="payment-list-box">
                                            <div class="row row-payment-box">
                                                <div class="col-12">
                                                    <div class="card card-body">
                                                        <div class="payment-header text-center">
                                                            <h3>Vui lòng chọn ngân hàng</h3>
                                                        </div>
                                                        <div class="payment-content">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6 payment-item" data-target="VCB">
                                                                    <div class="payment-method">
                                                                        <img src="{{ asset('web/asset/images/bank/vietcombank.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6 payment-item" data-target="VTB">
                                                                    <div class="payment-method" id="viettinbank">
                                                                        <img src="{{ asset('web/asset/images/bank/viettinbank.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                {{--                                                      <div class="col-12 col-lg-6 payment-item" data-target=""> --}}
                                                                {{--                                                        <div class="payment-method" id="techcombank"> --}}
                                                                {{--                                                          <img src="{{ asset('web/asset/images/bank/techcombank.png') }}" alt=""> --}}
                                                                {{--                                                        </div> --}}
                                                                {{--                                                      </div> --}}
                                                                <div class="col-12 col-lg-6 payment-item" data-target="MB">
                                                                    <div class="payment-method" id="mbbank">
                                                                        <img src="{{ asset('web/asset/images/bank/mbbank.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="input-amout d-none">
                                                                        <h4 class="text-center">Vui lòng nhập số tiền</h4>
                                                                        {{--                                                          <form action="" class="form-payment"> --}}
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Số tiền</label>
                                                                            <input type="text"
                                                                                class="form-control input-money-banking"
                                                                                id="money" aria-describedby="money">
                                                                            <div class="input-convert-amount">
                                                                                <p>= <span>0</span> VND</p>
                                                                            </div>
                                                                            <small id="alert-error-money"
                                                                                class="form-text text-danger d-none">Nhập số
                                                                                tiền tối thiểu 20.000VND</small>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary btn-payment"
                                                                            onclick="submit_pay();" disabled>Xác
                                                                            nhận</button>
                                                                        {{--                                                          </form> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-list d-none" id="momo">
                                        <div class="payment-list-box">
                                            <div class="input-amout">
                                                <div class="payment-img">
                                                    <img src="{{ asset('web/asset/images/momo.svg') }}" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <h4 class="text-center">Vui lòng nhập số tiền</h4>
                                                    <input type="text" class="form-control input-money-banking"
                                                        id="money_momo" aria-describedby="money">
                                                    <div class="input-convert-amount">
                                                        <p>= <span>0</span> VND</p>
                                                    </div>
                                                    <small id="alert-error-money" class="form-text text-danger d-none">Nhập
                                                        số tiền tối thiểu 20.000VND</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-payment"
                                                    onclick="submit_momo()" disabled>Xác nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        var code = '';
        $(".payment-item").click(function() {
            code = $(this).attr('data-target');

        });

        function submit_pay() {
            let amount = $("#money").val();
            let baseUrl = '<?php echo e(url('/')); ?>';
            window.location.href = baseUrl + "/payment/success?amount=" + amount + "&type=qr_bank&code=" + code;
        }

        function submit_momo() {
            let amount = $("#money_momo").val();
            let baseUrl = '<?php echo e(url('/')); ?>';
            window.location.href = baseUrl + "/payment/success?amount=" + amount + "&type=momopay";
        }
    </script>
@endpush

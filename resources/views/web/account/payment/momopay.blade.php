@extends('web.layouts.master')

@section('content')
    {{-- <section class="section-bank"> --}}
        <div class="container">
            <div class="bg-white main-content">
                <div class="row">

                    <!-- sidebar payment -->
                    @include('web.account.sidebar')

                    <!-- content momo -->
                    <div class="col-12 col-lg-9">
                        <div class="rechange">
                            <div class="header-account">
                                <a href="{{route('w.payment.recharge')}}" class="rechange__back">
                                    <div class="btn--back d-flex">
                                        <div class="left">
                                            <i class="fa-solid fa-arrow-left"></i>
                                        </div>
                                        <div class="btn--title">
                                            <span>MoMoPay</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- <form id="deposit_form" method="POST" action=""> -->
                                <div class="collection-accordion-field">
                                    <div class="collection-opt-warpper">
                                        <ul>
                                            <li class="collection-option">
                                                <div class="collection-information">

                                                    <div class="thirdparty-icon MOMOPAY "> 
                                                        <img src="{{ asset('web/asset/images/momo.svg') }}" alt="">
                                                    </div>

                                                    <div class="collection-content">
                                                        <div class="collection-basic">
                                                            <p class="collection-description">Hạn mức nạp 50.000 VNĐ - 5.000.000 VNĐ
                                                            </p>
                                                        </div>
                                                        <div class="collection-fee">
                                                            <div class="collection-description">Phí xử lý:</div>
                                                            <p class="collection-description">Không mất phí</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="collection-accordion actived">
                                                    <div class="input-field">
                                                        <label class="input-field-block" for="depositamt">
                                                            <div class="input-base">
                                                                <input onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" type="text" name="depositamt"
                                                                    placeholder="50.000 - 5.000.000"
                                                                    class="input-field-value mc-input-field-value" id="depositamt"
                                                                    value="" >

                                                                <div class="input-field-suffix">VNĐ</div>
                                                            </div>
                                                            <!-- <input type="hidden" name="depositamt"
                                                                class="input-field-value-hiden" value="" id="depositamt"> -->
                                                            <div class="input-amount-field">
                                                                <div class="input-convert-amount">= <span>0</span> VNĐ</div>
                                                                <div class="quick-button">
                                                                    <div
                                                                        class="quick-button-block quick-button-block-amount">
                                                                        <input class="quick-input-button" value="50000"
                                                                            type="button">
                                                                        <input class="quick-input-button" value="100000"
                                                                            type="button">
                                                                        <input class="quick-input-button" value="200000"
                                                                            type="button">
                                                                        <input class="quick-input-button" value="300000"
                                                                        type="button">
                                                                        <input class="quick-input-button" value="400000"
                                                                        type="button">
                                                                        <input class="quick-input-button" value="500000"
                                                                            type="button">
                                                                        <input class="quick-input-button" value="1000000"
                                                                            type="button">
                                                                        <input class="quick-input-button" value="5000000"
                                                                            type="button">
                                                                    </div>
                                                                </div>
                                                                <div class="input-actual-amount">Số tiền bạn nhận được :
                                                                    <span>0</span> VND</div>
                                                                <div class="alert-error-money">
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <button class="button-rechange nrc-button" id="submit-form-deposit"
                                                        disabled onclick='submit_pay();' type="submit">Quét mã
                                                        code QR</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    {{-- </section> --}}

@endsection

@push('css')
    <style>
        .quick-input-button.active {
            border: 1px green solid !important;
            background: #3cc2ea;
            color: #fff;
        }
    </style>
@endpush

@push('scripts')
    <script>
        var amount = 0;

        $(".quick-input-button").click(function () { 
            amount = $(this).val();
            $(".quick-input-button").removeClass('active');
            $(this).addClass('active');
            $("#depositamt").val(amount);
            if (amount < 20000) {
                $(".alert-error-money").html('Số tiền nạp tối thiểu là 20.000');
                $("#submit-form-deposit").prop('disabled', true);
            } else {
                $(".alert-error-money").html('');
                $("#submit-form-deposit").prop('disabled', false);
            }

        });

        $("#depositamt").keyup(function() {
            amount = $(this).val();
            if (amount < 20000) {
                $(".alert-error-money").html('Số tiền nạp tối thiểu là 20.000');
                $("#submit-form-deposit").prop('disabled', true);
            } else {
                $(".alert-error-money").html('');
                $("#submit-form-deposit").prop('disabled', false);
            }

        });

        function submit_pay() {
            let baseUrl = '<?php echo e(url('/')); ?>';
            // var amount = 20000;
            window.open("" + baseUrl + "/nap-tien/thanh-cong?amount=" + amount + "&type=momopay", "_blank",
                "toolbar = yes, top = 500, left = 500, width = 900, height = 900");
        }

    </script>
@endpush

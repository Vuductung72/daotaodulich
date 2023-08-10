@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Tin Tức')
@section('content')
<div id="page-account">
    <div class="container">
        <div class="checkout-box">
            <!--Checkout Page-->
            <div class="checkout-page">
                <div class="auto-container">
                    <!--Billing Details-->
                    <div class="billing-details">
                        <div class="shop-form">
                            <form method="POST" action="" id="checkout-form">
                                <div class="row clearfix billing-details-box">
                                    <div class="col-lg-7 col-md-12 col-sm-12">
                                        
                                        <div class="title-box"><h2>Chi tiết đơn hàng</h2></div>
                                        <div class="billing-inner">
                                            <div class="row clearfix">
                                                <!--Form Group-->
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <div class="field-label">Họ và tên <sup>*</sup></div>
                                                    <input type="text" name="name" id="name" class="input-box" value="" placeholder="Họ và tên">
                                                </div>
                                                <!--Form Group-->
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <div class="field-label">Địa chỉ email <sup>*</sup></div>
                                                    <input type="email" name="email" id="email" class="input-box" value="" placeholder="Địa chỉ email">
                                                </div>
                                                
                                                <!--Form Group-->
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <div class="field-label">Số điện thoại <sup>*</sup></div>
                                                    <input type="text" name="phone" id="phone" class="input-box" value="" placeholder="Số điện thoại">
                                                </div>
        
                                                
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <div class="field-label">Ghi chú đơn hàng</div>
                                                    <textarea placeholder="Lưu ý về đơn đặt"></textarea>
                                                </div>
                                                <!--Place Order-->
                                                <div class="form-group form-button col-md-12 col-sm-12 col-xs-12">
                                                    <button  id="order" class="form-submit order-btn ">Thanh toán</button>
                                                </div>
                                                <!--End Place Order-->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="title-box"><h2>Đơn hàng của bạn</h2></div>
                                        <div class="shop-order-box">
                                            <ul class="order-list">
                                                <li class="font-weight-bold">Khóa học<span>Tổng tiền</span></li>
                                                <li>Khóa ABC: <div class="d-flex"> <input type="text" name="item_price" id="item_price" class="txt" value="" disabled/> VND</div> <input type="text" name="item_price" id="item_price_hiden" class="txt" value="10000000" /></li>
                                                <li>Sale <div class="d-flex"><input type="text" name="sale" id="sale" class="txt" value="50" disabled/> %</div></li>
                                                <li class="total">Thành tiền: <div class="text-danger d-flex"><input type="text" name="total_price" id="total_price" class="txt text-danger" value="" disabled/> VND</div> </li>
                                            </ul>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                </div>                             
                            </form>
                            
                        </div>
                        
                    </div><!--End Billing Details-->
        
                </div>
            </div> 
        
        </div>
        
    </div>
</div>



@endsection
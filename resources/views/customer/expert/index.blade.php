@extends('customer.layouts.master')
@section('page_title', 'Thông tin chuyên gia - '.auth('customer')->user()->fullname)
@section('page_keywords', 'chuyên gia '.auth('customer')->user()->fullname)
@section('page_description', config('constant.page_description_expert_detail'))
@section('page_og:image', asset(auth('customer')->user()->avatar))
@section('content')
    <div id="page-expert-information">
        <div class="container">
            <div class="row layout">
                <div class="col-12 col-lg-12">
                    <h2 class="text-center">Thông tin chuyên gia</h2>
                    <form action="{{route('us.expert.update',auth('customer')->user())}}" method="POST" autocomplete="off" enctype="multipart/form-data" id="expert-form">
                        @csrf
                        @method('PUT')
                        <div class="form-top">
                            <div class="my-avatar">
                                <div class="box-image">
                                    <img src="{{ asset(auth('customer')->user()->avatar) }}" alt="" id="avatarImage">
                                </div>
                                <div class="box-text">
                                    <h3 class="name-expert"> {{auth('customer')->user()->name}}</h3>
                                    <input type="file" name="avatar" id="avatar" class="inputfile">
                                    <label for="avatar" class="edit-avatar"> Thay đổi ảnh</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <div class="form-row ">
                                <div class="col-12 col-lg-12">
                                    <label for="fullname">Họ và tên:</label>
                                    <input type="text" id="fullname"  class="form-control" name="fullname" value="{{old('fullname',auth('customer')->user()->fullname)}}" placeholder="Nhập họ và tên chuyên gia....">
                                </div>
{{--                                <div class="col-12 col-lg-6">--}}
{{--                                    <label for="name">Tên:</label>--}}
{{--                                    <input type="text" id="name"  class="form-control" name="name" value="{{ old('name', auth('customer')->user()->expert ? auth('customer')->user()->expert->name : '')}}" placeholder="Nhập tên....">--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-row ">
                                <div class="col-12 col-lg-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" value="{{auth('customer')->user()->email}}" name="email" readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="password">Mật khẩu mới:</label>
                                    <input type="password" class="form-control password" id="password" name="password"  placeholder="Nhập mật khẩu mới...." value="">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password pw-icon"></span>
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12 col-lg-6">
                                    <label for="gender">Giới tính:</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="1" {{ auth('customer')->user()->expert ? (auth('customer')->user()->expert->gender == 1 ? 'selected' : '') : '' }}> Nam </option>
                                        <option value="0" {{ auth('customer')->user()->expert ? (auth('customer')->user()->expert->gender == 0 ? 'selected' : '') : '' }}> Nữ </option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="nationality">Quốc tịch:</label>
                                    <select class="form-control" id="nationality" name="nationality">
                                        <option value="Australia" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Australia' ? 'selected' : '') : '' }}> Australia </option>
                                        <option value="Cambodia" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Cambodia' ? 'selected' : '') : '' }}> Cambodia </option>
                                        <option value="Canada" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Canada' ? 'selected' : '') : '' }}> Canada </option>
                                        <option value="China" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'China' ? 'selected' : '') : '' }}> China </option>
                                        <option value="Campuchia" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Campuchia' ? 'selected' : '') : '' }}> Campuchia </option>
                                        <option value="France" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'France' ? 'selected' : '') : '' }}> France </option>
                                        <option value="Germany" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Germany' ? 'selected' : '') : '' }}> Germany </option>
                                        <option value="Indonesia" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Indonesia' ? 'selected' : '') : '' }}> Indonesia </option>
                                        <option value="Japan" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Japan' ? 'selected' : '') : '' }}> Japan </option>
                                        <option value="Laos" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Laos' ? 'selected' : '') : '' }}> Laos </option>
                                        <option value="Thailand" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Thailand' ? 'selected' : '') : '' }}> Thailand </option>
                                        <option value="Timor-Leste" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Timor-Leste' ? 'selected' : '') : '' }}> Timor-Leste </option>
                                        <option value="Việt Nam" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Việt Nam' ? 'selected' : '') : '' }}> Việt Nam </option>
                                        <option value="Brunei" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Brunei' ? 'selected' : '') : '' }}> Brunei </option>
                                        <option value="Singapore" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Singapore' ? 'selected' : '') : '' }}> Singapore </option>
                                        <option value="Malaysia" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Malaysia' ? 'selected' : '') : '' }}> Malaysia </option>
                                        <option value="Myanmar" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Myanmar' ? 'selected' : '') : '' }}> Myanmar </option>
                                        <option value="Philippines" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->nationality == 'Philippines' ? 'selected' : '') : '' }}> Philippines </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12 col-lg-6">
                                    <label for="marital_status">Tình trạng hôn nhân:</label>
                                    <select class="form-control" id="marital_status" name="marital_status">
                                        <option value="0" {{ auth('customer')->user()->expert ? ( auth('customer')->user()->expert->marital_status == 0 ? 'selected' : '') : '' }}> Chưa kết hôn  </option>
                                        <option value="1" {{ auth('customer')->user()->expert ? (auth('customer')->user()->expert->marital_status == 1 ? 'selected' : '') : '' }}> Đã kết hôn</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"  placeholder="Nhập số điện thoại...." value="{{old('phone', auth('customer')->user()->phone ? auth('customer')->user()->phone : '' )}}">
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12 col-lg-6">
                                    <label for="regular_address">Địa chỉ thường trú:</label>
                                    <input type="text" class="form-control" id="regular_address" placeholder="Nhập địa chỉ thường trú.... " value="{{old('regular_address', auth('customer')->user()->regular_address ? auth('customer')->user()->regular_address : '' )}}" name="regular_address">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="current_address">Địa chỉ hiện tại: </label>
                                    <input type="text" class="form-control" id="current_address" placeholder="Nhập địa chỉ hiện tại.... " value="{{old('current_address', auth('customer')->user()->expert ? auth('customer')->user()->expert->current_address: '' )}}" name="current_address" >
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12 col-lg-6">
                                    <label for="birthday">Ngày sinh:</label>
                                    <input type="date" class="form-control" id="birthday" value="{{old('birthday', auth('customer')->user()->expert ? auth('customer')->user()->expert->birthday : '')}}" name="birthday">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="profession_id">Chuyên ngành:</label>
                                    <select class="form-control" id="profession_id" name="profession_id">
                                        {{-- @if (auth('customer')->user()->expert)
                                            <option value="{{auth('customer')->user()->expert->profession_id}}" {{ auth('customer')->user()->expert->profession_id  == 0 ? 'selected' : '' }}>Chưa chọn </option>
                                        @endif --}}
                                        @foreach ($professions  as $profession)
                                            <option value="{{$profession->id}}" {{ (auth('customer')->user()->expert ? auth('customer')->user()->expert->profession_id : null) == $profession->id ? 'selected' : '' }}>{{ $profession->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12">
                                    <label for="content">Thông tin khác:</label>
                                    <textarea name="content" class="form-control tinymce" id="content" cols="30" rows="10" placeholder="Nhập thông tin khác....">{!! auth('customer')->user()->expert ? auth('customer')->user()->expert->content : '' !!}</textarea>
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12">
                                    <label for="social_network">Mạng xã hội:</label>
                                    <input type="texxt" class="form-control mb-2" id="facebook" placeholder="Nhập tài khoản facebook... " value="{{ $social_network ? $social_network['facebook'] : ''}}" name="social_network[facebook]">
                                    <input type="text" class="form-control mb-2" id="tiktok" placeholder="Nhập tài khoản tiktok..." value="{{ $social_network ? $social_network['tiktok'] : ''}}" name="social_network[tiktok]" >
                                    <input type="text" class="form-control mb-2" id="zalo" placeholder="Nhập tài khoản zalo..." value="{{ $social_network ? $social_network['zalo'] : ''}}" name="social_network[zalo]" >
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="col-12">
                                    <div class="d-flex align-items-baseline">
                                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                        <label for="agree-term" class="label-agree-term">
                                            <b>Cam kết</b>: Tôi cam kết các thông tin trên là đúng sự thật và chịu trách nhiệm về tính xác thực mà tôi khai. Tôi đồng ý tham gia để trở thành chuyên gia trong mạng lưới chuyên gia của công ty và đồng ý để Hồ sơ của tôi được tiếp cận bởi các học viên của công ty và đồng ý tiếp nhận học viên để đào tạo, cố vấn, tư vấn huấn luyện nghề nghiệp cho các học viên phù hợp với kinh nghiệm trình độ chuyên môn của tôi theo chính sách của công ty mà tôi và công ty thống nhất bằng một thỏa thuận hợp tác.
                                        </label>
                                    </div>
                                    <label id="agree-term-error" class="error" for="agree-term"></label>
                                </div>
                            <div class=" button-group">
                                <button type="submit" class="send">Cập nhật</button>
                            </div>
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
@include('admin.lib.tinymce-setup')
@endprepend

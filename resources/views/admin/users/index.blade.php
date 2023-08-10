@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách khách hàng')
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
                        <form action="{{route('ad.user.export_excel')}}" method="GET">
                            @csrf
                            <input type="hidden" name="name" class="form-control" value="{{ old('name', $name ?? '') }}" >
                            <input type="hidden" name="phone" class="form-control" value="{{ old('phone', $phone ?? '') }}"  >
                            <input type="hidden" name="startDate" class="form-control" value="{{ old('startDate', $startDate ?? '') }}" id="startDate" >
                            <input type="hidden" name="endDate" class="form-control" value="{{ old('endDate', $endDate ?? '') }}" >
                            <button class="btn btn-circle btn-sm btn-primary" id="btnExportExcel"> <i class="fa fa-download" aria-hidden="true"></i> Xuất Excel</button>
                        </form>
                        {{-- <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a> --}}
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{route('ad.user.search')}}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $name ?? '') }}" id="name" placeholder="Nhập tên....">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="number" name="phone" class="form-control" value="{{ old('phone', $phone ?? '') }}" id="phone" placeholder="Nhập số điện thoại....">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="startDate">Từ</label>
                                    <input type="date" name="startDate" class="form-control" value="{{ old('startDate', $startDate ?? '') }}" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="endDate">Đến</label>
                                    <input type="date" name="endDate" class="form-control" value="{{ old('endDate', $endDate ?? '') }}" id="endDate">
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
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th width="3%">STT</th>
                                <th width="10%">Avatar</th>
                                <th width="10%">Tên</th>
                                <th width="7%">Giới tính</th>
                                <th width="7%">Email</th>
                                <th width="5%">Số điện thoại</th>
                                <th width="15%">Địa chỉ</th>
                                <th width="10%">Số tiền(vnđ)</th>
                                <th width="7%">Ngày tạo</th>
                                <th width="3%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td >{{ $key+1 }}</td>
                                <td ><img src="{{ $user->avatar  ? asset($user->avatar) : asset('/web/asset/images/avatar-mac-dinh.png')}}" style="max-width: 35px" alt=""></td>
                                <td >{{ $user->name}}</td>
                                <td >{{ $user->gender == 1 ? "Nam" : "Nữ"}}</td>
                                <td >{{ $user->email }}</td>
                                <td >{{ $user->phone }}</td>
                                <td >{{ $user->address ?? '....' }}</td>
                                <td >{{ number_format($user->money) }}</td>
                                <td >{{ \Carbon\Carbon::createFromDate($user->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-count" id="btn-count" data-toggle="modal" data-target="#payment" data-id="{{$user->id}}" data-url="{{route('ad.user.count', $user->id)}}" data-name="{{$user->name}}">
                                        Cộng trừ tiền
                                    </button>
                                </td>
                                {{-- <td >
                                    <a class="btn btn-circle btn-sm btn-primary" href="{{ route('ad.user.show', $user->id) }}">Xem chi tiết</a>
                                    <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.user.edit', $user->id) }}"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('ad.user.destroy', $user->id) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $users->withQueryString()->links('web.layouts.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cộng trừ tiền</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="count-money-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="count-type">Phương thức:</label>
                        <select class="form-control" name="count-type">
                            <option value="1">Cộng (+)</option>
                            <option value="0">Trừ (-)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="count-money">Số tiền:</label>
                        <input type="numer" name="count-money" class="form-control input-money" placeholder="Nhập số tiền ..." id="count-money">
                        <div class="input-convert-amount">
                            <p>= <span>0</span> VND</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="count-money">Nạp tiền</button>
                      </div>
                </form>
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
    <script>
        $(document).ready(function() {

            var format = function(num){
                var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
                if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
                }
                str = str.split("").reverse();
                for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                    output.push(str[j]);
                    if(i%3 == 0 && j < (len - 1)) {
                    output.push(",");
                    }
                    i++;
                }
                }
                formatted = output.reverse().join("");
                return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            };

            $('.btn-count').click(function (e) {
                let userId = $(this).data('id');
                let userName = $(this).data('name');
                let url = $(this).data('url');
                $('#payment #id').val(userId);
                $('#payment #name').val(userName);
                $('#count-money-form').attr('action', url);
            });

            $(".input-money").keyup(function () {
                var money = $(this).val();
                $('.input-convert-amount span').html(format(money));
                if(money == ''){
                    $('.input-convert-amount span').html('0');
                }
            });

            $(".input-money").keypress(function(event) {
                return /\d/.test(String.fromCharCode(event.keyCode));
            });
        })
    </script>
@endpush

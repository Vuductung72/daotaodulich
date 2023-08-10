@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Trang Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cog"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="">
                <h2 class="text-center font-weight-bold mb-3">Thống kê nạp tiền 30 ngày gần nhất</h2>
                <div id="chart_div"></div>
            </div>
            <hr>
            <h2 class="text-center font-weight-bold mt-3">Số tiền thực có thể rút</h2>
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-md-6">
                    <div class="card border-0" style="color:white !important; background: #364150!important;border-radius: 6px;">
                        <div  class="card-body p-2 text-center">
                            <h3 class="" style="font-weight:700">Số dư trong ví Momo</h3>
                            <h4 style="font-weight:700; padding-top:20px">{{$wallet['momo_wallet']}} VNĐ</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0" style="color:white !important; background: #364150!important;border-radius: 6px;">
                        <div  class="card-body p-2 text-center">
                            <h3 class="" style="font-weight:700">Số dư trong ví Online Banking</h3>
                            <h4 style="font-weight:700; padding-top:20px">{{$wallet['online_wallet']}} VNĐ</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection
@push('scripts')
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {
            var data = new google.visualization.DataTable();
            data.addColumn('string','Country');
            data.addColumn('number','Số tiền');
            data.addRows(<?=json_encode($payments)?>);

            var options = {
                title: 'Thống kế tiền theo ngày',
                hAxis: {
                    title: 'Ngày',
                },
                vAxis: {
                    title: 'Số tiền (VNĐ)'
                },
                height : 500
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
@endpush

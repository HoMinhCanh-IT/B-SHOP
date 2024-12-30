@extends('admin.layout')
@section('content')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">         
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">THỐNG KÊ</h3>
            </div>
            <div class="col-12" style="padding-top:10px;">
                <ul class="breadcrumb" style="border: none">
                    <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li>Thống kê</li>
                </ul>
            </div>
          </div>
          <div class="container">
            <form method="POST" action="{{route('statistical.result')}}" onsubmit="return CheckSubmit()">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <label for="exampleInputTitle">Ngày bắt đầu</label>
                        <input class="form-control" type="date" name="StartDay" id="StartDay" placeholder="Chọn ngày">
                    </div>
                    <div class="col-lg-5">
                        <label for="exampleInputTitle">Ngày kết thúc</label>
                        <input class="form-control" type="date" name="EndDay" id="EndDay" placeholder="Chọn ngày">
                    </div>
                    <div class="col-lg-2" style="padding-top:30px">
                        <button class="btn btn-primary" type="submit">Xem thống kê</button>
                    </div>
                </div>
            </form>
            </div>
            @if ($check == true)
            <hr/>
            <div class="">
                <h3 style="color:#0275d8; text-align:center">KẾT QUẢ THỐNG KÊ <!-- từ ngày <i style="color:red">{{ date('d-m-Y', strtotime($ngay_bat_dau)) }}</i> đến <i style="color:red">{{ date('d-m-Y', strtotime($ngay_ket_thuc)) }}</i> --></h3>
                <br/>
                <div class="row">
                <div class="col-md-3 grid-margin transparent">
                    <div class="row" style="height:100%">
                        <div class="col-md-12 mb-12 stretch-card transparent">
                        <div class="card card-light-statistical">
                        <div class="card-body">                       
                        <!--<table style="border: none; font-size: 25px; width:100%;">
                                <tr>
                                    <td>Số lượng đơn hàng đã hoàn thành:</td>
                                    <td>{{ $dh_ht }}</td>
                                </tr>
                                <tr>
                                    <td>Số lượng đơn hàng đang thực hiện:</td>
                                    <td>{{ $dh_dth }}</td>
                                </tr>
                                <tr>
                                    <td>Số lượng đơn hàng đã bị hủy:</td>
                                    <td>{{ $dh_huy }}</td>
                                </tr>
                                <tr style="color:red">
                                    <td>Tổng số lượng đơn hàng:</td>
                                    <td>{{ $dh_huy + $dh_ht + $dh_dth }}</td>
                                </tr>
                            </table>
                            <hr/> -->
                            <p class="mb-2">Đơn hàng</p>
                            <canvas id="pieChart"></canvas>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin transparent">
                    <div class="row" style="height:100%">
                        <div class="col-md-12 mb-12 stretch-card transparent">
                        <div class="card card-light-statistical">
                        <div class="card-body">                       
                        <!--<table style="border: none; font-size: 25px; width:100%;">
                                <tr>
                                    <td>Số lượng đơn hàng đã hoàn thành:</td>
                                    <td>{{ $dh_ht }}</td>
                                </tr>
                                <tr>
                                    <td>Số lượng đơn hàng đang thực hiện:</td>
                                    <td>{{ $dh_dth }}</td>
                                </tr>
                                <tr>
                                    <td>Số lượng đơn hàng đã bị hủy:</td>
                                    <td>{{ $dh_huy }}</td>
                                </tr>
                                <tr style="color:red">
                                    <td>Tổng số lượng đơn hàng:</td>
                                    <td>{{ $dh_huy + $dh_ht + $dh_dth }}</td>
                                </tr>
                            </table>
                            <hr/> -->
                            <p class="mb-2">Dữ liệu mới</p>
                            <canvas id="barChart" width="200" height="200"></canvas>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                    <div class="row" style="height:100%">
                        <div class="col-md-12 mb-12 stretch-card transparent">
                        <div class="card card-light-statistical">
                            <div class="card-body">
                            <p class="mb-4">Sách bán chạy nhất</p>
                            @if($sach_ban_chay != null)
                            <p class="mb-2" style="font-size: 20px">{{ $sach_ban_chay->Ten_Sach }}</p>
                            <div class="row" style="padding-top:20px">
                                <div class="col-lg-12" style="display: inline-flex;">
                                <div class="col-lg-2">
                                    <img src="{{$sach_ban_chay->Anh_Bia}}" style="width:100px; height:100px; border-radius:0%">
                                </div>
                                <div class="col-lg-3" style="margin-left:10px">
                                    <p style="font-size:15px; line-height:1.5">Tác giả:</p>
                                    <p style="font-size:15px; line-height:1.5">Nhà xuất bản:</p>
                                    <p style="font-size:15px; line-height:1.5">Thể loại:</p>
                                </div>
                                <div class="col-lg-7">
                                    <p style="font-size:15px; line-height:1.5">{{ $sach_ban_chay->Tac_Gia }}</p>
                                    <p style="font-size:15px; line-height:1.5">{{ $sach_ban_chay->NhaXuatBan->Ten_NXB }}</p>
                                    <p style="font-size:15px; line-height:1.5">{{ $sach_ban_chay->TheLoai->The_Loai }}</p>
                                </div>
                                </div>
                            </div>
                            </br>
                            <hr/>
                            <p class="mb-2" style="font-size: 20px; font-weight:bold">Số lượng bán được: {{ $sl_sach_ban_chay }}</p>
                            @endif
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card card-light-statistical">
                    <p class="card-title mb-2 fs-30" style="padding-left:30px; padding-top:10px"> Doanh thu: <input style="border:none; font-size:20px" value="{{ number_format($doanh_thu) }} VNĐ" disabled/> </p>
                    <div class="card-body">
                        <canvas id="myChart" style="width:100%; padding-left:100px; padding-right:100px; height:800px"></canvas>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <input type="hidden" id="dh_huy" value="{{ $dh_huy }}"/>
            <input type="hidden" id="dh_ht" value="{{ $dh_ht }}"/>
            <input type="hidden" id="dh_dth" value="{{ $dh_dth }}"/>
            <input type="hidden" id="kh_moi" value="{{ $kh_moi }}"/>
            <input type="hidden" id="sach_moi" value="{{ $sach_moi }}"/>
            <input type="hidden" id="tt_moi" value="{{ $tt_moi }}"/>
            <div style="height:0px">
            @for ($a = 0; $a < $i; $a++)
              @if ($bd_ngay[$a]['tien'] != 0)
              <h5 style="visibility: hidden;">{{ date('d-m-Y', strtotime($bd_ngay[$a]['ngay'])) }}</h5>
              <h6 style="visibility: hidden;">{{ $bd_ngay[$a]['tien'] }}</h6>
              @endif
            @endfor
            </div>
            @endif
          </div>        
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function CheckSubmit(){
      var strday = document.getElementById("StartDay").value;
      var endday = document.getElementById("EndDay").value;
      var today = new Date();
      var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
      if (strday == "" || endday == "")
      {
        alert("Vui lòng chọn ngày để xem thống kê!");
        return false;
      }
      else if (strday > endday)
      {
        alert("Ngày bắt đầu không lớn hơn ngày kết thúc!");
        return false;
      }  
      else return true;
    }

    function Active(){
      var element = document.getElementById("active_statistical");
      element.classList.add("active");
    }
    window.onload = Active();

    var xValues = ["Hoàn thành", "Đang thực hiện", "Đã hủy"];
    var label = ["Khách hàng", "Sách", "Tin tức"];
    var pieColors = ["green", "orange","red"];
    var barColors = ['rgba(255, 99, 132, 0.2)','rgba(255, 159, 64, 0.2)','rgba(255, 205, 86, 0.2)'];
    var yValues = [];
    var dh_ht = document.getElementById('dh_ht').value;
    yValues.push(dh_ht);
    var dh_dth = document.getElementById('dh_dth').value;
    yValues.push(dh_dth);
    var dh_huy = document.getElementById('dh_huy').value;
    yValues.push(dh_huy);

    var barValues = [];
    var kh_moi = document.getElementById('kh_moi').value;
    barValues.push(kh_moi);
    var sach_moi = document.getElementById('sach_moi').value;
    barValues.push(sach_moi);
    var tt_moi = document.getElementById('tt_moi').value;
    barValues.push(tt_moi);
    new Chart("pieChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: pieColors,
      fill: false,
      legend: false,
      data: yValues
    }]
  },
  options: {
    legend: {display: true},
    radius: 100,
  }
});

new Chart("barChart", {
  type: "bar",
  data: {
    axis: 'y',
    labels: label,
    datasets: [{
      backgroundColor: barColors,
      fill: false,
      legend: false,
      data: barValues,
      borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)']
    }]
  },
  options: {
    legend: {display: true},
    radius: 100,
  }
});


var labelBarChart = [];
$('h5').each(function(e){
  labelBarChart.push( $(this).text() );
});
var valueBarChart = [];
$('h6').each(function(e){
  valueBarChart.push( $(this).text() );
});
var barColorsDT = ['rgba(255, 99, 132, 0.5)'];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: labelBarChart,
    datasets: [{
      backgroundColor: barColorsDT,
      fill: false,
      legend: false,
      data: valueBarChart
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    indexAxis: 'y',
    legend: {display: false},
    plugins: {
        title: {
            display: true,
            text: 'Biểu đồ doanh thu',
            fullSize: true
        }
    }
  }
});
</script>
@stop
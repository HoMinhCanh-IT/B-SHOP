@extends('admin.layout')
@section('content')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">         
          <div class="row">           
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Số lượng sách bán ra trong ngày</p>
                      <p class="fs-30 mb-2">{{ $sum }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Số đơn đặt hàng trong ngày</p>
                      <p class="fs-30 mb-2">{{ $sldh }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Số lượng khách hàng mới trong ngày</p>
                      <p class="fs-30 mb-2">{{ $user }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Tổng giá trị các đơn hàng trong ngày</p>
                      <p class="fs-30 mb-2">{{ number_format($ttdh) }} VNĐ</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row" style="height:100%">
                <div class="col-md-12 mb-12 stretch-card transparent">
                  <div class="card card-light-yellow">
                    <div class="card-body">
                      <p class="mb-4">Sách bán ra nhiều nhất trong ngày</p>
                      @if($sach != null)
                      <p class="fs-30 mb-2">{{ $sach->Ten_Sach }}</p>
                      <div class="row" style="padding-top:20px">
                        <div class="col-lg-12" style="display: inline-flex;">
                          <div class="col-lg-2">
                            <img src="{{$sach->Anh_Bia}}" style="width:100px; height:100px; border-radius:0%">
                          </div>
                          <div class="col-lg-3" style="margin-left:10px">
                            <p style="font-size:20px; line-height:1.5">Tác giả:</p>
                            <p style="font-size:20px; line-height:1.5">Nhà xuất bản:</p>
                            <p style="font-size:20px; line-height:1.5">Thể loại:</p>
                          </div>
                          <div class="col-lg-7">
                            <p style="font-size:20px; line-height:1.5">{{ $sach->Tac_Gia }}</p>
                            <p style="font-size:20px; line-height:1.5">{{ $sach->NhaXuatBan->Ten_NXB }}</p>
                            <p style="font-size:20px; line-height:1.5">{{ $sach->TheLoai->The_Loai }}</p>
                          </div>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <p class="card-title mb-2 fs-30" style="padding-left:30px; padding-top:10px"> Tổng doanh thu của tháng: <input id="total" style="border:none; font-size:20px" disabled/> </p>
                <div class="card-body">
                  <canvas id="myChart" style="width:100%; padding-left:100px; padding-right:100px; height:500px"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-2 fs-30">Danh sách sản phẩm bán chạy</p>
                  <div class="table-responsive" style="margin-top:20px">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr style="background-color:yellow">
                          <th>Tên sách</th>
                          <th>Ảnh bìa</th>
                          <th>Tác giả</th>
                          <th>Số lượng bán ra (quyển)</th>
                          <th>Số lượng tồn (quyển)</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @foreach ($ctdh1->sortByDesc('So_Luong') as $ct)
                        <tr>
                          <td>{{$ct->Sach->Ten_Sach}}</td>
                          <td><img src="{{$ct->Sach->Anh_Bia}}" style="width:80px; height:80px; border-radius:0%"></td>
                          <td>{{$ct->Sach->Tac_Gia}}</td>
                          <td style="text-align:center">{{$ct->So_Luong}}</td>
                          <td style="text-align:center">{{$ct->Sach->So_Luong}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">							
            </div>
          </div>         
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    <input type="hidden" id="tuan1" value="{{ $tuan1 }}"/>
    <input type="hidden" id="tuan2" value="{{ $tuan2 }}"/>
    <input type="hidden" id="tuan3" value="{{ $tuan3 }}"/>
    <input type="hidden" id="tuan4" value="{{ $tuan4 }}"/>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
  };
var xValues = ["Tuần 1 (1->7)", "Tuần 2 (8->15)", "Tuần 3 (16->23)", "Tuần 4 (24->Hết)"];
var yValues = [];
var tuan1 = document.getElementById('tuan1').value;
yValues.push(tuan1);
var tuan2 = document.getElementById('tuan2').value;
yValues.push(tuan2);
var tuan3 = document.getElementById('tuan3').value;
yValues.push(tuan3);
var tuan4 = document.getElementById('tuan4').value;
yValues.push(tuan4);
var total = document.getElementById('total');
total.value = (parseInt(tuan1) + parseInt(tuan2) + parseInt(tuan3) + parseInt(tuan4)).format() + " VNĐ";
var barColors = ["red", "green","blue","orange"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      fill: false,
      legend: false,
      data: yValues
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
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
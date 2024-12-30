@extends('admin.layout')
@section('content')
<style>
  .or-cancel{
    opacity: 0.5;
    font-style: italic;
  }
</style>
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold" >QUẢN LÝ ĐƠN HÀNG</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Quản lý đơn hàng</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px">
                <form id="" method="POST" action="{{ route('order.search')}}" style="float:right">
                @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="NhapTimKiem" placeholder="Tìm kiếm" >                     
                      <button id="btnsearch" style="padding: 0.5rem 1.5rem; border-radius: 10px;background:#a3a4a5c2"><i class='fas fa-search' style='font-size:15px'></i></button>
                  </form>
                </div>
                  <!-- /.card-header -->
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0" >
                    <div class="card-body">
                    <table id="order" class="table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Số Điện Thoại</th>
                    <th>Ngày Lập</th>
                    <th>Địa chỉ giao hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($don_hang as $order)
                
                  <tr>
                    @if ($order->Trang_Thai == 4)
                    <td class="or-cancel">{{$order->Id}}</td>
                    <td class="or-cancel">{{$order->Account->Ho_Ten}}</td>
                    <td class="or-cancel">{{$order->Account->So_Dien_Thoai}}</td>
                    <td class="or-cancel" >{{date("d-m-Y", strtotime($order->Ngay_Lap))}}</td>
                    <td class="or-cancel" >{{$order->Dia_Chi_Giao_Hang}}</td>
                    <td class="or-cancel">{{number_format($order->Tong_Tien).' '. 'VNĐ'}}</td>
                    <td class="or-cancel">
                        @if($order->Trang_Thai == 0) {{"Chờ nhận đơn"}}
                        @elseif (($order->Trang_Thai == 1)) {{"Đã nhận đơn"}}
                        @elseif (($order->Trang_Thai == 2)) {{"Đang giao"}}
                        @elseif (($order->Trang_Thai == 3)) {{"Đã giao"}}
                        @else {{"Đã hủy"}}
                        @endif
                    </td>
                    <td>
                    <form action="{{ route('order.destroy',$order->Id) }}" method="POST">
                    @else
                    <td>{{$order->Id}}</td>
                    <td>{{$order->Account->Ho_Ten}}</td>
                    <td>{{$order->Account->So_Dien_Thoai}}</td>
                    <td>{{date("d-m-Y", strtotime($order->Ngay_Lap))}}
                    </td>
                    <td>{{$order->Dia_Chi_Giao_Hang}}</td>
                    <td>{{number_format($order->Tong_Tien).' '. 'VNĐ'}}</td>
                    <td>
                        @if($order->Trang_Thai == 0) {{"Chờ nhận đơn"}}
                        @elseif (($order->Trang_Thai == 1)) {{"Đã nhận đơn"}}
                        @elseif (($order->Trang_Thai == 2)) {{"Đang giao"}}
                        @elseif (($order->Trang_Thai == 3)) {{"Đã giao"}}
                        @else {{"Đã hủy"}}
                        @endif
                    </td>                  
                    <td>
                    <form action="{{ route('order.destroy',$order->Id) }}" method="POST">
                    <a href="{{ route('order.show', $order->Id) }}" class="btn btn-success" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-eye' style='font-size:15px'></i></a>
                    <a href="{{ route('order.edit', $order->Id) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                    @endif                       
                          @csrf
                          @method('DELETE')                        
                          <button  onclick="return ComfirmDelete();" type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></button>

                        </form>
                        
                    </td>
                  </tr>
                 
                  @endforeach
                  </tbody>
                </table>
             
              </div>
              <!-- /.card-body -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function ComfirmDelete() {
  var txt;
  if (confirm("Bạn có muốn xóa đơn hàng đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
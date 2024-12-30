@extends('admin.layout')
@section('content')
<style>
    .row{
        
        
    }
    table, th, td {
  border: 1px solid black;
}
 th, td {
  padding:10px;
}
    
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container" style="border: solid 1px">
            <!-- form start -->
                
                    <div class="col-12 ">
                        <h3 style="text-align:center; color: black; letter-spacing: 2px; padding-top: 10px">CHI TIẾT ĐƠN HÀNG</h3>
                        <div class="row">
                            <div class="col-lg-12" style="display: inline-flex; padding-top:50px">
                                <div class="col-lg-4">
                                Mã đơn hàng: <b style="color:red">{{ $don_hang->Id }}</b>
                                </div> 
                                <div class="col-lg-4">
                                Tên người nhận: <b style="color:red">{{ $don_hang->Account->Ho_Ten }}</b>
                                </div>
                                <div class="col-lg-4">
                                Ngày lập đơn: <b style="color:red">{{date("d-m-Y H:i:s", strtotime($don_hang->Ngay_Lap))}}</b>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top:20px">
                            <div class="col-lg-12" style="display: inline-flex;">
                                <div class="col-lg-6">
                                    Địa chỉ giao hàng: <b style="color:red">{{ $don_hang->Dia_Chi_Giao_Hang }}</b>
                                </div>
                                <div class="col-lg-6">
                                    Phương thức thanh toán: 
                                    @if ($don_hang->PT_Thanh_Toan == 0) <b style="color:red">Thanh toán khi nhận hàng(COD)</b>
                                    @elseif ($don_hang->PT_Thanh_Toan == 1) <b style="color:red">Thanh toán qua VNPay</b>
                                    @else <b style="color:red">Thanh toán qua E-Banking</b>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div  class="row" style="padding:20px">
                                <h5>Danh sách sản phẩm</h5>
                                <table  style="width:990px; margin-top:20px; margin-bottom: 20px;padding:10px">
                                <thead>
                                <tr style="background-color: #9a9a9a">
                                    <th >Tên sách</th>
                                    <th>Ảnh bìa</th>
                                    <th>Tác giả</th>
                                    <th>Phiên bản</th>
                                    <th>Số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ct as $sp)
                                <tr >
                                    <td>{{ $sp->Sach->Ten_Sach }}</td>
                                    <td><img src="{{ $sp->Sach->Anh_Bia }}" style="width:80px; height:80px; border-radius:0%"></td>
                                    <td>{{ $sp->Sach->Tac_Gia }}</td>
                                    <td>
                                        @if ($sp->Sach->Phien_Ban == 0) Bản thường
                                        @else Bản đặc biệt
                                        @endif
                                    </td>
                                    <td>{{ $sp->So_Luong }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                        </div>
                    </div>
                    <div class="row" style="float: right; padding-top: 15px; margin-bottom:50px; font-size: 130%">Tổng tiền: &nbsp; <b style="color:red">{{ number_format($don_hang->Tong_Tien) }} VNĐ</b></div>
                    <div class="row" style="float:left; padding-top: 15px; margin-bottom:50px" >
                    <a  href="{{route('order.index')}}"><i class="fa fa-arrow-left" style="font-size:160%;color:black"></i></a>
                    </div>
              
        </div>
        
    </div>
</div>
@stop
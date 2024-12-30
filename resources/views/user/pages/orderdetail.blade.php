@extends('user.layout')
@section('content')
<style>
td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
	}
</style>
<!-- banner -->
<div class="banner_inner">
	<div class="services-breadcrumb">
		<div class="inner_breadcrumb">
			<ul class="short">
				<li>
					<a href="{{route('user.index')}}">Trang chủ</a>
					<i class='fas fa-angle-right'></i>
				</li>
				<li>
					<a href="{{route('user.cart')}}">Đơn hàng {{ $Id }}</a>
					<i class='fas fa-angle-right'></i>
				</li>
				<li> Chi tiết </li>
			</ul>
		</div>
	</div>
</div>
<!--//banner -->
<!--// header_top -->
<!--checkout-->
<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
	<div class="container" style="border: solid 1px">
		<div class="inner-sec-shop px-lg-4 px-3">
		<h3 style="text-align:center; color: #9c9b9b; letter-spacing: 2px; padding-top: 10px">CHI TIẾT ĐƠN HÀNG</h3>
			<div class="row">
                <div class="col-lg-12" style="display: inline-flex; padding-top:50px">
                    <div class="col-lg-4">
                        Mã đơn hàng: <b style="color:red">{{ $Id }}</b>
                    </div>
                    @foreach ($kh as $user)
                    <div class="col-lg-4">
                        Tên người nhận: <b style="color:red">{{ $user->Ho_Ten }}</b>
                    </div>
                    @endforeach
                    <div class="col-lg-4">
                        Ngày lập đơn: <b style="color:red">{{date("d-m-Y H:i:s", strtotime($Ngay_Lap))}}</b>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top:20px">
                <div class="col-lg-12" style="display: inline-flex;">
                    <div class="col-lg-6">
                        Địa chỉ giao hàng: <b style="color:red">{{ $Dia_Chi_Giao_Hang }}</b>
                    </div>
                    <div class="col-lg-6">
                        Phương thức thanh toán: 
                        @if ($PT_Thanh_Toan == 0) <b style="color:red">Thanh toán khi nhận hàng(COD)</b>
                        @elseif ($PT_Thanh_Toan == 1) <b style="color:red">Thanh toán qua VNPay</b>
                        @else <b style="color:red">Thanh toán qua E-Banking</b>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top:50px">
                <div class="col-lg-12">
                    <h5>Danh sách sản phẩm</h5>
                    <table style="width:1060px; margin-top:20px; margin-bottom: 20px">
                    <thead>
                    <tr style="background-color: #9a9a9a">
                        <th>Tên sách</th>
                        <th>Ảnh bìa</th>
                        <th>Tác giả</th>
                        <th>Phiên bản</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ctdh as $sp)
                    <tr>
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
            <div class="row" style="float: right; padding-top: 15px; margin-bottom:50px; font-size: 130%">Tổng tiền: &nbsp; <b style="color:red">{{ number_format($Tong_Tien) }} VNĐ</b></div>
		</div>
	</div>
</section>
<!--//checkout-->
<!--footer -->
@stop
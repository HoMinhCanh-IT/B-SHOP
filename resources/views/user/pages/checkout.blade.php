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
					<a href="{{route('user.cart')}}">Giỏ hàng</a>
					<i class='fas fa-angle-right'></i>
				</li>
				<li>Thanh toán </li>
			</ul>
		</div>
	</div>
</div>
<!--//banner -->
<!--// header_top -->
<!--checkout-->
<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
	<div class="container">
		<div class="inner-sec-shop px-lg-4 px-3">
		<h3>THANH TOÁN</h3>
			<div class="checkout-left row">
				<div class="col-md-5 address_form">
					<div class="container-fluid" style="border:1px solid;">
					<h4>Thông tin nhận hàng</h4>
					<form action="#" method="post" class="creditly-card-form agileinfo_form">
						@csrf
						<section class="creditly-wrapper wrapper">
							<div class="information-wrapper">
								<div class="first-row form-group">
									<div class="controls">
										<label class="control-label">Họ và tên: </label>
										<input class="billing-address-name form-control" value="{{$Ho_Ten}}" type="text" name="name_checkout" placeholder="Họ và tên" readonly/>
									</div>
									
									<div class="controls">
										<label class="control-label">Số điện thoại:</label>
										<input class="form-control" type="text" value="{{$So_Dien_Thoai}}" placeholder="Số điện thoại" name="phone_checkout" readonly/>
									</div>
									<div class="controls">
										<label class="control-label">Email: </label>
										<input class="billing-address-name form-control" value="{{$Email}}" type="text" name="email-checkout" placeholder="Email" readonly/>
									</div>
									<div class="controls">
										<label class="control-label">Địa chỉ: </label>
										<input class="form-control" type="text" value="{{$Dia_Chi}}" id="Dia_Chi" name="address_checkout" placeholder="Địa chỉ" readonly/>
										<button type="button" class="btn btn-primary" onclick="changeAddress()" style="margin-top:-25px"><i class="fas fa-sync-alt"></i></button>
									</div>				
								</div>							
							</div>
						</section>
					</form>
					</div>
				</div>
				<div class="col-md-7 address_form">
					<div class="container-fluid" style="border:1px solid;">
					<h4>Đơn hàng</h4>
					<table style="margin-bottom: 15px">
					<tr style="background-color:yellow">
					<th>Ảnh Bìa</th>
					<th>Tên Sách</th>
					<th>Số lượng</th>
					<th>Tổng tiền</th>
					</tr>
					@foreach ($sach as $book)
					<input type="hidden" value="{{$book->Id}}" id="Id_Sach" />
					<input type="hidden" value="{{$book->So_Luong}}" id="So_Luong" />
					<tr>
					<td>
						@if($book->Anh_Bia != null) <img src="{{$book->Anh_Bia}}" style="width:80px; height:80px"/>
						@else <img src="{{$book->Sach->Anh_Bia}}" style="width:80px; height:80px"/>
						@endif
					</td>
					<td style="text-overflow:clip; overflow:hidden; max-width:180px">
						@if($book->Ten_Sach != null) {{ $book->Ten_Sach }}
						@else {{ $book->Sach->Ten_Sach }}
						@endif
					</td>
					<td>{{$book->So_Luong}}</td>
					@if($book->Sach->Gia_Khuyen_Mai != 0)
						@if($book->Gia_Khuyen_Mai != null) <td class="total" title="{{ $book->Gia_Khuyen_Mai * $book->So_Luong }}">{{ number_format($book->Gia_Khuyen_Mai * $book->So_Luong) }} VNĐ </td>
						@else <td class="total" title="{{ $book->Sach->Gia_Khuyen_Mai * $book->So_Luong }}">{{ number_format($book->Sach->Gia_Khuyen_Mai * $book->So_Luong) }} VNĐ </td>
						@endif
					@else
						@if($book->Gia_Tien != null) <td class="total" title="{{ $book->Gia_Tien * $book->So_Luong }}">{{ number_format($book->Gia_Tien * $book->So_Luong) }} VNĐ </td>
						@else <td class="total" title="{{ $book->Sach->Gia_Tien * $book->So_Luong }}">{{ number_format($book->Sach->Gia_Tien * $book->So_Luong) }} </td>
						@endif
					@endif
					</tr>
					@endforeach
					</table>
					</div>	
					<div style="text-align:right; margin-top: 15px; font-size:90%; font-weight:bold; color: #888"> Tổng đơn hàng: <input style="width:110px; border:none; font-size:110%; text-align:right" id="order-total" readonly/></div>		
					<div style="text-align:right; margin-top: 5px; font-size:90%; font-weight:bold; color: #888"> Phí giao hàng: 15,000 VNĐ</div>
					<hr style="margin-top:10px; margin-bottom:-15px" />
					<div style="text-align:right; margin-top: 20px; font-size:120%; font-weight:bold; color: #888"> Tổng cộng: <input style="width:130px; border:none; color:red; text-align:right" id="total" readonly/></div>
					<div class="container-fluid" style="border:1px solid; margin-top:15px;">	
					<h4>Phương thức thanh toán</h4>
						<div class="col-lg-12" style="display: flex; margin-bottom: 15px">
							<div class="col-lg-4">
								<input type="radio" name="Hinh_Thuc" value="0" style="cursor: pointer" checked/> COD <br/>
								<img src="{{asset('user/images/ship-cod.jpg')}}" style="width:140px; height:90px" />
							</div>
							<div class="col-lg-4">
								<input type="radio" name="Hinh_Thuc" value="1" style="cursor: pointer" /> VNPAY <br/>
								<img src="{{asset('user/images/vnpay.jpg')}}" style="width:140px; height:90px" />
							</div>
							<div class="col-lg-4">
								<input type="radio" name="Hinh_Thuc" value="2" style="cursor: pointer" /> E-Banking <br/>
								<img src="{{asset('user/images/e-banking.jpg')}}" style="width:140px; height:90px" />
							</div>
						</div>
					</div>
					@if($sach->count() == 1)
					<div class="checkout-right-basket">
						<a style="color:white; cursor:pointer" onclick="PaymentQuick()">Đặt hàng </a>
					</div>
					@else
					<div class="checkout-right-basket">
						<a id="payment" style="color:white; cursor:pointer" onclick="PaymentCart()">Đặt hàng </a>
					</div>
					@endif
				</div>

				<div class="clearfix"> </div>

			</div>

		</div>

	</div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleSuccessModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #28a745; margin: -1px -1px 0 0;">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-size:120%; padding-left:130px"></h5>
      </div>
	  <div class="modal-body" style="background-color: #28a745; height:150px; margin: -1px -1px 0 0;">
	  	<i class="fas fa-check-circle" style="color:white; font-size:400%; padding-left: 215px;"></i>
	  	<h3 style="color:white; font-size:120%; text-align:center; padding-top:30px"> ĐẶT HÀNG THÀNH CÔNG! </h3>
      </div>
      <div class="modal-footer" style="background-color:white; height:50px">
        <a class="btn btn-secondary" style="color:white" href="{{route('user.account')}}">Quản lý tài khoản <i class="fas fa-user"></i></a>
        <a class="btn btn-secondary" href="{{route('user.index')}}">Đến trang chủ <i class="fas fa-home"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<!--/ End Checkout -->
	<!--//checkout-->
	<script>
		Number.prototype.format = function(n, x) {
			var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
			return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
		};
		window.onload = function(){
			var total = [];
			$('.total').each(function (index, e) {
                total.push(e.title);
			});
			var money = 0;
			total.forEach(element => money = parseInt(money) + parseInt(element));
			document.getElementById('order-total').value = money.format() + " VNĐ";
			var total = parseInt(money) + parseInt(15000);
			if (money === 0) document.getElementById('payment').hidden = true;
			document.getElementById('total').value = total.format() + " VNĐ";
			document.getElementById('total').title = total;
		}

		function PaymentCart(){
			var ptthanhtoan = 0;
			var check = document.getElementsByName('Hinh_Thuc');
                for (var i = 0; i < check.length; i++){
                    if (check[i].checked === true){
                        ptthanhtoan = check[i].value;
                    }
                }
			var tongtien = document.getElementById('total').title;
			var diachi = document.getElementById('Dia_Chi').value;
                $.ajax({
                    url: "{{ route('account.createpaymentcart') }}",
                    type:'POST',
                    data: {Tong_Tien: tongtien, Dia_Chi: diachi, Hinh_Thuc: ptthanhtoan,_token: '{{ csrf_token() }}' },
                    success: function(data) {
						$('#exampleSuccessModalCenter').modal('show');
                    }
                });
		}

		function PaymentQuick(){
			var ptthanhtoan = 0;
			var check = document.getElementsByName('Hinh_Thuc');
                for (var i = 0; i < check.length; i++){
                    if (check[i].checked === true){
                        ptthanhtoan = check[i].value;
                    }
                }
			var idsach = document.getElementById('Id_Sach').value;
			var tongtien = document.getElementById('total').title;
			var diachi = document.getElementById('Dia_Chi').value;
			var soluong = document.getElementById('So_Luong').value;
                $.ajax({
                    url: "{{ route('account.createpaymentquick') }}",
                    type:'POST',
                    data: {Tong_Tien: tongtien, Dia_Chi: diachi, Hinh_Thuc: ptthanhtoan, Id_Sach: idsach, So_Luong: soluong,_token: '{{ csrf_token() }}' },
                    success: function(data) {
						$('#exampleSuccessModalCenter').modal('show');
                    }
                });
		}

		function changeAddress(){
			document.getElementById('Dia_Chi').readOnly = false;
		}
	</script>
<!--//checkout-->
<!--footer -->
@stop
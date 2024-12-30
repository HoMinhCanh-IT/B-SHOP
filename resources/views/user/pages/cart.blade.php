

@extends('user.layout')
@section('content')
		<!-- banner -->
		<div class="banner_inner">
			<div class="services-breadcrumb">
				<div class="inner_breadcrumb">

					<ul class="short">
						<li>
							<a href="index.html">Trang chủ</a>
							<i>|</i>
						</li>
						<li>Giỏ hàng </li>
					</ul>
				</div>
			</div>

		</div>
		<!--//banner -->
	</div>
	<!--// header_top -->
	<!--checkout-->
	<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
		<div class="container">
			<div class="inner-sec-shop">
				<h3 class="tittle-w3layouts my-lg-4 mt-3">GIỎ HÀNG </h3>
				<div class="checkout-right">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Ảnh bìa</th>
								<th>Tên sản phẩm</th>
								<th>Số lượng</th>
								<th>Giá</th>
								<th>Tổng tiền</th>
								<th>Thao tác</th>
							</tr>
						</thead>
						<tbody>
						@foreach($gio_hang as $cart)
						<form action="{{ route('account.updatecart')}}" method="POST">
							{{csrf_field()}}
							<tr class="rem1">
								<td class="invert-image" style="width: 250px; height: 150px;">
									<a href="{{ route('user.single', $cart->Sach->Id)}}">
										<img src="{{$cart->Sach->Anh_Bia}}" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">{{$cart->Sach->Ten_Sach}} </td>
								<td class="invert">					
									<input type="number" min="1" max="{{ $cart->Sach->So_Luong}}" name="So_Luong" style="width:50px;border: 1px solid #CDCDCD;color: #868282" value="{{$cart->So_Luong}}">
									<input type="hidden" name="Id" value="{{$cart->Id}}" class="form-control">
								</td>
								@if ($cart->Sach->Gia_Khuyen_Mai == 0)
								<td class="invert">{{number_format($cart->Sach->Gia_Tien)}} VNĐ</td>
								<td class="total invert" title="{{$cart->Sach->Gia_Tien * $cart->So_Luong}}">
								{{ number_format($cart->Sach->Gia_Tien * $cart->So_Luong) }} VNĐ
								</td>
								@else
								<td class="invert">{{number_format($cart->Sach->Gia_Khuyen_Mai)}} VNĐ</td>
								<td class="total invert" title="{{$cart->Sach->Gia_Khuyen_Mai * $cart->So_Luong}}">
								{{ number_format($cart->Sach->Gia_Khuyen_Mai * $cart->So_Luong) }} VNĐ
								</td>
								@endif
								<td class="invert">
									<button class="cart-hover" type="submit" style="background:white; border:none; cursor:pointer"><i class="fas fa-sync-alt" style="font-size:15px"></i></button> &nbsp;
									<a class="cart-hover" href="{{ route('account.cartdelete', [$cart->Id])}}">
										<i class="fas fa-trash-alt" style="font-size:15px;"></i>
									</a>
								</td>
							</tr>
							
						</form>
						@endforeach						
						</tbody>
					</table>
					@if ($gio_hang->count() == 0)
						<h4 style="text-align: center;">Chưa có sản phẩm nào trong giỏ hàng.</h4>
					@endif
					<div class="col-md-4 checkout-right-basket">
						<ul>				
							<li style="font-size:120%; font-weight:600">Tổng tiền: &nbsp;	
								<input id="money-total" style="border: none; color: #f40017; text-align:right" readonly/>
							</li>
						</ul>
						<a id="btn-pay" href="{{ route('account.paymentcart') }}" class="btn">THANH TOÁN</a>
						<a href="{{ route('user.shop',0) }}" class="btn">TIẾP TỤC MUA SẮM</a>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</section>
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
			document.getElementById('money-total').value = money.format() + " VNĐ";
			if (money === 0)
			{
				document.getElementById('btn-pay').hidden = true;
			}
		}
	</script>
	<!--footer -->
	@stop
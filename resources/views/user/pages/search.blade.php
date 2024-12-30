@extends('user.layout')
@section('content')
		<!-- banner -->
		<div class="banner_inner">
			<div class="services-breadcrumb">
				<div class="inner_breadcrumb">
                    <ul class="short">
						<li>
							<a href="{{route('user.index')}}">Trang Chủ</a>
							<i class='fas fa-angle-right'></i>
						</li>
						<li>KẾT QUẢ TÌM KIẾM</li>
					</ul>
					
				</div>
			</div>
		</div>
		<!--//banner -->
		<!--/shop-->
		<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
			<div class="container-fluid">
				<div class="inner-sec-shop px-lg-4 px-3">
					
					<div class="row">
						<!-- product left -->
						
						<!-- //product left -->
						<!--/product right-->
						<div class="left-ads-display col-lg-12">
							<div class="wrapper_top_shop">
								
								
								<div class="row">
									<!-- /womens -->
									@foreach($search_book as $sbook)
									<div class="col-md-3 product-men women_two shop-gd">
										<div class="product-googles-info googles">
											<div class="men-pro-item">
												<div class="men-thumb-item">
													<img src="{!! asset($sbook->Anh_Bia) !!}" class="img-fluid anh-bia" alt="">
													<div class="men-cart-pro">
														<div class="inner-men-cart-pro">
															<a href="{{ route('user.single',$sbook->Id)}}" class="link-product-add-cart">Xem ngay</a>
														</div>
													</div>
													<span class="product-new-top">Mới</span>
												</div>
												<div class="item-info-product">
													<div class="info-product-price">
														<div class="grid_meta">
															<div class="product_price">
																<h4 class= "hidden"> 
																	<a class="ten-sach" href="{{ route('user.single',$sbook->Id)}}">{{$sbook->Ten_Sach}}</a>
																</h4>
																<div class="grid-price mt-2">
																	<span class="money gia-tien">{{number_format($sbook->Gia_Tien).' '. 'VNĐ'}}</span>
																</div>
															</div>
														</div>
														<!-- Thêm vào giỏ hàng -->
														@if (Cookie::get('UserId') != null)
														<div class="googles single-item hvr-outline-out">
															<form action="" method="POST">
																{{csrf_field()}}
																<button type="button" class="googles-cart pgoogles-cart" onclick="AddCart({{ $sbook->Id }})" style="">
																	<i class="fas fa-cart-plus"></i>
																</button>								
															</form>
														</div>
														<div class="googles single-item hvr-outline-out" style="">
															<form>
															{{ csrf_field() }}
																<button type="button" class="googles-heart" onclick="Favorite({{ $sbook->Id }})">
																	<i class="fas fa-heart"></i>
																</button>	
															</form>
														</div>
														@endif
													</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									<div id="snackbar">Đã thêm vào sách yêu thích</div>
								</div>
								<br>
								{!! $search_book->links() !!}
								
						
								
						</div>
						<!--//product right-->
					</div>
			</div>
		</section>
		<script>
    		window.onload = function(){
				var x = localStorage.getItem("mysearch");
				var y = location.href;
				var vt = y.indexOf("search");
				if (vt != -1)
				{
					var attr = y.slice(vt);
					localStorage.mysearch = attr;
				}
				if (y.search("page") != -1){
					if (x != null){		
						x = localStorage.getItem("mysearch");
						var url = y + "&" + x;										
						window.location.href = url;	
						localStorage.removeItem("mysearch");				
					}
				}
			}

			function saveSearch(){
				$('#form-search').submit();				
			}
		</script>
        @stop
		
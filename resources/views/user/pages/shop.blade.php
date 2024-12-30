@extends('user.layout')
@section('content')
<style>
    .dropdown-menu6 .price-active{
        color: #ff4e00;
    }
</style>
		<!-- banner -->
		<div class="banner_inner">
			<div class="services-breadcrumb">
				<div class="inner_breadcrumb">

					<ul class="short">
						<li>
							<a href="{{route('user.index')}}">Trang Chủ</a>
							<i>|</i>
						</li>
						<li>Sản Phẩm</li>
					</ul>
				</div>
			</div>
		</div>
		<!--//banner -->
		<!--/shop-->
		<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
			<div class="container-fluid">
				<div class="inner-sec-shop px-lg-4 px-3">
					<h4 class="tittle-w3layouts my-lg-4 mt-3">CÁC SẢN PHẨM SÁCH </h4>
					<div class="row">
						<!-- product left -->
						<div class="side-bar col-lg-3">
							<div class="search-hotel">
								<h3 class="agileits-sear-head">Tìm kiếm</h3>
								<form action="{{route('user.shop', $id)}}" method="GET">
                                <input class="form-control" type="search" name="search" placeholder="Tìm kiếm" required="">
                                <button class="btn1" style="padding: 15px;">
                                        <i class="fas fa-search"></i>
                                </button>
                                <div class="clearfix"> </div>
                        		</form>
							</div>
							<!-- price range -->
							<div class="range">
								<h3 class="agileits-sear-head">Khoảng giá</h3>
								<ul class="dropdown-menu6">
									<li>
										<a class="{{ Request::get('price') == 1 ? 'price-active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 1])}}" style="border:solid 1px; padding:5px">0 - 100000 VNĐ</a> 
									</li>
									<li  style="padding-top:20px"> 
										<a class="{{ Request::get('price') == 2 ? 'price-active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 2])}}" style="border:solid 1px; padding:5px">100000 - 200000 VNĐ</a>
									</li>
									<li style="padding-top:20px">
										<a class="{{ Request::get('price') == 3 ? 'price-active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 3])}}" style="border:solid 1px; padding:5px">200000 - 300000 VNĐ</a> 
									</li>
									<li  style="padding-top:20px">	
										<a class="{{ Request::get('price') == 4 ? 'price-active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 4])}}" style="border:solid 1px; padding:5px">Trên 300000 VNĐ</a>
									</li>
									<li style="padding-top:20px">
										<a class="{{ Request::get('price') == 0 ? 'price-active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 0])}}" style="border:solid 1px; padding:5px">Tất cả</a> 
									</li>
								</ul>
							</div>
							<!-- //price range -->
							<!--preference -->
							<div class="range" style="margin-top:15px">
								<h3 class="agileits-sear-head">Sắp xếp theo</h3>
								<form method="GET" id="form-order"> 
								<select name="orderby" class="orderby" style="padding:5px; width:150px" onchange="onChanged()">
									<option value="def" {{ Request::get('orderby') == 'def' || '' ? 'selected' : '' }}> Mặc định </option>
									<option value="new" {{ Request::get('orderby') == 'new' ? 'selected' : '' }}> Mới nhất </option>
									<option value="old" {{ Request::get('orderby') == 'old' ? 'selected' : '' }}> Cũ nhất </option>
									<option value="asc" {{ Request::get('orderby') == 'asc' ? 'selected' : '' }}> Giá tăng dần </option>
									<option value="des" {{ Request::get('orderby') == 'des' ? 'selected' : '' }}> Giá giảm dần </option>
								</select>
								</form>
							</div>
							<!-- // preference -->
						</div>
						<!-- //product left -->
						<!--/product right-->
						<div class="left-ads-display col-lg-9">
							<div class="wrapper_top_shop">
								<div class="row">
										<div class="col-md-6 shop_left">
												<img src="{!! asset('user\images\banner-sach-kinh-te.png') !!}" alt="">
												
										</div>
										<div class="col-md-6 shop_right">
												<img src="{!! asset('user\images\banner-sach-kinh-te.png') !!}" alt="">
									
											</div>
						
								</div>
								
								<div class="row">
									<!-- /womens -->
									@foreach($show_book as $books)
									<div class="col-md-3 product-men women_two shop-gd">
										<div class="product-googles-info googles">
											<div class="men-pro-item">
												<div class="men-thumb-item">
													<img src="{!! asset($books->Anh_Bia) !!}" class="img-fluid anh-bia" alt="">
													<div class="men-cart-pro">
														<div class="inner-men-cart-pro">
															<a href="{{ route('user.single',$books->Id)}}" class="link-product-add-cart">Xem ngay</a>
														</div>
													</div>
													<span class="product-new-top">Mới</span>
												</div>
												<div class="item-info-product">
													<div class="info-product-price">
														<div class="grid_meta" style="padding-top: 15px;">
															<div class="product_price">
																<h4 class= "hidden"> 
																	<a class="ten-sach" href="{{ route('user.single',$books->Id)}}">{{$books->Ten_Sach}}</a>
																</h4>
																@if($books->Gia_Khuyen_Mai != 0)
																<div class="grid-price mt-2">
																	<span class="money gia-tien">{{number_format($books->Gia_Khuyen_Mai)}} VNĐ <br><i style="color:gray; font-size:60%; text-decoration-line:line-through;"> {{number_format($books->Gia_Tien).' '. 'VNĐ'}} </i></span>
																</div>
																
																@else
																
																<div class="grid-price mt-2">
																	<span class="money gia-tien">{{number_format($books->Gia_Tien).' '. 'VNĐ'}}</span>
																	
																</div>
																
																@endif
																
															</div>
														</div>
														@if (Cookie::get('UserId') != null)
														<div class="googles single-item hvr-outline-out">
														<form action="" method="POST">
															{{csrf_field()}}
															<button type="button" class="googles-cart pgoogles-cart" onclick="AddCart({{ $books->Id }})">
																<i class="fas fa-cart-plus"></i>
															</button>								
														</form>
														</div>
														<div class="googles single-item hvr-outline-out" style="">
															<form>
															{{ csrf_field() }}
																<button type="button" class="googles-heart" onclick="Favorite({{ $books->Id }})">
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
								</div>
								<br>
								{{ $show_book->links() }}
								
						
								
						</div>
						<!--//product right-->
					</div>
			</div>
		</section>
		@stop
<script>
	window.onload = function(){
	var element = document.getElementById("nav-cuahang");
	element.classList.add("active");

		var x = localStorage.getItem("mytime");
        var y = localStorage.getItem("myurl");
        var n = localStorage.getItem("mycate");
        var z = location.href;
        var attrs = z.substr(z.indexOf("page"), 6);
        if(y != null){
            if(y.search("page") === -1 && y.search("price") === -1 && y.search("orderby") === -1 && y.search("category") === -1)
            {

            }
            else if(y.search("page") === -1){
                var url = y + '&' + attrs;
                window.location.href = url;
            }
            else{
                var attrurl = y.substr(y.indexOf("page"), 6);
                var newurl = y.replace(attrurl, attrs);
                window.location.href = newurl;
            }
            localStorage.removeItem("myurl");
        }

        var attrr = z.substr(z.indexOf("orderby"), 11);
        if(x != null){
            if(x.search("page") === -1 && x.search("price") === -1 && x.search("orderby") === -1 && x.search("category") === -1)
            {

            }
            else if(x.search("orderby") === -1){
                var url1 = x + '&' + attrr;
                window.location.href = url1;
            }
            else{
                var attrurl1 = x.substr(x.indexOf("orderby"), 11);
                var newurl1 = x.replace(attrurl1, attrr);
                window.location.href = newurl1;
            }
            localStorage.removeItem("mytime");
        }

        var attrrs = z.substr(z.indexOf("category"), 11);
        if(n != null){
            if(n.search("page") === -1 && n.search("price") === -1 && n.search("orderby") === -1 && n.search("category") === -1)
            {

            }
            else if(n.search("category") === -1){
                var url2 = n + '&' + attrrs;
                window.location.href = url2;
            }
            else{
                var attrurl2 = n.substr(n.indexOf("category"), 11);
                var newurl2 = n.replace(attrurl2, attrrs);
                window.location.href = newurl2;
            }
            localStorage.removeItem("mycate");
        }

		var p = localStorage.getItem("mysearchshop");
		var vt = z.indexOf("search");
		if (vt != -1)
		{
			var searchString = z.slice(vt);
			localStorage.mysearch = searchString;
		}
		if (z.search("page") != -1){
			if (p != null){		
				p = localStorage.getItem("mysearchshop");
				var nowurl = z + "&" + p;										
				window.location.href = nowurl;	
				localStorage.removeItem("mysearchshop");				
			}
		}
    }
    function onChanged(){
        $('#form-order').submit();
        localStorage.mytime = location.href;
    }
</script>
		
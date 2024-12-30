@extends('user.layout')
	@section('content')
	<style>
		div.vertical-line{
      width: 0px; /* Use only border style */
      height: 100%;
      float: left; 
      border: 1px inset; /* This is default border style for <hr> tag */
    }
	</style>
		<!-- banner -->
		<div class="banner_inner">
			<div class="services-breadcrumb">
				<div class="inner_breadcrumb">

					<ul class="short">
						<li>
							<a href="{{route('user.index')}}">Trang chủ</a>
							<i>|</i>
						</li>
						<li>Chi tiết sản phẩm</li>
					</ul>
				</div>
			</div>

		</div>
		
	</div>
		<!--//banner -->
		<!--/shop-->
		<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
			<div class="container">
				<div class="inner-sec-shop pt-lg-4 pt-3">
					<div class="row">
							<div class="col-lg-4 single-right-left ">
									<div class="grid images_3_of_2">
										<div class="flexslider1">
					
											<ul class="slides">
												<li data-thumb="{{$Anh_Bia}}">
													<div class="thumb-image"> <img src="{{$Anh_Bia}}" data-imagezoom="true" class="img-fluid" alt=" "> </div>
												</li>
												@foreach ($anh_sach as $image)
												<li data-thumb="{{$image->Anh_Sach}}">
													<div class="thumb-image"> <img src="{{$image->Anh_Sach}}" data-imagezoom="true" class="img-fluid" alt=" "> </div>
												</li>
												@endforeach
											</ul>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-8 single-right-left simpleCart_shelfItem">
									@foreach ($thong_tin_sach as $bk)
									<h3>{{$bk->Ten_Sach}} </h3>
									<br>
									<div class="row">
  										<div class="col-6">
										  <span>Tác giả:</span>
										  <span>{{$bk->Tac_Gia}}</span>
										</div>
										<div class="col-6">
										  <span>Thể loại:</span>
										  <span>{{$bk->TheLoai->The_Loai}}</span>
										</div>
									</div>
									<div class="row">
  										<div class="col-6">
										  <span>Nhà xuất bản: </span>
										  <span>{{$bk->NhaXuatBan->Ten_NXB}}</span>
										  </div>
  										<div class="col-6">
										  <span>Hình thức bìa:</span>
										  <span>
										  @if($bk->Loai_Bia == 0) {{"Bìa cứng"}}
										  @elseif (($bk->Loai_Bia == 1)) {{"Massmarket Paperback"}}
										  @else {{"Bìa mềm"}}
										  @endif
										  </span>
										</div>
									</div>
									@if($bk->Gia_Khuyen_Mai != 0)
									<p>
										<span class="item_price">{{number_format($bk->Gia_Khuyen_Mai)}} VNĐ</span>
										<del>{{number_format($bk->Gia_Tien)}} VNĐ</del>
									</p>
									@else
									<p>
										<span class="item_price">{{number_format($bk->Gia_Tien)}} VNĐ</span>
									</p>
									@endif
									<br>
									
  										<div class="row">
    									<div class="col-sm-3">
											<span>Thời gian giao hàng</span>
    									</div>
    									<div class="col-sm-9">
											<span>Địa điểm giao hàng </span>
											<a href="#"> Thay đổi</a>
							
    									</div>
  										</div>
										  <div class="row">
    									<div class="col-sm-3">
											<span>Chính sách đổi trả </span>
    									</div>
    									<div class="col-sm-9">
											<span>Đổi trả sản phẩm trong 30 ngày </span>
											<a href="#"> Xem thêm</a>
							
    									</div>
  										</div>
									<br>
									@if($bk->So_Luong > 0)
									@if(Cookie::get('UserId') != null)
									<form action="{{ route('account.payment') }}" method="POST">
									{{csrf_field()}}
										<label class="control-label">Số Lượng: </label>
										<div class="form-group quantity-box" style="display: inline-flex;align-items: baseline;justify-content: space-evenly;">                                
											<input class="form-control col-sm-3" id="So_Luong_SP" name="So_Luong" value="1" min="1" max="{{$bk->So_Luong}}" type="number" style="width:150px"> (Còn {{$bk->So_Luong}} sản phẩm)
											<input type="hidden" name="Id" value="{{ $bk->Id }}"/>
										</div>
										<br>
							
										<div class="occasion-cart" style="display: inline-flex; padding-top:15px">
											<div class="googles single-item singlepage">
												<button type="submit" class="link-product-add-cart">
													Mua ngay
												</button>														
											</div>
											<div class="vertical-line" style="height: 40px; margin-left:10px"></div>
											<div class="googles single-item singlepage" style="margin-left:10px">
												<button type="button" onclick="AddCart({{ $bk->Id }})" class="link-product-add-cart">
													Thêm giỏ hàng
												</button>														
											</div>
										</div>
									</form>
									@else
									<label class="control-label">Số Lượng: </label>
										<div class="form-group quantity-box" style="display: inline-flex;align-items: baseline;justify-content: space-evenly;">                                
											<input class="form-control col-sm-3" id="So_Luong_SP" name="So_Luong" value="1" min="1" max="{{$bk->So_Luong}}" type="number" style="width:150px"> (Còn {{$bk->So_Luong}} sản phẩm)
											<input type="hidden" name="Id" value="{{ $bk->Id }}"/>
										</div>
										<br>
							
										<div class="occasion-cart" style="display: inline-flex; padding-top:15px">
											<div class="googles single-item singlepage">
												<button type="button" onclick="returnLogin()" class="link-product-add-cart">
													Mua ngay
												</button>														
											</div>
											<div class="vertical-line" style="height: 40px; margin-left:10px"></div>
											<div class="googles single-item singlepage" style="margin-left:10px">
												<button type="button" onclick="returnLogin()" class="link-product-add-cart">
													Thêm giỏ hàng
												</button>														
											</div>
										</div>
									@endif
									@else
										<h4 style="color:gray">(Hết hàng)</h4>
									@endif
									@endforeach
								</div>
								<div class="clearfix"> </div>
								<!--/tabs-->
								
						

								
								<div class="responsive_tabs">
								<h4>THÔNG TIN CHI TIẾT</h4>
								<br>
								<table class="thong-tin">
								@foreach ($thong_tin_sach as $book)
								<tbody>
									<tr>
										<td>Thể loại</td>
										<td>{{$book->TheLoai->The_Loai}}</td>
									</tr>
									<tr>
										<td>Dịch Giả</td>
										<td>{{$book->Tac_Gia}}</td>
									</tr>
									<tr>
										<td>Số trang</td>
										<td>{{$book->So_Trang}}</td>
									</tr>
									<tr>
										<td>SKU</td>
										<td>{{$book->SKU}}</td>
									</tr>
									<tr>
										<td>Nhà xuất bản</td>
										<td>{{$book->NhaXuatBan->Ten_NXB}}</td>
									</tr>
								</tbody>
								@endforeach
								</table>
								<br>
									<div id="horizontalTab">
										<ul class="resp-tabs-list">
											
											<li>KHÁCH HÀNG NHẬN XÉT</li>
											<li class="active">MÔ TẢ SẢN PHẨM</li>
										</ul>
										<div class="resp-tabs-container">
										<!--//tab_one-->
										<div class="tab1">
											
											<div class="single_page">
												<div class="bootstrap-tab-text-grids" style="width:1100px">
												@foreach($comments as $com)
													<div class="row">
														<div class="col-md-2">
															
															<img src="{!! asset($com->TaiKhoan->Anh_Dai_Dien)!!}" class="img-fluid" style="width:100px; height:100px; object-fit:cover">
														</div>
														<div class="col-md-10">
															<p style="color:green">@ {{$com->TaiKhoan->Ho_Ten}} </p>
															<p>{{date("d-m-Y H:i:s", strtotime($com->Thoi_Gian))}}</p>
															<p>{{$com->Noi_Dung}}
															</p>
														</div>
													</div>
													<hr>
													@endforeach
													
													@if(Cookie::get('UserId') != null)
													
													<div class="add-review">
														<h4>Thêm nhận xét</h4>
														
														<form method="POST">
														{{ csrf_field() }}
														
															<!-- <input class="form-control" type="text" name="TenND" placeholder="Vui lòng nhập tên..." > -->
														
															<textarea name="Noi_Dung" placeholder="Nhập nội dung bình luận..." ></textarea>
															<input type="text" name="Trang_Thai" hidden class="form-control" 
																value="1">
													
															<input type="submit" id="submit" value="Gửi">
														</form>
														
													</div>
													@else
													<a href="/dang-nhap" class="btn hvr-hover">Vui lòng đăng nhập để bình luận</a>
														@endif
												</div>
				
											</div>
										
										</div>
							<!--/tab_two-->
							<div class="tab2">
					
										<div class="single_page" style="width:1100px">
										<h5>MÔ TẢ SẢN PHẨM</h5>
										<p>{{$Mo_Ta}}
										</p>
											
									</div>
							</div>
									</div>
								</div>
							</div>

							<!--//tabs-->														
					</div>
				</div>
			</div>
				<div class="container-fluid">
					<!--/slide-->
					<div class="slider-img mid-sec mt-lg-5 mt-2 px-lg-5 px-3">
						<!--//banner-sec-->
						<h4 class="tittle-w3layouts text-center my-lg-4 my-3">SẢN PHẨM LIÊN QUAN</h4>
						<div class="mid-slider">
							<div class="owl-carousel owl-theme row">
								@foreach($sach_tuong_tu as $tuong_tu)
								<div class="item">
									<div class="gd-box-info text-center">
										<div class="product-men women_two bot-gd">
											<div class="product-googles-info slide-img googles">
												<div class="men-pro-item">
													<div class="men-thumb-item">
														<img src="{!! asset($tuong_tu->Anh_Bia)!!}" class="img-fluid" alt="">
														<div class="men-cart-pro">
															<div class="inner-men-cart-pro">
																<a href="{{ route('user.single', $tuong_tu->Id)}}" class="link-product-add-cart">Xem Ngay</a>
															</div>
														</div>
												
													</div>
													<div class="item-info-product">

														<div class="info-product-price">
															<div class="grid_meta" style="padding-top: 25px;">
																<div class="product_price">
																	<h4 class="hidden">
																		<a href="{{ route('user.single',$tuong_tu->Id)}}">{{$tuong_tu->Ten_Sach}} </a>
																	</h4>
																	@if($tuong_tu->Gia_Khuyen_Mai != 0)
																	<div class="grid-price mt-2">
																		<span class="money gia-tien">{{number_format($tuong_tu->Gia_Khuyen_Mai)}} VNĐ <i style="color:gray; font-size:70%; text-decoration-line:line-through;"> {{number_format($tuong_tu->Gia_Tien).' '. 'VNĐ'}} </i></span>
																	</div>
																	@else
																	<div class="grid-price mt-2">
																		<span class="money gia-tien">{{number_format($tuong_tu->Gia_Tien).' '. 'VNĐ'}}</span>
																	</div>
																	@endif
																	</div>
															</div>
															@if (Cookie::get('UserId') != null)
															<div class="googles single-item hvr-outline-out">
															<form action="" method="POST">
																{{csrf_field()}}
																<button type="button" class="googles-cart pgoogles-cart" onclick="AddCart({{ $tuong_tu->Id }})" style="padding-top: 15px;">
																	<i class="fas fa-cart-plus"></i>
																</button>								
															</form>
															</div>
															<div class="googles single-item hvr-outline-out" style="margin-top:-15px">
																<form>
																{{ csrf_field() }}
																	<button type="button" class="googles-heart" onclick="Favorite({{ $tuong_tu->Id }})">
																		<i class="fas fa-heart"></i>
																	</button>	
																</form>
															</div>
															@endif
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<!--//slider-->
				</div>
		</section>
		@stop
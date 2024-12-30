@extends('user.layout')
@section('content')
<style>
.without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
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
                <li>Tin tức</li>
            </ul>
        </div>
    </div>
</div>
<!--//banner -->
	<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
		<div class="container-fluid" >
			<div class="inner-sec-shop px-lg-4 px-3" style="background-color: #ffffff;">
				<h2 class="tittle-w3layouts my-lg-4 my-4"></h2>
				<div class="row">
					@foreach ($tin_tuc as $news)
					<div class="col-md-4" style="padding: 0 50px 30px 50px">
						<div class="product-googles-info googles" style="height:400px">
							<div class="men-pro-item" >
								<!-- Hình ảnh -->
								<div class="men-thumb-item" >
									<a href="{{ route('user.newsdetail', [$news->Id]) }}" target="_blank">
									<img  style=" width: fit-content;height:200px;object-fit: contain" src="admin/{!! $news->Hinh_Anh !!}" class="img-fluid" alt="" >
									</a>
									@if ($news->Chu_De == 0)
									<span class="product-new-top" style="background-color: green;">Hoạt động</span>
									@elseif ($news->Chu_De == 1)
									<span class="product-new-top" style="background-color: blue;">Sự kiện</span>
									@else
									<span class="product-new-top" style="background-color: #FFC107;">Khuyến mãi</span>
									@endif
								</div>
								<div class="item-info-product">
									<div class="info-product-price">
										<div class="grid_meta" style="padding-left:20px; height:100px">
											<div class="">
												<h6 style="padding-top:20px; color: #959596;">
													<a href="{{ route('user.newsdetail', [$news->Id]) }}" target="_blank">{{ $news->Tieu_De }}</a>
												</h6>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>					
					</div>
					@endforeach
				</div>
				<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4" style="padding-left:100px">{{ $tin_tuc->links() }} <br></div>
				<div class="col-md-4"></div>
				</div>
			</div>					
		</div>		
	</section>
	<script>
	window.onload = function(){
	var element = document.getElementById("nav-news");
	element.classList.add("active");
	}
	</script>
	<!-- about -->
@stop
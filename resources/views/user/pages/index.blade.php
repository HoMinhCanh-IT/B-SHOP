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
            -ms-appearance: none;
            appearance: none;
            margin: -10px;
        }
    </style>
    <!-- Slider Banner trang web -->
    <div class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active" style="background-image: url(user/images/banner.jpg);">
                    <div class="carousel-caption text-center">
                        <h3>Ưu Đãi Lớn
                            <span>Giảm Giá 50% Tất Cả Các Loại Sách</span>
                        </h3>
                        <a href="{{ route('user.shop', 0) }}" class="btn btn-sm animated-button gibson-three mt-4">Đến Cửa
                            Hàng</a>
                    </div>
                </div>
                <div class="carousel-item item2" style="background-image: url(user/images/banner-4.jpg);">
                    <div class="carousel-caption text-center">
                        <h3>Với B-SHOP
                            <span>Kiến Thức Là Vô Tận</span>
                        </h3>
                        <a href="{{ route('user.shop', 0) }}" class="btn btn-sm animated-button gibson-three mt-4">Đến Cửa
                            Hàng</a>

                    </div>
                </div>
                <div class="carousel-item item3" style="background-image: url(user/images/banner-5.jpg);">
                    <div class="carousel-caption text-center">
                        <h3>Đến Với B-SHOP
                            <span>Chúng Tôi Sẽ Cho Bạn Dịch Vụ Tốt Nhất</span>
                        </h3>
                        <a href="{{ route('user.shop', 0) }}" class="btn btn-sm animated-button gibson-three mt-4">Đến Cửa
                            Hàng</a>

                    </div>
                </div>
                <div class="carousel-item item4" style="background-image: url(user/images/banner-9.jpg);">
                    <div class="carousel-caption text-center">
                        <h3>Đồng Hành Cùng B-SHOP
                            <span>Trở Lại Trường Sau Mùa Hè</span>
                        </h3>
                        <a href="{{ route('user.shop', 0) }}" class="btn btn-sm animated-button gibson-three mt-4">Đến Cửa
                            Hàng</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--//banner -->
    </div>
    </div>
    <!--//banner-sec-->
    <section class="banner-bottom-wthreelayouts py-lg-5 py-3">
        <div class="container-fluid">
            <div class="inner-sec-shop px-lg-4 px-3">
                <h3 class="tittle-w3layouts my-lg-4 my-4">Sách Mới Cho Bạn </h3>
                <div class="row">
                    <!-- Sách mới -->
                    @foreach ($sach_moi as $newbook)
                        <div class="col-md-3">
                            <div class="product-googles-info googles">
                                <div class="men-pro-item">
                                    <!-- Hình ảnh -->
                                    <div class="men-thumb-item">
                                        <img src="{!! $newbook->Anh_Bia !!}" class="img-fluid" alt="">
                                        <div class="men-cart-pro">
                                            <div class="inner-men-cart-pro">
                                                <a href="{{ route('user.single', $newbook->Id) }}"
                                                    class="link-product-add-cart">Xem ngay</a>
                                            </div>
                                        </div>
                                        <span class="product-new-top" style="background-color: green;">Mới</span>
                                    </div>
                                    <div class="item-info-product">
                                        <div class="info-product-price">
                                            <!-- Tên và giá tiền -->
                                            <div class="grid_meta" style="padding-left:20px">
                                                <div class="product_price">
                                                    <h4
                                                        style="padding-top:20px; color: #959596; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                        <a
                                                            href="{{ route('user.single', $newbook->Id) }}">{{ $newbook->Ten_Sach }}</a>
                                                    </h4>
                                                    @if ($newbook->Gia_Khuyen_Mai == 0)
                                                        <div class="grid-price mt-2">
                                                            <span class="money ">{{ number_format($newbook->Gia_Tien) }}
                                                                VNĐ</span>
                                                        </div>
                                                    @else
                                                        <div class="grid-price mt-2">
                                                            <span
                                                                class="money">{{ number_format($newbook->Gia_Khuyen_Mai) }}
                                                                VNĐ</span> &nbsp; <i
                                                                style="color:gray; font-size:80%; text-decoration-line:line-through;">
                                                                {{ number_format($newbook->Gia_Tien) . ' ' . 'VNĐ' }}
                                                            </i></span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Thêm vào giỏ hàng -->
                                            @if (Cookie::get('UserId') != null)
                                                <div class="googles single-item hvr-outline-out">
                                                    <form action="" method="POST">
                                                        {{ csrf_field() }}
                                                        <button type="button" class="googles-cart pgoogles-cart"
                                                            onclick="AddCart({{ $newbook->Id }})"
                                                            style="padding-top: 15px;">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="googles single-item hvr-outline-out" style="margin-top:-15px">
                                                    <form>
                                                        {{ csrf_field() }}
                                                        <button type="button" class="googles-heart"
                                                            onclick="Favorite({{ $newbook->Id }})">
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
            </div>
            <!--//Sách mới-->
            <!--/Banner middle trang web-->
            <div class="inner-sec-shop px-lg-4 px-3" style="padding-top:30px;">
                <div class="col-lg-12"
                    style="background-image: url(user/images/banner-sach-kinh-te.png); height: 420px; width:100%; object-fit: cover">
                </div>
                {{-- <div class="col-lg-12">
                    <iframe width="100%" height="550" src="https://www.youtube.com/watch?v=wktBd7OmYHs"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div> --}}
            </div>
            <!--//Banner trang web-->
            <div class="inner-sec-shop px-lg-4 px-3">
                <h3 class="tittle-w3layouts my-lg-4 my-4">Sách Bán Chạy Nhất </h3>
                <div class="row">
                    <!-- Sách bán chạy -->
                    @foreach ($sach_ban_chay as $hotbook)
                        <div class="col-md-3">
                            <div class="product-googles-info googles">
                                <div class="men-pro-item">
                                    <!-- Hình ảnh -->
                                    <div class="men-thumb-item">
                                        <img src="{!! $hotbook->Anh_Bia !!}" class="img-fluid" alt="">
                                        <div class="men-cart-pro">
                                            <div class="inner-men-cart-pro">
                                                <a href="{{ route('user.single', $hotbook->Id) }}"
                                                    class="link-product-add-cart">Xem Ngay</a>
                                            </div>
                                        </div>
                                        <span class="product-new-top" style="background-color: red;">Bán chạy</span>
                                    </div>
                                    <div class="item-info-product">
                                        <div class="info-product-price">
                                            <!-- Tên và giá tiền -->
                                            <div class="grid_meta" style="padding-left:20px">
                                                <div class="product_price">
                                                    <h4
                                                        style="padding-top:20px; color: #959596; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                        <a
                                                            href="{{ route('user.single', $hotbook->Id) }}">{{ $hotbook->Ten_Sach }}</a>
                                                    </h4>
                                                    @if ($hotbook->Gia_Khuyen_Mai == 0)
                                                        <div class="grid-price mt-2">
                                                            <span class="money ">{{ number_format($hotbook->Gia_Tien) }}
                                                                VNĐ</span>
                                                        </div>
                                                    @else
                                                        <div class="grid-price mt-2">
                                                            <span
                                                                class="money">{{ number_format($hotbook->Gia_Khuyen_Mai) }}
                                                                VNĐ</span> &nbsp; <i
                                                                style="color:gray; font-size:80%; text-decoration-line:line-through;">
                                                                {{ number_format($hotbook->Gia_Tien) . ' ' . 'VNĐ' }}
                                                            </i></span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Thêm vào giỏ hàng -->
                                            @if (Cookie::get('UserId') != null)
                                                <div class="googles single-item hvr-outline-out">
                                                    <form action="" method="POST">
                                                        {{ csrf_field() }}
                                                        <button type="button" class="googles-cart pgoogles-cart"
                                                            onclick="AddCart({{ $hotbook->Id }})"
                                                            style="padding-top: 15px;">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="googles single-item hvr-outline-out" style="margin-top:-15px">
                                                    <form>
                                                        {{ csrf_field() }}
                                                        <button type="button" class="googles-heart"
                                                            onclick="Favorite({{ $hotbook->Id }})">
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
            </div>
            <div class="inner-sec-shop px-lg-4 px-3" style="padding-top:30px;">
                <div class="col-lg-12"
                    style="background-image: url(user/images/banner_tin_tuc.jpg); height: 420px; width:100%; object-fit: cover">
                </div>
            </div>
            <div class="inner-sec-shop px-lg-4 px-3">
                <h3 class="tittle-w3layouts my-lg-4 my-4">Tin Tức </h3>
                <div class="row">
                    @foreach ($tin_tuc as $news)
                        <div class="col-md-4" style="padding: 0 50px 30px 50px;">
                            <div class="product-googles-info googles" style="">
                                <div class="men-pro-item">
                                    <!-- Hình ảnh -->
                                    <div class="men-thumb-item">
                                        <a href="{{ route('user.newsdetail', [$news->Id]) }}" target="_blank">
                                            <img style=" width: fit-content;height:200px;object-fit: contain"
                                                src="admin/{!! $news->Hinh_Anh !!}" class="img-fluid" alt="">
                                        </a>
                                        @if ($news->Chu_De == 0)
                                            <span class="product-new-top" style="background-color: green;">Hoạt
                                                động</span>
                                        @elseif ($news->Chu_De == 1)
                                            <span class="product-new-top" style="background-color: blue;">Sự kiện</span>
                                        @else
                                            <span class="product-new-top" style="background-color: #FFC107;">Khuyến
                                                mãi</span>
                                        @endif
                                    </div>
                                    <div class="item-info-product">
                                        <div class="info-product-price">
                                            <div class="grid_meta" style="padding-left:20px; height:100px">
                                                <div class="">
                                                    <h6 style="padding-top:20px; color: #959596;">
                                                        <a href="{{ route('user.newsdetail', [$news->Id]) }}"
                                                            target="_blank">{{ $news->Tieu_De }}</a>
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
            </div>
        </div>
    </section>
    <script>
        window.onload = function() {
            var element = document.getElementById("nav-home");
            element.classList.add("active");

            $(".miniview-btn").click();
        }
    </script>
    <!-- about -->
@stop

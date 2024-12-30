
<div class="row">
    <!-- /womens -->
    @if($book->count() > 1)
    @foreach($book as $books)
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
                    <span class="product-new-top" style="background: #F60B0E;">@if ($books->Gia_Khuyen_Mai != 0) - {{(1 - ($books->Gia_Khuyen_Mai / $books->Gia_Tien))*100}}%  @endif</span>
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
    @else
    @foreach($book as $books)
    <div class="col-md-3 product-men women_two shop-gd" style="max-width:100%">
        <div class="product-googles-info googles" style="width: 280px;">
            <div class="men-pro-item">
                <div class="men-thumb-item">
                    <img src="{!! asset($books->Anh_Bia) !!}" class="img-fluid anh-bia" alt="">
                    <div class="men-cart-pro">
                        <div class="inner-men-cart-pro">
                            <a href="{{ route('user.single',$books->Id)}}" class="link-product-add-cart">Xem ngay</a>
                        </div>
                    </div>
                    <span class="product-new-top" style="background: #F60B0E;">@if($books->Gia_Khuyen_Mai != 0)- {{(1 - ($books->Gia_Khuyen_Mai / $books->Gia_Tien))*100}}% @endif</span>
                </div>
                <div class="item-info-product">
                    <div class="info-product-price">
                        <div class="grid_meta" style="padding-top: 10px;">
                            <div class="product_price">
                                <h4 class= "hidden"> 
                                    <a class="ten-sach" href="{{ route('user.single',$books->Id)}}">{{$books->Ten_Sach}}</a>
                                </h4>
                                <div class="grid-price mt-2">
                                    <span class="money gia-tien">{{number_format($books->Gia_Khuyen_Mai)}} VNĐ <i style="color:gray; font-size:70%; text-decoration-line:line-through;"> {{number_format($books->Gia_Tien).' '. 'VNĐ'}} </i></span>
                                </div>
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
                        <div class="googles single-item hvr-outline-out" style="margin-top:-15px">
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
    @endif
</div>

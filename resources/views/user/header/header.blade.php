<style>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 85%;
        bottom: 70px;
        font-size: 17px;
    }

    .count {
        border-radius: 100%;
        border: 2px solid red;
        background-color: red;
        color: white;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    #addcart {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #26d326;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 85%;
        bottom: 70px;
        font-size: 17px;
    }

    #addcart.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 70px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 70px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 70px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 70px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

    .setting-sidebar {
        position: fixed;
        top: 239px;
        transform: translateY(-50%);
        background-color: #fff;
        width: 40px;
        height: 40px;
        right: 0px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        box-shadow: 0px 0px 5px 0px rgb(154 154 154 / 54%);
        transition: all 0.5s ease;
        z-index: 9;
    }

    .d-lg-block {
        display: block !important;
        background: #cdc9d8;
    }

    .fa-eye {
        padding: 12px 10px;
        color: black;
        cursor: pointer;
    }

    .fa-eye:hover {
        color: #ff4e00;
    }

    .miniview-inner .miniview-inner-content {
        position: fixed;
        top: 369px;
        transform: translateY(-50%);
        background-color: #fff;
        width: 250px;
        height: 300px;
        right: 0px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        box-shadow: 0px 0px 5px 0px rgb(154 154 154 / 54%);
        transition: all 0.5s ease;
        z-index: 9;
        opacity: 0;
        visibility: hidden;
    }

    .miniview-inner-content.show {
        opacity: 1;
        visibility: visible;
    }

    .miniview-content-box {
        overflow: auto;
        height: 97%;
    }

    .fa-times {
        font-size: 20px;
        display: block;
        padding-top: 10px;
        color: black;
        cursor: pointer;
    }

    .fa-times:hover {
        color: #ff4e00;
    }

    .miniview-inner .miniview-close {
        width: 40px;
        height: 40px;
        text-align: center;
        background-color: #cdc9d8;
        color: #fff;
        font-size: 40px;
        cursor: pointer;
        top: 0;
        right: 250px;
        position: absolute;
        border-radius: 10%;
    }
</style>
<div class="banner-top container-fluid" id="home">
    <!-- header -->
    <header>
        <div class="row">
            <!-- LOGO của trang web -->
            <div class="col-md-3 top-info text-left mt-lg-4">
                <h6>B-SHOP</h6>
                <ul>
                    <li><a class="navbar-brand brand-logo-mini" href="/"><img src="{!! asset('admin/images/B-shop.png') !!}"
                                style="height: 70px; width: 90px" alt="logo" /></a></li>
                </ul>
            </div>
            <!-- BANNER của trang web -->
            <div class="col-md-6 logo-w3layouts top-info text-center">
                <h1 class="logo-w3layouts">
                    <a class="navbar-brand" href="#">
                        B-SHOP </a>
                </h1>
            </div>
            <!--Cá nhân -->
            <div class="col-md-3 text-right mt-lg-4">
                <ul class="cart-inner-info">
                    <!-- Đăng nhập -->
                    <li class="dropdown">
                        @if (Cookie::get('UserId') == null)
                            <span class="fa fa-user" aria-hidden="true" style="color: rgb(35, 175, 156);"></span><a
                                href="/dang-nhap" class="hover-nut"> Đăng Nhập </a>
                        @else
                            <span class="fa fa-user" aria-hidden="true" style="color: rgb(35, 175, 156);"><a
                                    class="hover-nut dropdown-toggle" href="#" data-toggle="dropdown"
                                    id="profileDropdown"> Tài Khoản </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="profileDropdown" style="margin-top:-2px; margin-left: -20px;">
                                    <a class="dropdown-item hover-nut" href="{{ route('user.account') }}"
                                        style="text-transform:none;font-size: 1rem;letter-spacing: 3px;color: #9c9b9b;cursor: pointer">
                                        <i class="fas fa-address-card" style="color: rgb(35, 175, 156);"></i>
                                        Thông tin
                                    </a>
                                    <a class="dropdown-item hover-nut" data-toggle="modal"
                                        data-target="#exampleEditPassCenter"
                                        style="text-transform:none;font-size: 1rem;letter-spacing: 3px;color: #9c9b9b;cursor: pointer">
                                        <i class="fas fa-key" style="color: rgb(35, 175, 156);"></i>
                                        Đổi mật khẩu
                                    </a>
                                    <a class="dropdown-item hover-nut" href="{{ route('logoutUser') }} "
                                        style="text-transform: none;font-size: 1rem;letter-spacing: 3px;color: #9c9b9b;cursor: pointer">
                                        <i class="fas fa-sign-out-alt" style="color: rgb(35, 175, 156);"></i>
                                        Đăng Xuất
                                    </a>
                                </div>
                        @endif
                    </li>
                    <!-- Giỏ hàng -->
                    <li>
                        <span class="fas fa-cart-plus" aria-hidden="true" style="color: rgb(35, 175, 156)"></span><a
                            href="{{ route('user.cart') }}" class="hover-nut"> Giỏ Hàng </a>
                        @if (Cookie::get('UserId') != null)
                            <span class="count"></span>
                        @endif
                        <!-- <form action="#" method="post" class="last">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="display" value="1">
        <button class="" type="submit" name="submit" value="">
         My Cart
         <i class="fas fa-cart-arrow-down"></i>
        </button>
       </form> -->
                    </li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleEditPassCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#ffa500a8;">
                        <h5 class="modal-title" id="exampleModalLongTitle"
                            style="color:white; font-size:120%; padding-left:170px">ĐỔI MẬT KHẨU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="" enctype="multipart/form-data" onsubmit="return CheckPass();">
                        @csrf
                        <div class="modal-body" style="margin-top:10px; padding-left:10px; padding-right:10px">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Mật khẩu cũ</label>
                                    <input type="password" class="form-control" name="Mat_Khau_Cu" id="Mat_Khau_Cu">
                                </div>
                                <div class="col-lg-12" style="margin-top:15px;">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" class="form-control" name="Mat_Khau" id="Mat_Khau">
                                </div>
                                <div class="col-lg-12" style="margin-top:15px; margin-bottom:15px;">
                                    <label>Xác thực mật khẩu</label>
                                    <input type="password" class="form-control" name="Xac_Thuc" id="Xac_Thuc">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color:#ffa50099">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fas fa-window-close"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- offview mini view start -->
        @if (Cookie::get('UserId') != null)
            <div class="setting-sidebar d-none d-lg-block">
                <a class="miniview-btn"><i class="fas fa-eye"></i></a>
            </div>
            <div class="offview-miniview-wrapper d-none d-lg-block">
                <div class="miniview-inner">
                    <div class="miniview-inner-content">
                        <div class="miniview-close">
                            <a class="miniview-btn-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="miniview-content-box">
                            <div class="sidebar-back text-center"
                                style="color: #828284; font-size: 16px; letter-spacing: 2px; font-weight:bold">Gợi ý
                                cho bạn</div>
                            <div class="container" id="goi-y">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- end miniview -->
        <script>
            function CheckPass() {
                var x = document.getElementById('Mat_Khau').value;
                var y = document.getElementById('Xac_Thuc').value;
                var z = document.getElementById('Mat_Khau_Cu').value;
                if (x != y) {
                    alert('Xác thực mật khẩu không khớp!');
                    return false;
                } else if (x.length < 6 || y.length < 6) {
                    alert('Mật khẩu phải từ 6 - 18 ký tự!');
                    return false;
                }
                $.ajax({
                    url: "{{ route('user.accountpass') }}",
                    type: 'POST',
                    data: {
                        Pass_Old: z,
                        Pass_New: x,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        alert(data);
                        return true;
                    }
                });
            }
        </script>
        <!-- End Modal -->

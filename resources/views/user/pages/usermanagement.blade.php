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
						<li>Quản lý tài khoản</li>
					</ul>
				</div>
			</div>

		</div>
		
	</div>
		<!--//banner -->
    <div class="container">
        <div class="row">
        <!--/tabs-->				
        <div class="responsive_tabs">
								<h4 style="text-align:center;color: #828284;">QUẢN LÝ TÀI KHOẢN</h4>
                                <hr width="100%">
								<br>
                                <div style="padding-bottom:10px; text-align:center">
                                <img src="/{{ $Anh_Dai_Dien }}" alt="" style="width:150px; height:150px; border-radius:50%; object-fit:cover">
                                </div>
                                <br>
                                <h6 style="font-weight:700; padding-bottom:10px">THÔNG TIN CÁ NHÂN</h6>
                                <table class="thong-tin" style="border-style:double">
								<tbody>
									<tr>
										<td>Họ và tên:</td>
										<td>{{ $Ho_Ten }}</td>
									</tr>
									<tr>
										<td>Giới tính:</td>
										<td>
                                        @if($Gioi_Tinh == 0) {{"Nam"}}
                                        @else {{"Nữ"}}
                                        @endif
                                        </td>
									</tr>
                                    <tr>
										<td>Ngày sinh:</td>
										<td>{{ date('d-m-Y', strtotime($Ngay_Sinh)) }}</td>
									</tr>
									<tr>
										<td>Số điện thoại:</td>
										<td>{{ $So_Dien_Thoai }}</td>
									</tr>
									<tr>
										<td>Địa chỉ:</td>
										<td>{{ $Dia_Chi }}</td>
									</tr>
                                    <tr>
                                        <td><button class="btn btn-success" style="font-size:90%" data-toggle="modal" data-target="#exampleEditModalCenter">CẬP NHẬT</button><td>
                                    </tr>
								</tbody>
								</table>
								<br>
									<div id="horizontalTab">
										<ul class="resp-tabs-list">
											
											<li>SÁCH YÊU THÍCH</li>
											<li>DANH SÁCH ĐƠN HÀNG</li>
										</ul>
										<div class="resp-tabs-container">
											<!--/tab_one-->
											<div class="tab1">
					
					<div class="single_page">
                    <table class="table table-bordered" id="favorite-book" style="width:1100px">
                    <thead>
                    <tr style="text-align:center">
                        <th>Tên sách</th>
                        <th>Ảnh bìa</th>
                        <th>Tác giả</th>
                        <th>Phiên bản</th>
                        <th>Giá tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sach_yeu_thich as $favoritebook)
                    <tr>
                        <td>{{$favoritebook->Sach->Ten_Sach}}</td>
                        <td><img src="{{$favoritebook->Sach->Anh_Bia}}" style="width:80px; height:80px; border-radius:0%"></td>
                        <td>{{$favoritebook->Sach->Tac_Gia}}</td>
                        <td>
                        @if($favoritebook->Sach->Phien_Ban == 0) {{"Bản thường"}}
                        @else {{"Bản đặc biệt"}}
                        @endif
                        </td>
                        <td>
                            @if($favoritebook->Sach->Gia_Khuyen_Mai == 0) {{number_format($favoritebook->Sach->Gia_Tien)}} VNĐ
                            @else {{number_format($favoritebook->Sach->Gia_Khuyen_Mai)}} VNĐ
                            @endif
                        </td>
                        <td>
                        @if($favoritebook->Sach->Trang_Thai == 0) {{"Ngừng bán"}}
                        @elseif (($favoritebook->Sach->Trang_Thai == 1)) {{"Tạm hết hàng"}}
                        @else {{"Còn hàng"}}
                        @endif
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="DeleteFavorite({{$favoritebook->Id}})">Xóa</button>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('user.single', $favoritebook->Id_Sach)}}">Xem chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>						
					</div>
				</div>
                <!--//tab_one-->
                <div class="tab2">
                    <div class="single_page">
                    <table class="table table-bordered" style="width:1100px; text-align:center">
                    <thead>
                    <tr style="text-align:center">
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Ngày lập</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($don_hang as $order)
                    <tr>
                        <td>{{ $order->Account->Ho_Ten }}</td>
                        <td>{{ $order->Dia_Chi_Giao_Hang }}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($order->Ngay_Lap))}}</td>
                        <td>{{ number_format($order->Tong_Tien) }} VNĐ</td>
                        <td>
                            @if($order->Trang_Thai == 0) {{"Chờ nhận đơn"}}
                            @elseif (($order->Trang_Thai == 1)) {{"Đã nhận đơn"}}
                            @elseif (($order->Trang_Thai == 2)) {{"Đang giao"}}
                            @elseif (($order->Trang_Thai == 3)) {{"Đã nhận hàng"}}
                            @else {{"Đã hủy"}}
                            @endif
                        </td>
                        @if ($order->Trang_Thai == 0 || $order->Trang_Thai == 1 || $order->Trang_Thai == 2)
                        <td><a href="{{ route('account.cancelorder', $order->Id)}}" class="btn btn-danger">Hủy đơn</a></td>
                        @endif
                        <td><a href="{{ route('account.orderdetail', $order->Id)}}" class="btn btn-primary">Xem chi tiết</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>			
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleEditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#ffa500a8;">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-size:120%; padding-left:130px">THÔNG TIN CÁ NHÂN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('user.updateinfomation', $Id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body" style="margin-top:10px; padding-left:10px; padding-right:10px">
          <div class="row">
              <div class="col-lg-12">
                <label for="exampleInputTopic">Ảnh đại diện</label>
                <div class="custom-file">
                    <input accept="image/*" title="" type="file" class="form-control" name="Anh_Dai_Dien" id="Anh_Dai_Dien" placeholder="Chọn ảnh" />
               </div>
              </div>
              <div class="col-lg-12" style="margin-top:20px">
                <label for="exampleInputTopic">Họ tên</label>
                <input type="text" class="form-control" value="{{$Ho_Ten}}" name="Ho_Ten">
              </div>
              <div class="col-lg-12" style="margin-top:20px">
                <label for="exampleInputTopic">Giới tính</label>
                @if($Gioi_Tinh == 0)
                <label class="radio-inline" style="padding-left:100px">
                    <input type="radio" id="Gioi_Tinh" value="0" name="Gioi_Tinh" checked> Nam
                </label>
                <label class="radio-inline" style="padding-left:30px">
                    <input type="radio" value="1" name="Gioi_Tinh" > Nữ
                </label>
                @else
                <label class="radio-inline" style="padding-left:100px">
                    <input type="radio" id="Gioi_Tinh" value="0" name="Gioi_Tinh"> Nam
                </label>
                <label class="radio-inline" style="padding-left:30px">
                    <input type="radio" value="1" name="Gioi_Tinh" checked> Nữ
                </label>
                @endif
              </div>
              <div class="col-lg-12" style="margin-top:20px">
                <label for="exampleInputTopic">Ngày sinh</label>
                <input type="date" class="form-control" value="{{$Ngay_Sinh}}" name="Ngay_Sinh" >
              </div>
              <div class="col-lg-12" style="margin-top:20px">
                <label for="exampleInputTopic">Số điện thoại</label>
                <input type="text" class="form-control" value="{{$So_Dien_Thoai}}" name="So_Dien_Thoai" >
              </div>
              <div class="col-lg-12" style="margin-top:20px; margin-bottom:10px">
                <label for="exampleInputTopic">Địa chỉ</label>
                <input type="text" class="form-control" value="{{$Dia_Chi}}" name="Dia_Chi" >
              </div>
          </div>
      </div>
      <div class="modal-footer" style="background-color:#ffa50099">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->
    <!--//tabs-->
        </div>
    </div>
    @stop
@extends('admin.layout')
@section('content')
<style>
    .row{
        padding-top:20px !important;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12" style="margin-left: 80px; padding-right:70px">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">THÊM TÀI KHOẢN</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li><a href="{{route('account.index')}}">Quản lý tài khoản</a></li>
                      <li>Thêm tài khoản</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- form start -->
            @if($errors->has('create'))
            <p class="login-box-msg">
              <strong class="text-danger" style="color:red">{{ $errors->first('create') }}</strong>
            </p>
            @endif
                <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return CheckInput();">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Email</label>
                    <input class="form-control" type="text" name="Email" id="Email" placeholder="Email">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Mật khẩu</label>
                    <input class="form-control" type="text" name="Mat_Khau" id="Mat_Khau" placeholder="Mật khẩu">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Ảnh đại diện</label>
                    <div class="custom-file">
                        <input accept="*.png|*.jpg|*.jpeg" type="file" name="Anh_Dai_Dien" class="form-control" id="Anh_Dai_Dien" placeholder="Chọn ảnh" name="hinh_anh" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Họ tên</label>
                    <input class="form-control" type="text" name="Ho_Ten" id="Ho_Ten" placeholder="Họ tên">
                  </div>
                </div> 
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Số điện thoại</label>
                    <input class="form-control" type="text" name="So_Dien_Thoai" id="So_Dien_Thoai" placeholder="Số điện thoại">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Giới tính</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Gioi_Tinh" class="form-control" id="Gioi_Tinh" placeholder="Title">
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Địa chỉ</label>
                    <input class="form-control" type="text" name="Dia_Chi" id="Dia_Chi" placeholder="Địa chỉ">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Ngày sinh</label>
                    <input class="form-control" type="date" name="Ngay_Sinh" id="Ngay_Sinh" placeholder="Ngày sinh">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Loại tài khoản</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Loai_TK" class="form-control" id="Loai_TK" placeholder="Title">
                        <option value="0">Admin</option>
                        <option value="1">Khách hàng</option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Trạng thái</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Trang_Thai" class="form-control" id="Trang_Thai" placeholder="Title">
                        <option value="0">Đang hoạt động</option>
                        <option value="1">Chưa kích hoạt</option>
                    </select>
                  </div>
                </div>
                <div class="row" style="float:right">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button> &nbsp;
                  <a class="btn btn-secondary" href="{{route('account.index')}}" style="margin-left: 15px;margin-right: 30px; color:white"><i class="fas fa-window-close"></i></a>
                </div>
              </form>
        </div>
    </div>
</div>
<script>
    function Active(){
      var element = document.getElementById("active_account");
      element.classList.add("active");
    }
    window.onload = Active();
    function CheckInput(){
      var Email = document.getElementById('Email').value;
      var Pass = document.getElementById('Mat_Khau').value;
      var Birth = document.getElementById('Ngay_Sinh').value;
      var Name = document.getElementById('Ho_Ten').value;
      var Phone = document.getElementById('So_Dien_Thoai').value;
      var Address = document.getElementById('Dia_Chi').value;
      var atposition = Email.indexOf("@");
      var dotposition = Email.lastIndexOf(".");
      var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
      var today = new Date();
      if(Email === "" || Pass === "" || Name === "" || Phone === "" || Address === "" || Birth === "")
      {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return false;
      }
      else if (atposition < 1 || dotposition < (atposition + 2)
                || (dotposition + 2) >= Email.length) {
            alert("Email không hợp lệ!");
            return false;
      }
      else if (vnf_regex.test(Phone) === false || Phone.length > 10) {
        alert("Số điện thoại không hợp lệ!");
            return false;
      }
      else if (Birth - today < 3650)
      {
        alert("Ngày sinh không hợp lệ!");
            return false;
      }     
      return true;
    }
</script>
@stop
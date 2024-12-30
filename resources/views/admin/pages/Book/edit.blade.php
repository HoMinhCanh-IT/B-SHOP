@extends('admin.layout')
@section('content')
<style>
    .row{
        padding-top:20px !important;
    }
    .editable-select{
      color: black;
      cursor: pointer;
    }
    a:hover{
      color: #ff4e00;
      text-decoration: none;
    }
    .save{
    display: none;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12" style="margin-left: 80px; padding-right:70px">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">CẬP NHẬT THÔNG TIN SÁCH</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li><a href="{{route('book.index')}}">Quản lý sách</a></li>
                      <li>{{ $Ten_Sach }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- form start -->
            <form action="{{ route('book.update', $Id) }}" method="POST" enctype="multipart/form-data" onsubmit="return CheckInput();">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Tên sách</label>
                    <input class="form-control" value="{{ $Ten_Sach }}" type="text" name="Ten_Sach" id="Ten_Sach" placeholder="Tên sách">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Thể loại</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="The_Loai" class="form-control" id="The_Loai" placeholder="Title">
                    @foreach($the_loai as $category)
                        <option value="{{$category->Id}}" {{ $The_Loai == $category->Id ? 'selected="selected"' : '' }} >{{$category->The_Loai}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5">
                  <label for="exampleInputTopic">Ảnh bìa</label>
                    <div class="custom-file">
                        <input accept="*.png|*.jpg|*.jpeg" type="file" class="form-control" value="{{ $Anh_Bia }}" name="Anh_Bia" id="Anh_Bia" placeholder="Chọn ảnh"/>
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <img src="{{$Anh_Bia}}" style="width:80px; height:80px; border-radius:0%; border: solid 1px">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Nhà xuất bản</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Nha_Xuat_Ban" class="form-control" id="Nha_Xuat_Ban" placeholder="Title">
                    @foreach($nha_xuat_ban as $publishingcompany)
                        <option value="{{$publishingcompany->Id}}" {{ $Nha_Xuat_Ban == $publishingcompany->Id ? 'selected="selected"' : '' }} >{{$publishingcompany->Ten_NXB}}</option>
                    @endforeach
                    </select>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Tác giả</label>
                    <input class="form-control" type="text" name="Tac_Gia" value="{{ $Tac_Gia }}" id="Tac_Gia" placeholder="Tác giả">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Phiên bản</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Phien_Ban" class="form-control" id="Phien_Ban" placeholder="Title">
                        @if ($Phien_Ban == 0)
                        <option value="0" selected>Bản thường</option>
                        <option value="1">Bản đặc biệt</option>  
                        @else 
                        <option value="0">Bản thường</option>
                        <option value="1" selected>Bản đặc biệt</option>
                        @endif
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Số trang</label>
                    <input class="form-control" type="text" id="So_Trang" value="{{ $So_Trang }}" name="So_Trang" placeholder="Số trang">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Loại bìa</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Loai_Bia" class="form-control" id="Loai_Bia" placeholder="Title">
                        @if ($Loai_Bia == 0)
                        <option value="0" selected>Bìa cứng</option>
                        <option value="1">Massmarket Paperback</option>
                        <option value="2">Bìa mềm</option>
                        @elseif ($Loai_Bia == 1)
                        <option value="0">Bìa cứng</option>
                        <option value="1" selected>Massmarket Paperback</option>
                        <option value="2">Bìa mềm</option>
                        @else
                        <option value="0">Bìa cứng</option>
                        <option value="1">Massmarket Paperback</option>
                        <option value="2" selected>Bìa mềm</option>
                        @endif
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Giá tiền</label>
                    <input class="form-control" type="text" value="{{ $Gia_Tien }}" name="Gia_Tien" id="Gia_Tien" placeholder="Giá tiền">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Số lượng</label>
                    <input class="form-control" type="text" value="{{ $So_Luong }}" name="So_Luong" id="So_Luong" placeholder="Số lượng">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <label for="exampleInputContent">Mô tả</label>
                    <textarea type="text" style="height:100px" class="form-control" name="Mo_Ta" id="Mo_Ta" placeholder="Nhập nội dung mô tả">{{ $Mo_Ta }}</textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5">
                    <label for="exampleInputTopic">SKU</label>
                    <input class="form-control" type="text" id="SKU" value="{{ $SKU }}" name="SKU" placeholder="SKU" style="margin-right:50px" readonly>
                  </div>
                  <div class="col-lg-1" style="padding-top:30px; margin-left:-10px">
                  <button type="button" onclick="makeSKU(10)" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button> &nbsp;
                  </div>
                  <div class="col-lg-6" style=" margin-left:10px">
                    <label for="exampleInputStatus">Trạng thái</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" class="form-control" name="Trang_Thai" id="Trang_Thai" placeholder="Status">
                        @if ($Trang_Thai == 0)
                        <option value="0" selected>Ngừng bán</option>
                        <option value="1">Tạm hết hàng</option>
                        <option value="2">Còn hàng</option>
                        @elseif ($Trang_Thai == 1)
                        <option value="0">Ngừng bán</option>
                        <option value="1" selected>Tạm hết hàng</option>
                        <option value="2">Còn hàng</option>
                        @else
                        <option value="0">Ngừng bán</option>
                        <option value="1">Tạm hết hàng</option>
                        <option value="2" selected>Còn hàng</option>
                        @endif
                    </select>
                  </div>
                </div>
                <div class="row" style="float:right">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button> &nbsp;
                  <a class="btn btn-secondary" href="{{route('book.index')}}" style="margin-left: 15px;margin-right: 30px; color:white"><i class="fas fa-window-close"></i></a>
                </div>
              </form>
              <div style="padding-top:80px"> <hr/> </div>
              <form>
              <div class="row" style="margin-top:30px">
                  <div class="col-lg-12">
                    <h5 class="font-weight-bold">HÌNH ẢNH KHÁC</h5><br/>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                    <table id="book" class="table table-hover table-bordered" style="margin-top:10px">
                        <thead>
                        <tr>
                        <th>Hình ảnh</th>
                        <th>Loại ảnh</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($anh_sach as $image)
                        <tr>
                        <td><img src="{{ $image->Anh_Sach }}" style="width:100px; height:100px; border-radius:0%"></td>
                        <td>
                        @if($image->Loai_Anh == 0) {{'Ảnh thumbnail'}}
                        @elseif($image->Loai_Anh == 1) {{'Ảnh hover'}}
                        @else {{'Ảnh slideshow'}}
                        @endif
                        </td>
                        <td>
                        @if($image->Trang_Thai == 0) <input style="margin-left:30px;width:20px;height:20px;margin-bottom: 0.5rem;" checked="" disabled="" type="checkbox" id="exampleInputTitle">
                        @else <input style="margin-left:30px;width:20px;height:20px;margin-bottom: 0.5rem;" disabled="" type="checkbox" id="exampleInputTitle">
                        @endif
                        </td>
                        <td>
                            <a onclick="return sendId({{$image->Id}}, {{$image->Loai_Anh}}, {{$image->Trang_Thai}})" class="btn btn-warning" data-toggle="modal" data-target="#exampleEditModalCenter" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                            <a onclick="return ComfirmDelete();" id="btn-delete" href="{{ route('book.deleteimage', [$image->Id]) }}" class="btn btn-danger delete" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></a>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>                        
                </table>
                  </div>
                </div>
              </form>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#ffa500a8;">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-size:120%; padding-left:160px">THÊM ẢNH</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('book.addimage') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body" style="margin-top:-25px">
          <div class="row">
              <div class="col-lg-12">
                <label for="exampleInputTopic">Chọn ảnh</label>
                <div class="custom-file">
                    <input accept="*.png|*.jpg|*.jpeg" type="file" class="form-control" name="Anh_Sach" id="Anh_Bia" placeholder="Chọn ảnh" />
                    <input type="text" value="{{ $Id }}" class="form-control" name="Id_Sach" hidden>
               </div>
              </div>
              <div class="col-lg-6" style="margin-top:20px">
                <label for="exampleInputTopic">Loại ảnh</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Loai_Anh" class="form-control" id="Loai_Bia" placeholder="Title">
                    <option value="0">Ảnh thumbnail</option>
                    <option value="1">Ảnh hover</option>
                    <option value="2">Ảnh slideshow</option>
                </select>
              </div>
              <div class="col-lg-6" style="margin-top:20px">
                <label for="exampleInputTopic">Trạng thái</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Trang_Thai" class="form-control" id="Loai_Bia" placeholder="Title">
                    <option value="0">Hoạt động</option>
                    <option value="1">Không hoạt động</option>
                </select>
              </div>
          </div>
      </div>
      <div class="modal-footer" style="background-color:#ffa50099">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- Modal Edit -->
<div class="modal fade" id="exampleEditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#ffa500a8;">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-size:120%; padding-left:160px">CHỈNH SỬA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('book.editimage') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body" style="margin-top:-25px">
          <div class="row">
              <div class="col-lg-6 select_type" style="margin-top:20px">
                <label for="exampleInputTopic">Loại ảnh</label>
                <input type="text" class="form-control" id="Id_Anh" name="Id_Anh" hidden>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Loai_Anh" class="form-control" id="Loai_Bia" placeholder="Title">
                    <option value="0">Ảnh thumbnail</option>
                    <option value="1">Ảnh hover</option>
                    <option value="2">Ảnh slideshow</option>
                </select>
              </div>
              <div class="col-lg-6 select_status" style="margin-top:20px">
                <label for="exampleInputTopic">Trạng thái</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Trang_Thai" class="form-control" id="Loai_Bia" placeholder="Title">
                    <option value="0">Hoạt động</option>
                    <option value="1">Không hoạt động</option>
                </select>
              </div>
          </div>
      </div>
      <div class="modal-footer" style="background-color:#ffa50099">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->
<script>
    function sendId(k, t, s){
        var Id = document.getElementById('Id_Anh');
        Id.value = k;
        if  (t === 0){
          $('.select_type option[value=0]').attr('selected','selected');
        }
        else if (t === 1){
          $('.select_type option[value=1]').attr('selected','selected');
        }
        else{
          $('.select_type option[value=2]').attr('selected','selected');
        }
        if  (s === 0){
          $('.select_status option[value=0]').attr('selected','selected');
        }
        else{
          $('.select_status option[value=1]').attr('selected','selected');
        }
    }
    function Active(){
      var element = document.getElementById("active_book");
      element.classList.add("active");
    }
    window.onload = Active();
    function makeSKU(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      document.getElementById("SKU").value = result;
    }
    function CheckInput(){
      var TenSach = document.getElementById('Ten_Sach').value;
      var TacGia = document.getElementById('Tac_Gia').value;
      var SoLuong = document.getElementById('So_Luong').value;
      var GiaTien = document.getElementById('Gia_Tien').value;
      var SoTrang = document.getElementById('So_Trang').value;
      if(TenSach === "" || TacGia === "" || SoLuong === "" || SoTrang === "" || GiaTien === "")
      {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return false;
      }
      return true;
    }
</script>
<script>
  function ComfirmDelete() {
  var txt;
  if (confirm("Bạn có muốn xóa ảnh đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
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
            <div class="col-md-12">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">CHỈNH SỬA</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- form start -->
                <form action="{{route('publishing.update',$nha_xuat_ban->Id)}}" method="POST" enctype="multipart/form-data">
                @csrf
               @method('PUT')
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Tên Nhà Xuất Bản</label>
                    <input class="form-control" type="text" name="Ten_NXB" placeholder="Tên Nhà Cung Cấp" value="{{$nha_xuat_ban->Ten_NXB}}">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Địa Chỉ</label>
                    <input class="form-control" type="text" name="Dia_Chi" placeholder="Địa Chỉ" value="{{$nha_xuat_ban->Dia_Chi}}">
                  </div>
                </div> 
                <div class="row">
                  
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Số Điện Thoại</label>
                    <input class="form-control" type="text" name="So_Dien_Thoai" placeholder="Số Điện Thoại" value="{{$nha_xuat_ban->So_Dien_Thoai}}">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Email</label>
                    <input class="form-control" type="text" name="Email" placeholder="Email" value="{{$nha_xuat_ban->Email}}">
                  </div>
                </div>
  
                <div class="row">
                
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Trạng thái</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" class="form-control" name="Trang_Thai"  placeholder="Status">
                        @if($nha_xuat_ban->Trang_Thai==0)
                        <option value="0" selected>Ngừng hoạt động</option>
                        <option value="1">Hoạt động</option>
                        @elseif($nha_xuat_ban->Trang_Thai==1)
                        <option value="0" >Ngừng hoạt động</option>
                        <option value="1" selected>Hoạt động</option>
                        @endif
                    </select>
                  </div>
                  
                </div>
                <div class="row" style="float:right">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button> &nbsp;
                  <button type="cancel" class="btn btn-secondary" style="margin-left: 15px;margin-right: 30px; color:white"><i class="fas fa-window-close"></i></button>
                </div>
              </form>
        </div>
    </div>
</div>
@stop
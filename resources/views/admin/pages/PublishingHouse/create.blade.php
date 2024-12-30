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
                  <h3 class="font-weight-bold">THÊM NHÀ XUẤT BẢN</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- form start -->
                <form action="{{route('publishing.store')}}" method="POST" >
                @csrf
                @method('POST')
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Tên Nhà Xuất Bản</label>
                    <input class="form-control" type="text"  placeholder="Tên Nhà Xuất Bản" name="Ten_NXB">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Địa Chỉ</label>
                    <input class="form-control" type="text"  placeholder="Địa Chỉ" name="Dia_Chi">
                  </div>
                </div> 
                <div class="row">
                 
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Số Điện Thoại</label>
                    <input class="form-control" type="text"  placeholder="Số Điện Thoại" name="So_Dien_Thoai">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Email</label>
                    <input class="form-control" type="text"  placeholder="Email" name="Email">
                  </div>
                </div>
  
                <div class="row">
                
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Trạng thái</label>
                    <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" class="form-control" name="Trang_Thai"  placeholder="Status">
                        <option value="0">Ngừng hoạt động</option>
                        <option value="1">Hoạt động</option>
                        
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
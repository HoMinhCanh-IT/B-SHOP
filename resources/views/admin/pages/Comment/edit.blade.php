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
            <form action="{{route('comment.update',$binh_luan->Id)}}" method="POST">
              @csrf
              @method('PATCH')
              <div class="form-group">
                <label for="name">Người Dùng</label>
                <input type="text" disabled class="form-control" value="{{$binh_luan->TaiKhoan->Ho_Ten}}">
              </div>
              <div class="form-group">
                <label for="name">Tên Sách</label>
                <input type="text" disabled class="form-control" value="{{$binh_luan->Sach->Ten_Sach}}">
              </div>
              <div class="form-group">
                <label for="review">Nội Dung</label>
              <textarea name="Noi_Dung" disabled id="" cols="20" rows="10" class="form-control">{{$binh_luan->Noi_Dung}}</textarea>
              </div>
              <div class="form-group">
                <label for="status">Trạng Thái</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" class="form-control" name="Trang_Thai"  placeholder="Status">
                        @if($binh_luan->Trang_Thai==0)
                        <option value="0" selected>Ngừng hoạt động</option>
                        <option value="1">Hoạt động</option>
                        @elseif($binh_luan->Trang_Thai==1)
                        <option value="0" >Ngừng hoạt động</option>
                        <option value="1" selected>Hoạt động</option>
                        @endif
                    </select>
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
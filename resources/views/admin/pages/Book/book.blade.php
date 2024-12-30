@extends('admin.layout')
@section('content')
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">QUẢN LÝ SÁCH</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Quản lý sách</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px; display: flex; margin-bottom: 10px">
                  <div class="col-lg-6">
                  <a class="btn btn-primary" href="{{ route('book.create')}}" style="padding: 0.7rem 1.5rem; border-radius: 10px; margin-left:10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                  </div>
                  <div class="col-lg-6">
                  <form id="" method="POST" action="{{ route('book.search')}}" style="float:right">
                  @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="bookName" placeholder="Nhập tên sách hoặc tác giả" >                     
                      <button id="btnsearch" class="btn-search" type="submit" style="padding: 0.5rem 1.5rem; border-radius: 10px;background:#a3a4a5c2"><i class='fas fa-search' style='font-size:15px'></i></button>
                  </form>
                  </div>
                </div>
                  <!-- /.card-header -->
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <div class="card-body">
                    <table id="book" class="table">
                  <thead>
                  <tr>
                    <th>Ảnh bìa</th>
                    <th>Tên sách</th>
                    <th>Thể loại</th>
                    <th>Tác giả</th>
                    <th>Nhà xuất bản</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($sach as $book)
                  <tr>
                    <td><img src="{{$book->Anh_Bia}}" style="width:80px; height:80px; border-radius:0%"></td>
                    <td style="max-width: 180px; text-overflow: ellipsis; overflow: hidden">{{$book->Ten_Sach}}</td>
                    <td>{{$book->TheLoai->The_Loai}}</td>
                    <td style="max-width: 180px; text-overflow: ellipsis; overflow: hidden">{{$book->Tac_Gia}}</td>
                    <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden">{{$book->NhaXuatBan->Ten_NXB}}</td>
                    <td>{{number_format($book->Gia_Tien)}} VNĐ</td>
                    <td>{{$book->So_Luong}}</td>
                    <td>
                    @if($book->Trang_Thai == 0) {{"Ngừng bán"}}
                    @elseif (($book->So_Luong == 0)) {{"Tạm hết hàng"}}
                    @else {{"Còn hàng"}}
                    @endif
                    </td>
                    <td>
                        <a href="{{ route('book.edit', [$book->Id]) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                        <a onclick="return ComfirmDelete();" href="{{ route('book.delete', [$book->Id]) }}" class="btn btn-danger" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">{{$sach->links("pagination::bootstrap-4")}}</div>
              </div>
              </div>
              <!-- /.card-body -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function ComfirmDelete() {
  var txt;
  if (confirm("Bạn có muốn xóa sách đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
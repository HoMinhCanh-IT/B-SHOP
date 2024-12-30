@extends('admin.layout')
@section('content')
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">QUẢN LÝ BÌNH LUẬN</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Quản lý bình luận</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px">
                <form id="" method="POST" action="{{ route('comment.search')}}" style="float:right">
                @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="NhapTimKiem" placeholder="Tìm kiếm" >                     
                      <button id="btnsearch" style="padding: 0.5rem 1.5rem; border-radius: 10px;background:#a3a4a5c2"><i class='fas fa-search' style='font-size:15px'></i></button>
                  </form>
                </div>
                  <!-- /.card-header -->
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <div class="card-body">
                    <table id="comment" class="table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên Người Dùng</th>
                    <th>Tên Sách</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($binh_luan as $comment)
                  <tr>
                    <td>{{$comment->Id}}</td>
                    <td>{{$comment->TaiKhoan->Ho_Ten}}</td>
                    <td>{{$comment->Sach->Ten_Sach}}</td>
                    <td>{{$comment->Noi_Dung}}</td>
                    <td>{{date("d-m-Y", strtotime($comment->Thoi_Gian))}}</td>
                    <td>   
                        @if($comment->Trang_Thai == 0) {{"Ngừng hoạt động"}}
                        @else {{"Hoạt động"}}
                        @endif
                    </td>
                    <td>
                    <form action="{{ route('comment.destroy',$comment->Id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{route('comment.edit',$comment->Id)}}" class="btn btn-warning" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                      <button onclick="return ComfirmDelete();" type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></button>
                    </form>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  
                </table>
              </div>
              </div>
              <!-- /.card-body -->
                </div>
               
            </div>
        </div>
    </div>
</div>
<script>
  function ComfirmDelete() {
  var txt;
  if (confirm("Bạn có muốn xóa bình luận đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
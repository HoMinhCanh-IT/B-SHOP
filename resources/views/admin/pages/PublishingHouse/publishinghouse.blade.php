@extends('admin.layout')
@section('content')
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">QUẢN LÝ NHÀ XUẤT BẢN</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Quản lý nhà xuất bản</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px; display: flex; margin-bottom: 10px">
                  <div class="col-lg-6">
                  <a class="btn btn-primary" href="{{ route('publishing.create')}}" style="padding: 0.7rem 1.5rem; border-radius: 10px; margin-left:10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                  </div>
                  <div class="col-lg-6">
                  <form id="" method="POST" action="{{ route('publishing.search')}}" style="float:right">
                  @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="NhapTimKiem" placeholder="Tìm Kiếm" >                     
                      <button id="btnsearch" class="btn-search" type="submit" style="padding: 0.5rem 1.5rem; border-radius: 10px;background:#a3a4a5c2"><i class='fas fa-search' style='font-size:15px'></i></button>
                  </form>
                  </div>
                </div>
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <div class="card-body">
                    <table id="publish" class="table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên Nhà Xuất Bản</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($nha_xuat_ban as $publish)
                  <tr>
                    <td>{{$publish->Id}}</td>
                    <td >{{$publish->Ten_NXB}}</td>
                    <td >{{$publish->Dia_Chi}}</td>
                    <td>{{$publish->So_Dien_Thoai}}</td>
                    <td>{{$publish->Email}}</td>
                    <td> 
                    @if($publish->Trang_Thai == 0) {{"Ngừng hoạt động"}}
                    @else {{"Hoạt động"}}
                    @endif
                    </td>
                    <td>
                        
                        <form action="{{ route('publishing.destroy',$publish->Id) }}" method="POST">
   
                          @csrf
                          @method('DELETE')
                          <a href="{{route('publishing.edit',$publish->Id)}}" class="btn btn-warning" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
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
</div>
<script>
  function ComfirmDelete() {
  var txt;
  if (confirm("Bạn có muốn xóa Nhà xuất bản đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
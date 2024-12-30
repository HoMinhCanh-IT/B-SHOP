@extends('admin.layout')
@section('content')
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">QUẢN LÝ TIN TỨC</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Quản lý tin tức</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px; display: flex; margin-bottom: 10px">
                  <div class="col-lg-6">
                  <a class="btn btn-primary" href="{{route('news.create')}}" style="padding: 0.7rem 1.5rem; border-radius: 10px; margin-left:10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                  </div>
                  <div class="col-lg-6">
                  <form id="" method="POST" action="{{ route('news.search')}}" style="float:right">
                  @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="newsName" placeholder="Nhập tiêu đề bài viết" >                     
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
                    <th>Tiêu đề</th>
                    <th>Hình đại diện</th>
                    <th>Chủ đề</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($tin_tuc as $news)
                  <tr >
                    <td>{{$news->Tieu_De}}</td>
                    <td><img src="{{$news->Hinh_Anh}}" style="width:80px; height:80px; border-radius:0%; object-fit:cover"></td>
                    <td>
                    @if ($news->Chu_De == 0) Hoạt động 
                    @elseif ($news->Chu_De == 1) Sự kiện
                    @else Khuyến mãi
                    @endif
                    </td>                  
                    <td style="text-align:center">
                    @if($news->Trang_Thai == 0) <input type="checkbox" disabled="disabled" checked/>
                    @else <input type="checkbox" disabled="disabled"/>
                    @endif
                    </td>
                    <td>
                        <a href="{{route('news.edit', [$news->Id])}}" class="btn btn-warning" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                        <a onclick="return ComfirmDelete();" href="{{route('news.delete', [$news->Id])}}" class="btn btn-danger" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">{{$tin_tuc->links("pagination::bootstrap-4")}}</div>
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
  if (confirm("Bạn có muốn xóa bài viết đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
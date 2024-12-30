@extends('admin.layout')
@section('content')
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">KHUYẾN MÃI</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Chương trình khuyến mãi</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px; display: flex; margin-bottom: 10px">
                  <div class="col-lg-6">
                  <a class="btn btn-primary" href="{{ route('promotion.create') }}" style="padding: 0.7rem 1.5rem; border-radius: 10px; margin-left:10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                  </div>
                  <div class="col-lg-6">
                  <form id="" method="POST" action="{{ route('promotion.search') }}" style="float:right">
                  @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="inputPromotion" placeholder="Nhập tên chương trình" >                     
                      <button id="btnsearch" class="btn-search" type="submit" style="padding: 0.5rem 1.5rem; border-radius: 10px;background:#a3a4a5c2"><i class='fas fa-search' style='font-size:15px'></i></button>
                  </form>
                  </div>
                </div>
                  <!-- /.card-header -->
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <div class="card-body">
                    <table id="promotion" class="table">
                  <thead>
                  <tr>
                    <th>Tiêu đề</th>
                    <th>Banner</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Nội dung</th>
                    <th>Link chi tiết</th>
                    <th>Trạng thái</th>
                  </tr>
                  </thead>
                  @foreach ($khuyen_mai as $promotion)
                  <tr>
                    <td>{{$promotion->Ten_CTKM}}</td>
                    <td><img src="\{{$promotion->Banner}}" style="width:80px; height:20px; border-radius:0%"></td>
                    <td>{{$promotion->Tg_Bat_Dau}}</td>
                    <td>{{$promotion->Tg_Ket_Thuc}}</td>
                    <td style="max-width:250px; text-overflow: ellipsis; overflow: hidden">{!! $promotion->Noi_Dung !!}</td>
                    <td style="max-width:200px; text-overflow: ellipsis; overflow: hidden">{{$promotion->Link_Chi_Tiet}}</td>
                    <td>
                    @if($promotion->Trang_Thai == 0) {{"Đang áp dụng"}}
                    @elseif (($promotion->Trang_Thai == 1)) {{"Hết hạn"}}
                    @else {{"Chưa đến"}}
                    @endif
                    </td>
                    <td>
                        <a href="{{ route('promotion.edit', [$promotion->Id]) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                        <a onclick="return ComfirmDelete()" href="{{ route('promotion.delete', [$promotion->Id]) }}" class="btn btn-danger" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></a>
                    </td>
                  </tr>
                  @endforeach
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">{{$khuyen_mai->links("pagination::bootstrap-4")}}</div>
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
  if (confirm("Bạn có muốn xóa chương trình khuyến mãi đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
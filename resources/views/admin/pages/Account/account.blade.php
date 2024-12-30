@extends('admin.layout')
@section('content')
<style>
    .hidetext { -webkit-text-security: disc; /* Default */ }
</style>
 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">QUẢN LÝ TÀI KHOẢN</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li>Quản lý tài khoản</li>
                    </ul>
                </div>
                <div class="col-lg-12" style="padding-top:20px; display: flex; margin-bottom: 10px">
                  <div class="col-lg-6">
                  <a class="btn btn-primary" href="{{ route('account.create')}}" style="padding: 0.7rem 1.5rem; border-radius: 10px; margin-left:10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                  </div>
                  <div class="col-lg-6">
                  <form id="" method="POST" action="{{ route('account.search')}}" style="float:right">
                  @csrf
                      <input style="padding: 0.5rem 1.5rem; border-radius: 10px; margin-left:1.55rem" type="text" name="inputAccount" placeholder="Nhập email, tên hoặc sđt" >                     
                      <button id="btnsearch" type="submit" class="btn-search" style="padding: 0.5rem 1.5rem; border-radius: 10px;background:#a3a4a5c2"><i class='fas fa-search' style='font-size:15px'></i></button>
                  </form>
                  </div>
                </div>
                <!-- table -->
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <div class="card-body">
                    <table id="account" class="table">
                  <thead>
                  <tr>
                    <th>Email</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Loại tài khoản</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($tai_khoan as $account)
                  <tr>
                    <td>{{$account->Email}}</td>
                    <!--<td class="hidetext" style="max-width:80px; text-overflow: clip; overflow: hidden;">{{$account->Mat_Khau}}</td>-->
                    <td>{{$account->Ho_Ten}}</td>
                    <td>
                    @if($account->Gioi_Tinh == 0) {{"Nam"}}
                    @else {{"Nữ"}}
                    @endif
                    </td>
                    <td>{{ date('d-m-Y', strtotime($account->Ngay_Sinh)) }}</td>
                    <td>{{$account->So_Dien_Thoai}}</td>
                    <td>{{$account->Dia_Chi}}</td>
                    <td>
                    @if($account->Loai_TK == 0) {{"Admin"}}
                    @else {{"Khách hàng"}}
                    @endif
                    </td>
                    @if($account->Trang_Thai == 0)
                    <td style="text-align:center"><input type="checkbox" disabled="disabled" checked/></td>
                    @else
                    <td style="text-align:center"><input type="checkbox" disabled="disabled"/></td>
                    @endif
                    <td>
                        <a href="{{ route('account.edit', [$account->Id]) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                        <a onclick="return ComfirmDelete();" href="{{ route('account.delete', [$account->Id]) }}" class="btn btn-danger" style="padding: 0.5rem 1rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">{{$tai_khoan->links("pagination::bootstrap-4")}}</div>
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
  if (confirm("Bạn có muốn xóa tài khoản đã chọn?")) {
    return true;
  }
  return false;
}
</script>
@stop
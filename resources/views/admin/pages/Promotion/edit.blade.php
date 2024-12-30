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
            <div class="col-md-12" style="margin-left: 80px; padding-right:70px">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">CẬP NHẬT KHUYẾN MÃI</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li><a href="{{route('promotion.index')}}">Chương trình khuyến mãi</a></li>
                      <li>{{$Ten_CTKM}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- form start -->
                @if($errors->has('update'))
                <p class="login-box-msg">
                  <strong class="text-danger" style="color:red">{{ $errors->first('update') }}</strong>
                </p>
                @endif
                <form action=" {{route('promotion.update', $Id)}} " method="POST" enctype="multipart/form-data" onsubmit="return CheckInput();">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Tiêu đề</label>
                    <input class="form-control" type="text" value="{{$Ten_CTKM}}" name="Ten_CTKM" id="Tieu_De" placeholder="Tiêu đề">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Ngày bắt đầu</label>
                    <input class="form-control" type="date" value="{{$Tg_Bat_Dau}}" name="Tg_Bat_Dau" id="Tg_Bat_Dau" placeholder="Chọn ngày">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTopic">Ảnh banner</label>
                    <div class="custom-file">
                        <input accept="*.png|*.jpg|*.jpeg" type="file" class="form-control" name="Banner" id="Banner" placeholder="Chọn ảnh" name="hinh_anh" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Ngày kết thúc</label>
                    <input class="form-control" type="date" name="Tg_Ket_Thuc" value="{{$Tg_Ket_Thuc}}" id="Tg_Ket_Thuc" placeholder="Chọn ngày">
                  </div>
                </div> 
                <div class="row">
                  <div class="col-lg-12">
                    <label for="exampleInputContent">Nội dung</label>
                    <textarea type="text" style="height:100px" class="form-control" name="Noi_Dung" id="editor" placeholder="Nhập nội dung chương trình khuyến mãi">{{$Noi_Dung}}</textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Link chi tiết</label>
                    <input class="form-control" type="text" name="Link_Chi_Tiet" value="{{$Link_Chi_Tiet}}" id="Link_Chi_Tiet" placeholder="Nhập link chi tiết">
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
                <div class="row" style="float:right">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button> &nbsp;
                  <a class="btn btn-secondary" href="{{route('promotion.index')}}" style="margin-left: 15px;margin-right: 30px; color:white"><i class="fas fa-window-close"></i></a>
                </div>
              </form>
              <div style="padding-top:80px"> <hr/> </div>
              <form>
              <div class="row" style="margin-top:30px">
                  <div class="col-lg-12">
                    <h5 class="font-weight-bold">NỘI DUNG KHUYẾN MÃI</h5><br/>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-plus' style='font-size:15px'></i></a>
                    <table id="set-promotion" class="table table-hover table-bordered" style="margin-top:10px">
                        <thead>
                        <tr>
                        <th>Thể loại sách</th>
                        <th>Giá trị khuyến mãi</th>
                        <th>Kích hoạt</th>
                        <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($noi_dung_khuyen_mai as $detailpromotion)
                        <tr>
                        <td>{{$detailpromotion->TheLoai->The_Loai}}</td>
                        <td>{{$detailpromotion->Gia_Tri_Khuyen_Mai}}%</td>
                        <td>
                        @if($detailpromotion->Kich_Hoat == 0) <input style="margin-left:30px;width:20px;height:20px;margin-bottom: 0.5rem;" checked="" disabled="" type="checkbox" id="exampleInputTitle">
                        @else <input style="margin-left:30px;width:20px;height:20px;margin-bottom: 0.5rem;" disabled="" type="checkbox" id="exampleInputTitle">
                        @endif
                        </td>
                        <td>
                            <a onclick="return sendId({{$detailpromotion->Id}}, {{$detailpromotion->Id_The_Loai}}, {{$detailpromotion->Gia_Tri_Khuyen_Mai}}, {{$detailpromotion->Kich_Hoat}})" class="btn btn-warning" data-toggle="modal" data-target="#exampleEditModalCenter" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-edit' style='font-size:15px'></i></a>
                            <a onclick="return ComfirmDelete();" id="btn-delete" href="{{ route('promotion.delpromotiondetail', [$detailpromotion->Id]) }}" class="btn btn-danger delete" style="padding: 0.7rem 1.5rem; border-radius: 10px;"><i class='fas fa-trash-alt' style='font-size:15px'></i></a>
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
        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-size:120%; padding-left:190px">THÊM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('promotion.addpromotiondetail')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body" style="margin-top:-25px">
          <div class="row">
              <div class="col-lg-6">
                <label for="exampleInputTopic">Thể loại sách</label>              
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="The_Loai" class="form-control" id="The_Loai" placeholder="Title">
                @foreach ($the_loai as $category)
                    <option value="{{$category->Id}}">{{$category->The_Loai}}</option>
                @endforeach
                </select>
              </div>            
              <div class="col-lg-6">
                <label for="exampleInputTopic">Giá trị khuyến mãi (%)</label>
                <input type="text" class="form-control" name="Gia_Tri" id="Gia_Tri">
                <input type="text" value="{{$Id}}" class="form-control" name="Id_Khuyen_Mai" hidden>              
              </div>
              <div class="col-lg-6" style="margin-top:20px">
                <label for="exampleInputTopic">Kích hoạt</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Kich_Hoat" class="form-control" id="Kich_Hoat" placeholder="Title">
                    <option value="0">Kích hoạt</option>
                    <option value="1">Hủy kích hoạt</option>
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
      <form action="{{route('promotion.editpromotiondetail')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body" style="margin-top:-25px">
          <div class="row">
              <div class="col-lg-6" id="the-loai">
                <label for="exampleInputTopic">Thể loại sách</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="The_Loai" class="form-control" id="id-the-loai" placeholder="Title">
                @foreach ($the_loai as $category)
                    <option value="{{$category->Id}}">{{$category->The_Loai}}</option>
                @endforeach
                </select>
              </div>             
              <div class="col-lg-6" id="gia-tri">
                <label for="exampleInputTopic">Giá trị khuyến mãi (%)</label>
                <input type="text" class="form-control" name="Gia_Tri" id="GTKM">
                <input type="text" class="form-control" name="Id_NDKM" id="Id_NDKM" hidden>
              </div>
              <div class="col-lg-6 kich-hoat" style="margin-top:20px">
                <label for="exampleInputTopic">Kích hoạt</label>
                <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Kich_Hoat" class="form-control" id="Kich_Hoat" placeholder="Title">
                    <option value="0">Kích hoạt</option>
                    <option value="1">Hủy kích hoạt</option>
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
<script src="{{ asset('admin/js/ckeditor.js') }}"></script>
<script>
    function sendId(k, t, v, a){
        var Id = document.getElementById('Id_NDKM');
        var Gt = document.getElementById('GTKM');
        var Tl = document.getElementById('id-the-loai');
        Id.value = k;
        Gt.value = v;
        Tl.value = t;
        if  (a === 0){
          $('.kich-hoat option[value=0]').attr('selected','selected');
        }
        else {
          $('.kich-hoat option[value=1]').attr('selected','selected');
        }
    }
    function ComfirmDelete() {
      if (confirm("Bạn có muốn xóa khuyến mãi đã chọn?")) {
        return true;
      }
      return false;
    }
    function Active(){
      var element = document.getElementById("active_promotion");
      element.classList.add("active");
    }
    window.onload = Active();
    function CheckInput(){
      var TieuDe = document.getElementById('Tieu_De').value;
      var TgBD = document.getElementById('Tg_Bat_Dau').value;
      var TgKT = document.getElementById('Tg_Ket_Thuc').value;
      var Link = document.getElementById('Link_Chi_Tiet').value;
      var NoiDung = document.getElementById('Noi_Dung').value;
      if(TieuDe === "" || TgBD === "" || TgKT === "" || Link === "" || NoiDung === "")
      {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return false;
      }
      else if (TgBD > TgKT) 
      {
        alert("Ngày bắt đầu không được lớn hơn ngày kết thúc!");
        return false;
      }
      else return true;
    }
</script>
<script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
            
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'imageUpload',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo'
                    ]
                },
                language: 'vi',
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:full',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                licenseKey: '',
              
            })
            .then(editor => {
                window.editor = editor;
            
      })
      .catch(error => {
          console.error('Oops, something went wrong!');
          console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
          console.warn('Build id: xxscohtgbl7s-8o65j7c6blw0');
          console.error(error);
      });
</script>  
@stop
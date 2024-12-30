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
                  <h3 class="font-weight-bold">THÊM KHUYẾN MÃI</h3>
                </div>
                <div class="col-12" style="padding-top:10px;">
                    <ul class="breadcrumb" style="border: none">
                      <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                      <li><a href="{{route('promotion.index')}}">Chương trình khuyến mãi</a></li>
                      <li>Thêm khuyến mãi</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- form start -->
                @if($errors->has('create'))
                <p class="login-box-msg">
                  <strong class="text-danger" style="color:red">{{ $errors->first('create') }}</strong>
                </p>
                @endif
                <form action=" {{route('promotion.store')}} " method="POST" enctype="multipart/form-data" onsubmit="return CheckInput();">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Tiêu đề</label>
                    <input class="form-control" type="text" name="Ten_CTKM" id="Tieu_De" placeholder="Tiêu đề">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Ngày bắt đầu</label>
                    <input class="form-control" type="date" name="Tg_Bat_Dau" id="Tg_Bat_Dau" placeholder="Chọn ngày">
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
                    <input class="form-control" type="date" name="Tg_Ket_Thuc" id="Tg_Ket_Thuc" placeholder="Chọn ngày">
                  </div>
                </div> 
                <div class="row">
                  <div class="col-lg-12">
                    <label for="exampleInputContent">Nội dung</label>
                    <textarea type="text" style="height:100px" class="form-control" name="Noi_Dung" id="editor" placeholder="Nhập nội dung chương trình khuyến mãi"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleInputTitle">Link chi tiết</label>
                    <input class="form-control" type="text" name="Link_Chi_Tiet" id="Link_Chi_Tiet" placeholder="Nhập link chi tiết">
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
                <div class="row" style="float:right">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button> &nbsp;
                  <a class="btn btn-secondary" href="{{route('promotion.index')}}" style="margin-left: 15px;margin-right: 30px; color:white"><i class="fas fa-window-close"></i></a>
                </div>
              </form>
        </div>
    </div>
</div>
<script src="{{ asset('admin/js/ckeditor.js') }}"></script>
<script>
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
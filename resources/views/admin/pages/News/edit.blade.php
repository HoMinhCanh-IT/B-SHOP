@extends('admin.layout')
@section('content')
    <style>
        .row {
            padding-top: 20px !important;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12" style="margin-left: 80px; padding-right:70px">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">CẬP NHẬT TIN TỨC</h3>
                    </div>
                    <div class="col-12" style="padding-top:10px;">
                        <ul class="breadcrumb" style="border: none">
                            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li><a href="{{ route('news.index') }}">Tin tức</a></li>
                            <li>{{ $Tieu_De }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- form start -->
                <form action=" {{ route('news.update', $Id) }} " method="POST" enctype="multipart/form-data"
                    onsubmit="return CheckInput();">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="exampleInputTitle">Tiêu đề</label>
                            <input class="form-control" type="text" name="Tieu_De" id="Tieu_De" placeholder="Tiêu đề"
                                value="{{ $Tieu_De }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="exampleInputTitle">Chủ đề</label>
                            <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Chu_De"
                                class="form-control" id="Chu_De" placeholder="Title">
                                @if ($Chu_De == 0)
                                    <option value="0" selected>Hoạt động</option>
                                    <option value="1">Sự kiện</option>
                                    <option value="2">Khuyến mãi</option>
                                @elseif ($Chu_De == 1)
                                    <option value="0">Hoạt động</option>
                                    <option value="1" selected>Sự kiện</option>
                                    <option value="2">Khuyến mãi</option>
                                @else
                                    Khuyến mãi
                                    <option value="0">Hoạt động</option>
                                    <option value="1">Sự kiện</option>
                                    <option value="2" selected>Khuyến mãi</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="exampleInputTopic">Hình ảnh</label>
                            <div class="custom-file">
                                <input accept="*.png|*.jpg|*.jpeg" type="file" class="form-control" name="Hinh_Anh"
                                    id="Hinh_Anh" placeholder="Chọn ảnh" name="Hinh_Anh" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="exampleInputTitle">Trạng thái</label>
                            <select style="border: 1px solid #CED4DA;border-radius: 4px; outline: none;" name="Trang_Thai"
                                class="form-control" id="Trang_Thai" placeholder="Title">
                                <option value="0">Đang hoạt động</option>
                                <option value="1">Ngưng hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="exampleInputContent">Nội dung</label>
                            <textarea type="text" style="height:100px" class="form-control" name="Noi_Dung" id="editor"
                                placeholder="Nhập nội dung bài viết">{!! $Noi_Dung !!}</textarea>
                        </div>
                    </div>
                    <div class="row" style="float:right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button> &nbsp;
                        <a class="btn btn-secondary" href="{{ route('news.index') }}"
                            style="margin-left: 15px;margin-right: 30px; color:white"><i
                                class="fas fa-window-close"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/js/ckeditor.js') }}"></script>
    <script>
        function Active() {
            var element = document.getElementById("active_news");
            element.classList.add("active");
        }
        window.onload = Active();

        function CheckInput() {
            var TieuDe = document.getElementById('Tieu_De').value;
            var NoiDung = document.getElementById('editor').value;
            if (TieuDe === "") {
                alert("Vui lòng nhập đầy đủ thông tin!");
                return false;
            } else return true;
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
                console.error('Please, report the following error on  with the build id and the error stack trace:');
                console.warn('Build id: xxscohtgbl7s-8o65j7c6blw0');
                console.error(error);
            });
    </script>
@stop

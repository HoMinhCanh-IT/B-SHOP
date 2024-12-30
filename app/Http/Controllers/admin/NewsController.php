<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function index()
    {

        $tin_tuc = News::where('Id', '<>', 0)->orderBy('Id', 'desc')->paginate(5);
        return View('admin.pages.News.news', ['tin_tuc' => $tin_tuc]);
    }


    public function create()
    {

        return View('admin.pages.News.create');
    }


    public function store(Request $request)
    {

        if ($request->file('Hinh_Anh') != null) {
            $name = $request->file('Hinh_Anh')->getClientOriginalName();
            $path = $request->file('Hinh_Anh')->move('admin/images', $name);
            $path_img = explode("admin/", $path);
            $hinh_anh = array_pop($path_img);
        } else $hinh_anh = '/images/noimage.png';
        $tin_tuc = News::create([
            'Tieu_De' => $request['Tieu_De'],
            'Hinh_Anh' => $hinh_anh,
            'Noi_Dung' => $request['Noi_Dung'],
            'Chu_De' => $request['Chu_De'],
            'Trang_Thai' => $request['Trang_Thai'],
        ]);
        return redirect()->route('news.index');
    }


    public function show($id) {}


    public function edit($id)
    {

        $tin_tuc = News::find($id);
        return View('admin.pages.News.edit', $tin_tuc);
    }

    public function update(Request $request, $id)
    {

        $tin_tuc = News::find($id);
        if ($request->file('Hinh_Anh') != null) {
            $name = $request->file('Hinh_Anh')->getClientOriginalName();
            $path = $request->file('Hinh_Anh')->move('admin/images', $name);
            $path_img = explode("admin/", $path);
            $hinh_anh = array_pop($path_img);
        } else $hinh_anh = $tin_tuc->Hinh_Anh;

        $tin_tuc->Tieu_De = $request['Tieu_De'];
        $tin_tuc->Hinh_Anh = $hinh_anh;
        $tin_tuc->Chu_De = $request['Chu_De'];
        $tin_tuc->Noi_Dung = $request['Noi_Dung'];
        $tin_tuc->Trang_Thai = $request['Trang_Thai'];
        $tin_tuc->save();
        return redirect()->route('news.index');
    }


    public function destroy($id) {}

    public function delete(Request $request, $id)
    {
        $tin_tuc = News::find($id);
        $tin_tuc->delete();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $tin_tuc = News::where('Tieu_De', 'like', '%' . $request->newsName . '%')
            ->paginate(5);
        return View('admin.pages.News.news', ['tin_tuc' => $tin_tuc]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Models\Book;
use App\Models\Category;
use App\Models\ImageBook;
use App\Models\PublishingHouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class BookController extends Controller
{

    public function index()
    {
        $sach = Book::where('is_deleted', 0)->orderBy('created_at', 'desc')->paginate(5); // Phân trang
        return View('admin.pages.Book.book', ['sach' => $sach]);
    }


    public function create()
    {

        $the_loai = Category::all();
        $nha_xuat_ban = PublishingHouse::all();
        return View(
            'admin.pages.Book.create',
            ['the_loai' => $the_loai],
            ['nha_xuat_ban' => $nha_xuat_ban]
        );
    }

    public function store(Request $request)
    {
        if ($request->file('Anh_Bia') != null) $pathimg = '/user/images/book/' . $request->file('Anh_Bia')->getClientOriginalName();
        else $pathimg = '/user/images/book/';
        $sach = Book::create([
            'Ten_Sach' => $request['Ten_Sach'],
            'The_Loai' => $request['The_Loai'],
            'Anh_Bia' => $pathimg,
            'Nha_Xuat_Ban' => $request['Nha_Xuat_Ban'],
            'Tac_Gia' => $request['Tac_Gia'],
            'So_Luong' => $request['So_Luong'],
            'Mo_Ta' => $request['Mo_Ta'],
            'Phien_Ban' => $request['Phien_Ban'],
            'Loai_Bia' => $request['Loai_Bia'],
            'Gia_Tien' => $request['Gia_Tien'],
            'SKU' => $request['SKU'],
            'So_Trang' => $request['So_Trang'],
            'Trang_Thai' => $request['Trang_Thai'],
        ]);
        //return dd($sach);
        return redirect()->route('book.index');
    }


    public function show($id) {}


    public function edit($id)
    {

        $sach = Book::find($id);
        $the_loai = Category::all();
        $nha_xuat_ban = PublishingHouse::all();
        $anh_sach = ImageBook::where('Id_Sach', $id)->get();
        //return dd($anh_sach);
        return View('admin.pages.Book.edit', $sach, ['the_loai' => $the_loai, 'nha_xuat_ban' => $nha_xuat_ban, 'anh_sach' => $anh_sach]);
    }

    public function update(Request $request, $id)
    {
        $sach = Book::find($id);
        if ($request->file('Anh_Bia') == null) $pathimg = $sach->Anh_Bia;
        else $pathimg = '/user/images/book/' . $request->file('Anh_Bia')->getClientOriginalName();

        $sach->Ten_Sach = $request['Ten_Sach'];
        $sach->The_Loai = $request['The_Loai'];
        $sach->Nha_Xuat_Ban = $request['Nha_Xuat_Ban'];
        $sach->Anh_Bia = $pathimg;
        $sach->Tac_Gia = $request['Tac_Gia'];
        $sach->So_Luong = $request['So_Luong'];
        $sach->Mo_Ta = $request['Mo_Ta'];
        $sach->Phien_Ban = $request['Phien_Ban'];
        $sach->Loai_Bia = $request['Loai_Bia'];
        $sach->Gia_Tien = $request['Gia_Tien'];
        $sach->SKU = $request['SKU'];
        $sach->So_Trang = $request['So_Trang'];
        $sach->Trang_Thai = $request['Trang_Thai'];
        $sach->save();
        return redirect()->back();
        //return dd($sach);
        //
    }
    public function delete(Request $request, $id)
    {
        $sach = Book::find($id);
        $sach->is_deleted = 1;
        $sach->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $sach = Book::where([['Ten_Sach', 'like', '%' . $request->bookName . '%'], ['is_deleted', '=', '0']])
            ->orwhere([['Tac_Gia', 'like', '%' . $request->bookName . '%'], ['is_deleted', '=', '0']])
            ->paginate(5);
        return View('admin.pages.Book.book', ['sach' => $sach]);
    }

    public function addimage(Request $request)
    {
        if ($request->file('Anh_Sach') != null) $pathimg = '/user/images/book/' . $request->file('Anh_Sach')->getClientOriginalName();
        else $pathimg = '/user/images/book/';
        $anh_sach = ImageBook::create([
            'Anh_Sach' => $pathimg,
            'Id_Sach' => $request['Id_Sach'],
            'Loai_Anh' => $request['Loai_Anh'],
            'Trang_Thai' => $request['Trang_Thai'],
        ]);
        //return dd($sach);
        return redirect()->back();
    }

    public function editimage(Request $request)
    {
        $id = $request['Id_Anh'];
        $anh_sach = ImageBook::find($id);
        $anh_sach->Loai_Anh = $request['Loai_Anh'];
        $anh_sach->Trang_Thai = $request['Trang_Thai'];
        $anh_sach->save();
        //return dd($anh_sach);
        return redirect()->back();
    }

    public function deleteimage($id)
    {
        $anh_sach = ImageBook::find($id);
        $anh_sach->delete();
        return redirect()->back();
    }

    public function checkimage($id)
    {
        $anh_sach = ImageBook::find($id);
        $anh_sach->Trang_Thai = 0;
        $anh_sach->save();
        return redirect()->back();
    }

    public function uncheckimage($id)
    {
        $anh_sach = ImageBook::find($id);
        $anh_sach->Trang_Thai = 1;
        $anh_sach->save();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\DetailPromotion;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

class PromotionController extends Controller
{

    public function index()
    {

        $khuyen_mai = Promotion::where('is_deleted', 0)->orderBy('Id', 'desc')->paginate(4);
        return View('admin.pages.Promotion.promotion', ['khuyen_mai' => $khuyen_mai]);
    }


    public function create()
    {

        return View('admin.pages.Promotion.create');
    }


    public function store(Request $request)
    {
        $get_used = Promotion::where([['Trang_Thai', '=', 0], ['is_deleted', '=', 0]]);

        if ($request->file('Banner') != null) {
            $name = $request->file('Banner')->getClientOriginalName();
            $pathimg = $request->file('Banner')->move('images', $name);
        } else $pathimg = '/admin/images/promotion/';
        //lấy trạng thái
        $datenow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startdate = $request['Tg_Bat_Dau'];
        $enddate = $request['Tg_Ket_Thuc'];
        if ($enddate < $datenow) $trangthai = 1;
        else if ($startdate > $datenow) $trangthai = 2;
        else $trangthai = 0;

        if ($trangthai == 0 && $get_used != null) {
            $errors = new MessageBag(['create' => ["Có khuyến mãi đang áp dụng. Không thể tạo nữa!"]]);
            return redirect()->route('promotion.create')->withErrors($errors);
        } else {
            $khuyen_mai = Promotion::create([
                'Ten_CTKM' => $request['Ten_CTKM'],
                'Banner' => $pathimg,
                'Tg_Bat_Dau' => $startdate,
                'Tg_Ket_Thuc' => $enddate,
                'Noi_Dung' => $request['Noi_Dung'],
                'Link_Chi_Tiet' => $request['Link_Chi_Tiet'],
                'Trang_Thai' => $trangthai,
            ]);
            //return dd($datenow);
            return redirect()->route('promotion.index');
        }
    }


    public function show($id) {}


    public function edit($id)
    {

        $khuyen_mai = Promotion::find($id);
        $noi_dung_khuyen_mai = DetailPromotion::all()->where('Id_Khuyen_Mai', $id);
        $the_loai = Category::all();
        //return dd($noi_dung_khuyen_mai);
        return View('admin.pages.Promotion.edit', $khuyen_mai, ['noi_dung_khuyen_mai' => $noi_dung_khuyen_mai, 'the_loai' => $the_loai]);
    }


    public function update(Request $request, $id)
    {
        //
        $get_used = Promotion::where([['Trang_Thai', '=', 0], ['is_deleted', '=', 0]])->first();
        $khuyen_mai = Promotion::find($id);
        if ($request->file('Banner') != null) {
            $name = $request->file('Banner')->getClientOriginalName();
            $pathimg = $request->file('Banner')->move('images', $name);
        } else $pathimg = $khuyen_mai->Banner;
        //lấy trạng thái
        $datenow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startdate = $request['Tg_Bat_Dau'];
        $enddate = $request['Tg_Ket_Thuc'];
        if ($enddate < $datenow) $trangthai = 1;
        else if ($startdate > $datenow) $trangthai = 2;
        else $trangthai = 0;
        //
        if ($get_used != null) {
            $used_Id = $get_used->Id;
            //
            if ($trangthai == 0 && $used_Id != $id) {
                $errors = new MessageBag(['update' => ["Có khuyến mãi đang áp dụng. Không thể tạo nữa!"]]);
                return redirect()->route('promotion.edit', $id)->withErrors($errors);
            } else {
                $khuyen_mai->Ten_CTKM = $request['Ten_CTKM'];
                $khuyen_mai->Banner = $pathimg;
                $khuyen_mai->Tg_Bat_Dau = $startdate;
                $khuyen_mai->Tg_Ket_Thuc = $enddate;
                $khuyen_mai->Noi_Dung = $request['Noi_Dung'];
                $khuyen_mai->Link_Chi_Tiet = $request['Link_Chi_Tiet'];
                $khuyen_mai->Trang_Thai = $trangthai;
                $khuyen_mai->save();
                return redirect()->back();
            }
        } else {
            $khuyen_mai->Ten_CTKM = $request['Ten_CTKM'];
            $khuyen_mai->Banner = $pathimg;
            $khuyen_mai->Tg_Bat_Dau = $startdate;
            $khuyen_mai->Tg_Ket_Thuc = $enddate;
            $khuyen_mai->Noi_Dung = $request['Noi_Dung'];
            $khuyen_mai->Link_Chi_Tiet = $request['Link_Chi_Tiet'];
            $khuyen_mai->Trang_Thai = $trangthai;
            $khuyen_mai->save();
            return redirect()->back();
        }
    }


    public function destroy($id) {}

    public function delete(Request $request, $id)
    {
        $khuyen_mai = Promotion::find($id);
        $khuyen_mai->is_deleted = 1;
        $khuyen_mai->save();
        return redirect()->route('promotion.index');
    }

    public function search(Request $request)
    {
        $khuyen_mai = Promotion::where([['Ten_CTKM', 'like', '%' . $request->inputPromotion . '%'], ['is_deleted', '=', '0']])
            ->orderBy('Id', 'desc')->paginate(7);
        return View('admin.pages.Promotion.promotion', ['khuyen_mai' => $khuyen_mai]);
    }

    public function addpromotiondetail(Request $request)
    {
        $noi_dung = DetailPromotion::create([
            'Id_Khuyen_Mai' => $request['Id_Khuyen_Mai'],
            'Id_The_Loai' => $request['The_Loai'],
            'Gia_Tri_Khuyen_Mai' => $request['Gia_Tri'],
            'Kich_Hoat' => $request['Kich_Hoat'],
        ]);
        //return dd($datenow);
        return redirect()->back();
    }

    public function editpromotiondetail(Request $request)
    {
        $id = $request['Id_NDKM'];
        $noi_dung = DetailPromotion::find($id);
        $noi_dung->Id_The_Loai = $request['The_Loai'];
        $noi_dung->Gia_Tri_Khuyen_Mai = $request['Gia_Tri'];
        $noi_dung->Kich_Hoat = $request['Kich_Hoat'];
        $noi_dung->save();
        //return dd($datenow);
        return redirect()->back();
    }

    public function delpromotiondetail($id)
    {
        $noi_dung = DetailPromotion::find($id);
        $noi_dung->delete();
        //return dd($datenow);
        return redirect()->back();
    }
}

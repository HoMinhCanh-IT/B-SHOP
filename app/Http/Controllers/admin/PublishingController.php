<?php

namespace App\Http\Controllers\admin;

use App\Models\PublishingHouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PublishingController extends Controller
{

    public function __construct()
    {
        $this->viewprefix = 'admin.pages.PublishingHouse.';
        $this->viewnamespace = 'admin/pages/PublishingHouse';
    }
    public function index()
    {

        $nha_xuat_ban = PublishingHouse::all();
        return view($this->viewprefix . 'publishinghouse', compact('nha_xuat_ban'));
    }


    public function create()
    {

        return view($this->viewprefix . 'create');
    }


    public function store(Request $request)
    {

        $nha_xuat_ban = new PublishingHouse();
        $this->validate($request, [
            'Ten_NXB' => 'required',
            'Dia_Chi' => 'required',
            'So_Dien_Thoai' => 'required',
            'Email' => 'required',
            'Trang_Thai' => 'required',

        ]);
        $nha_xuat_ban->Ten_NXB = $request->Ten_NXB;
        $nha_xuat_ban->Dia_Chi = $request->Dia_Chi;
        $nha_xuat_ban->So_Dien_Thoai = $request->So_Dien_Thoai;
        $nha_xuat_ban->Email = $request->Email;
        $nha_xuat_ban->Trang_Thai = $request->Trang_Thai;

        if ($nha_xuat_ban->save()) {
            Session::flash('message', 'successfully!');
        } else
            Session::flash('message', 'Failure!');
        return redirect()->route('publishing.index');
    }


    public function show($id) {}


    public function edit($id)
    {

        $nha_xuat_ban = PublishingHouse::find($id); //publishinghouse tên model
        return view($this->viewprefix . 'edit')->with('nha_xuat_ban', $nha_xuat_ban);
    }


    public function update(Request $request, $id)
    {

        $nha_xuat_ban = PublishingHouse::find($id);
        $data = $request->validate([
            'Ten_NXB' => 'required',
            'Dia_Chi' => 'required',
            'So_Dien_Thoai' => 'required',
            'Email' => 'required',
            'Trang_Thai' => 'required',

        ]);

        if ($nha_xuat_ban->update($data)) {
            Session::flash('message', 'successfully!');
        } else
            Session::flash('message', 'Failure!');
        return redirect()->route('publishing.index');
    }

    public function destroy($id)
    {

        $nha_xuat_ban = PublishingHouse::find($id);
        $nha_xuat_ban->delete();
        return redirect()->route('publishing.index');
    }

    public function search(Request $request)
    {
        $nha_xuat_ban = PublishingHouse::where('Ten_NXB', 'like', '%' . $request->NhapTimKiem . '%')
            ->paginate(5);
        return View($this->viewprefix . 'publishinghouse', ['nha_xuat_ban' => $nha_xuat_ban]);
    }
}

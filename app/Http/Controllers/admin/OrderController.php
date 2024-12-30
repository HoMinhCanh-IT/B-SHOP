<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use Session;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->viewprefix = 'admin.pages.OrderManagement.';
        $this->viewnamespace = 'admin/pages/OrderManagement';
    }
    public function index()
    {

        $don_hang = Order::orderBy('Id', 'desc')->get();

        return view($this->viewprefix . 'ordermanagement', compact('don_hang'));
    }


    public function create() {}


    public function store(Request $request) {}


    public function edit($id)
    {

        $don_hang = Order::find($id); //publishinghouse tên model
        return view($this->viewprefix . 'edit')->with('don_hang', $don_hang);
    }


    public function update(Request $request, $id)
    {
        $don_hang = Order::find($id);
        $data = $request->validate([
            'Trang_Thai' => 'required',
        ]);

        if ($don_hang->update($data)) {
            Session::flash('message', 'successfully!');
        } else
            Session::flash('message', 'Failure!');
        return redirect()->route('order.index');
    }


    public function destroy($id)
    {

        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.index');
    }
    public function show($id)
    {

        $don_hang = Order::find($id);
        $kh = Account::where('Id', Cookie::get('UserId'))->get();
        $ct = OrderDetail::where('Id_DH', $id)->get();
        // return $order;
        return view($this->viewprefix . 'show', compact('don_hang', 'kh', 'ct'));
    }

    public function search(Request $request)
    {
        $don_hang = Order::where('Dia_Chi_Giao_Hang', 'like', '%' . $request->NhapTimKiem . '%')
            ->orwhere('Id', 'like', '%' . $request->NhapTimKiem . '%')
            ->paginate(5);
        return View($this->viewprefix . 'ordermanagement', ['don_hang' => $don_hang]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Book;
use App\Models\Account;
use App\Models\OrderDetail;

class DashboardController extends Controller
{

    public function index()
    {

        $ngay = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $don_hang = Order::where([['Ngay_Lap', '>=', $ngay], ['Trang_Thai', '<>', 4]])->get();
        $ctdh = OrderDetail::where('Id', 0);
        $sldh = 0;
        $ttdh = 0;
        if ($don_hang != null) {
            foreach ($don_hang as $order) {
                $sldh = $sldh + 1;
                $ttdh = $ttdh + $order->Tong_Tien;
                $ctdh = $ctdh->orwhere('Id_DH', $order->Id);
            }
        }
        $ctdh = $ctdh->get();
        $sum = 0;
        if ($ctdh != null) {
            foreach ($ctdh as $ct) {
                $sum = $sum + $ct->So_Luong;
                $count = 0;
                foreach ($ctdh as $ct1) {
                    if ($ct1->Id_Sach == $ct->Id_Sach) {
                        $count = $count + $ct1->So_Luong;
                    }
                }
                $ct->So_Luong = $count;
            }
        }
        $idsachbc = 0;
        $ctdh->groupBy('Id_Sach');
        foreach ($ctdh->sortByDesc('So_Luong')->take(1) as $ct2) {
            $idsachbc = $ct2->Id_Sach;
        }
        $sach = Book::find($idsachbc);
        $newuser = Account::where([['created_at', '>=', $ngay], ['Loai_TK', '=', 1]])->get();
        $user = $newuser->count();
        //biểu đồ doanh thu tháng
        $tuan1 = 0;
        $tuan2 = 0;
        $tuan3 = 0;
        $tuan4 = 0;
        $start = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $bdtuan1 = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->addDays(7)->toDateString();
        $bdtuan2 = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->addDays(15)->toDateString();
        $bdtuan3 = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->addDays(23)->toDateString();
        $don_hang3 = Order::where([['Ngay_Lap', '>=', $start], ['Trang_Thai', '<>', 4]])->get();
        foreach ($don_hang3 as $order) {
            if ($order->Ngay_Lap <= $bdtuan1) {
                $tuan1 = $tuan1 + $order->Tong_Tien;
            } else if ($order->Ngay_Lap <= $bdtuan2) {
                $tuan2 = $tuan2 + $order->Tong_Tien;
            } else if ($order->Ngay_Lap <= $bdtuan3) {
                $tuan3 = $tuan3 + $order->Tong_Tien;
            } else {
                $tuan4 = $tuan4 + $order->Tong_Tien;
            }
        }
        $total = (['sum' => $sum, 'sldh' => $sldh, 'user' => $user, 'ttdh' => $ttdh, 'sach' => $sach, 'tuan1' => $tuan1, 'tuan2' => $tuan2, 'tuan3' => $tuan3, 'tuan4' => $tuan4,]);
        //
        //Lấy danh sách sản phẩm bán chạy
        $ngaybd = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $don_hang1 = Order::where([['Ngay_Lap', '>=', $ngaybd], ['Trang_Thai', '<>', 4]])->get();
        $ctdh1 = OrderDetail::where('Trang_Thai', 0);
        if ($don_hang1 != null) {
            foreach ($don_hang1 as $order) {
                $ctdh1 = $ctdh1->orwhere('Id_DH', $order->Id);
            }
            $ctdh1 = $ctdh1->groupBy('Id_Sach')->get();
            $ctdh2 = OrderDetail::where('Trang_Thai', 0);
            foreach ($don_hang1 as $order) {
                $ctdh2 = $ctdh2->orwhere('Id_DH', $order->Id);
            }
            $ctdh2 = $ctdh2->get();
            foreach ($ctdh1 as $slsach) {
                $count1 = 0;
                foreach ($ctdh2 as $sp) {
                    if ($sp->Id_Sach == $slsach->Id_Sach) {
                        $count1 = $count1 + $sp->So_Luong;
                    }
                }
                $slsach->So_Luong = $count1;
            }
        }
        //return dd($tuan4);
        return view('admin.pages.dashboard', ['ctdh1' => $ctdh1])->with($total);
    }


    public function create() {}


    public function store(Request $request) {}


    public function show($id) {}


    public function edit($id) {}


    public function update(Request $request, $id) {}


    public function destroy($id) {}
}

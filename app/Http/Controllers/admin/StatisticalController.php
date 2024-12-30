<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Account;
use App\Models\Book;
use App\Models\News;
use Carbon\Carbon;

class StatisticalController extends Controller
{

    public function index()
    {

        $check = false;
        $thong_ke = (['check' => $check]);
        return View('admin.pages.statistical', $thong_ke);
    }

    public function result(Request $request)
    {
        $check = false;
        $ngay_bat_dau = $request['StartDay'];
        $ngay_ket_thuc = Carbon::parse($request['EndDay'])->addDays(1);
        if ($ngay_bat_dau != null && $ngay_ket_thuc != null) $check = true;

        // Tính toán
        // Số lượng khách hàng mới
        $kh = Account::where([['created_at', '>=', $ngay_bat_dau], ['created_at', '<', $ngay_ket_thuc], ['is_deleted', '<>', 1]])->get();
        $kh_moi = $kh->count();
        // Số lượng sách mới
        $sach = Book::where([['created_at', '>=', $ngay_bat_dau], ['created_at', '<', $ngay_ket_thuc], ['is_deleted', '<>', 1]])->get();
        $sach_moi = $sach->count();
        // Số lượng tin tức mới
        $tt = News::where([['created_at', '>=', $ngay_bat_dau], ['created_at', '<', $ngay_ket_thuc]])->get();
        $tt_moi = $tt->count();
        //Số đơn hàng bị hủy
        $ds_don_hang_huy = Order::where([['Ngay_Lap', '>=', $ngay_bat_dau], ['Ngay_Lap', '<', $ngay_ket_thuc], ['Trang_Thai', '=', 4]])->get();
        $dh_huy = $ds_don_hang_huy->count();
        //Số đơn hàng đã hoàn thành
        $ds_don_hang_ht = Order::where([['Ngay_Lap', '>=', $ngay_bat_dau], ['Ngay_Lap', '<', $ngay_ket_thuc], ['Trang_Thai', '=', 3]])->get();
        $dh_ht = $ds_don_hang_ht->count();
        //Số đơn hàng đang thực hiện
        $ds_don_hang_dth = Order::where([['Ngay_Lap', '>=', $ngay_bat_dau], ['Ngay_Lap', '<', $ngay_ket_thuc], ['Trang_Thai', '<=', 2]])->get();
        $dh_dth = $ds_don_hang_dth->count();
        // Doanh thu
        $ds_don_hang = Order::where([['Ngay_Lap', '>=', $ngay_bat_dau], ['Ngay_Lap', '<', $ngay_ket_thuc], ['Trang_Thai', '<>', 4]])->get();
        $doanh_thu = 0;
        foreach ($ds_don_hang as $order) {
            $doanh_thu = $doanh_thu + $order->Tong_Tien;
        }
        // Sách bán chạy nhất - kèm số lượng
        // Lấy chi tiết đơn hàng
        $sl_sach_ban_chay = 0;
        $sach_ban_chay = null;
        $ctdh1 = OrderDetail::where('Id', 0);
        if ($ds_don_hang->count() > 0) {
            foreach ($ds_don_hang as $order) {
                $ctdh1 = $ctdh1->orwhere('Id_DH', $order->Id);
            }
            $ctdh1 = $ctdh1->groupBy('Id_Sach')->get();
            $ctdh2 = OrderDetail::where('Id', 0);
            foreach ($ds_don_hang as $order) {
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
            $sl_sach_ban_chay = $ctdh1->max('So_Luong');
            foreach ($ctdh1->sortByDesc('So_Luong') as $ct) {
                $sach_ban_chay = Book::find($ct->Id_Sach);
                break;
            }
        }
        // Biểu đồ doanh thu
        $bd_doanh_thu = [];
        $vt = 0;
        $bddt = Order::where([['Ngay_Lap', '>=', $ngay_bat_dau], ['Ngay_Lap', '<', $ngay_ket_thuc], ['Trang_Thai', '<>', 4]])->groupBy('Ngay_Lap')->get();
        if ($bddt->count() > 0) {
            foreach ($bddt as $dt) {
                $bd_doanh_thu[$vt] = (['ngay' => Carbon::parse($dt->Ngay_Lap)->toDateString(), 'tien' => $dt->Tong_Tien]);
                $vt++;
            }
        }
        // Lấy danh sách ngày
        $bd_ngay = [];
        $i = 0;
        $ngay = Carbon::parse($ngay_bat_dau);
        for ($ngay; $ngay < $ngay_ket_thuc; $ngay) {
            $bd_ngay[$i] = (['ngay' => $ngay->toDateString(), 'tien' => 0]);
            $ngay->addDays(1);
            $i++;
        }

        for ($a = 0; $a < $i; $a++) {
            for ($b = 0; $b < $vt; $b++) {
                if ($bd_ngay[$a]['ngay'] == $bd_doanh_thu[$b]['ngay']) {
                    $bd_ngay[$a]['tien'] = $bd_ngay[$a]['tien'] + $bd_doanh_thu[$b]['tien'];
                }
            }
        }
        $thong_ke = (['check' => $check, 'kh_moi' => $kh_moi, 'dh_huy' => $dh_huy, 'dh_ht' => $dh_ht, 'dh_dth' => $dh_dth, 'doanh_thu' => $doanh_thu, 'sl_sach_ban_chay' => $sl_sach_ban_chay, 'sach_ban_chay' => $sach_ban_chay, 'ngay_bat_dau' => $ngay_bat_dau, 'ngay_ket_thuc' => $ngay_ket_thuc, 'tt_moi' => $tt_moi, 'sach_moi' => $sach_moi, 'bd_ngay' => $bd_ngay, 'i' => $i]);
        return View('admin.pages.statistical', $thong_ke);
        //return dd($bd_ngay);
    }

    public function create() {}


    public function store(Request $request) {}


    public function show($id) {}


    public function edit($id) {}


    public function update(Request $request, $id) {}


    public function destroy($id) {}
}

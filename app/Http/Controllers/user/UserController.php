<?php

namespace App\Http\Controllers\user;

use App\Models\Book;
use App\Models\Category;
use App\Models\ImageBook;
use App\Models\PublishingHouse;
use App\Models\Promotion;
use App\Models\Comment;
use App\Models\DetailPromotion;
use App\Models\News;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Carbon\Carbon;
use App\Models\Cart;

class UserController extends Controller
{

    public function __construct()
    {
        $this->viewprefix = 'user.pages.';
        $this->viewnamespace = 'user/';
    }
    public function Index()
    {
        $sach_moi = Book::where('is_deleted', 0)->orderBy('created_at', 'desc')->take(8)->get();
        $ngay = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $ngaybd = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $don_hang = Order::where([['Ngay_Lap', '>=', $ngaybd], ['Trang_Thai', '<>', 4]])->get();
        $id_sach = OrderDetail::where('Trang_Thai', 0);
        $tin_tuc = News::orderBy('created_at', 'desc')->take(6)->get();
        foreach ($don_hang as $order) {
            $id_sach = $id_sach->orwhere('Id_DH', $order->Id);
        }
        $id_sach = $id_sach->groupBy('Id_Sach')->get();
        foreach ($id_sach as $sach) {
            $sach->So_Luong = 0;
        }
        foreach ($id_sach as $sach) {
            $ctdh = OrderDetail::all();
            foreach ($ctdh as $ct) {
                if ($ct->Id_Sach == $sach->Id_Sach)
                    $sach->So_Luong = $sach->So_Luong + $ct->So_Luong;
            }
        }
        $sach_ban_chay = Book::where('Id', 0);
        foreach ($id_sach->sortByDesc('So_Luong')->take(8) as $sach) {
            $sach_ban_chay = $sach_ban_chay->orwhere('Id', $sach->Id_Sach);
        }
        $sach_ban_chay = $sach_ban_chay->get();
        //return dd($sach_ban_chay);
        return view($this->viewprefix . "index", ['sach_moi' => $sach_moi, 'sach_ban_chay' => $sach_ban_chay, 'tin_tuc' => $tin_tuc]);
    }
    public function Shop(Request $request, $id)
    {
        $sortMoney = "";
        if ($id == 0) {
            $show_book = Book::query();
            if ($request['price']) {

                $price = $request['price'];
                switch ($price) {
                    case 1:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '<=', 100000)->orhaving('Gia_Khuyen_Mai', '<=', 100000)->having('Gia_Khuyen_Mai', '>', 0);
                        break;
                    case 2:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 100000)->having('Gia_Tien', '<=', 200000)->having('Gia_Khuyen_Mai', '==', 0)->orhaving('Gia_Khuyen_Mai', '<=', 200000)->having('Gia_Khuyen_Mai', '>=', 100000);
                        break;
                    case 3:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 200000)->having('Gia_Tien', '<=', 300000)->having('Gia_Khuyen_Mai', '==', 0)->orhaving('Gia_Khuyen_Mai', '<=', 300000)->having('Gia_Khuyen_Mai', '>=', 200000);
                        break;
                    case 4:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 300000)->having('Gia_Khuyen_Mai', '==', 0)->orhaving('Gia_Khuyen_Mai', '>=', 300000);
                        break;
                    default:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 0);
                        break;
                }
            }
            if ($request['search']) {
                $search = $request['search'];
                $show_book = $show_book->groupby('Id')->having('Ten_Sach', 'like', '%' . $search . '%');
            }
            if ($request['orderby']) {
                $orderby = $request['orderby'];
                switch ($orderby) {
                    case 'new':
                        $show_book = $show_book->orderBy('created_at', 'desc');
                        break;
                    case 'old':
                        $show_book = $show_book->orderBy('created_at', 'asc');
                        break;
                    case 'asc':
                        $sortMoney = "asc";
                        break;
                    case 'des':
                        $sortMoney = "des";
                        break;
                    default:
                        $show_book = $show_book->orderBy('created_at', 'desc');
                        break;
                }
            }
        } else {
            $show_book = Book::where('The_Loai', $id);
            if ($request['price']) {

                $price = $request['price'];
                switch ($price) {
                    case 1:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '<=', 100000)->orhaving('Gia_Khuyen_Mai', '<=', 100000)->having('Gia_Khuyen_Mai', '>', 0);
                        break;
                    case 2:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 100000)->having('Gia_Tien', '<=', 200000)->having('Gia_Khuyen_Mai', '==', 0)->orhaving('Gia_Khuyen_Mai', '<=', 200000)->having('Gia_Khuyen_Mai', '>=', 100000);
                        break;
                    case 3:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 200000)->having('Gia_Tien', '<=', 300000)->having('Gia_Khuyen_Mai', '==', 0)->orhaving('Gia_Khuyen_Mai', '<=', 300000)->having('Gia_Khuyen_Mai', '>=', 200000);
                        break;
                    case 4:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 300000)->having('Gia_Khuyen_Mai', '==', 0)->orhaving('Gia_Khuyen_Mai', '>=', 300000);
                        break;
                    default:
                        $show_book =  $show_book->groupby('Id')->having('Gia_Tien', '>=', 0);
                        break;
                }
            }
            if ($request['search']) {
                $search = $request['search'];
                $show_book = $show_book->groupby('Id')->having('Ten_Sach', 'like', '%' . $search . '%');
            }
            if ($request['orderby']) {
                $orderby = $request['orderby'];
                switch ($orderby) {
                    case 'new':
                        $show_book = $show_book->orderBy('created_at', 'desc');
                        break;
                    case 'old':
                        $show_book = $show_book->orderBy('created_at', 'asc');
                        break;
                    case 'asc':
                        $sortMoney = "asc";
                        break;
                    case 'des':
                        $sortMoney = "des";
                        break;
                    default:
                        $show_book = $show_book->orderBy('created_at', 'desc');
                        break;
                }
            }
        }
        if ($sortMoney == "asc") {
            $show_book = $show_book->where('is_deleted', 0)->groupby('Id')->paginate(12);
            $show_book = $this->SortAsc($show_book);
        } else if ($sortMoney == "des") {
            $show_book = $show_book->where('is_deleted', 0)->groupby('Id')->paginate(12);
            $show_book = $this->SortDesc($show_book);
        } else
            $show_book = $show_book->where('is_deleted', 0)->groupby('Id')->paginate(12);

        $cate = ['id' => $id];
        return view($this->viewprefix . 'shop', compact('show_book'), $cate);
        //return response()->json('Thành công');
    }

    function SortAsc($array)
    {
        $array_size = count($array);
        for ($i = 0; $i < $array_size; $i++) {
            for ($j = 0; $j < $array_size; $j++) {
                if ($array[$i]->Gia_Khuyen_Mai == 0 && $array[$j]->Gia_Khuyen_Mai == 0) {
                    if ($array[$i]->Gia_Tien < $array[$j]->Gia_Tien) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                } else if ($array[$i]->Gia_Khuyen_Mai != 0 && $array[$j]->Gia_Khuyen_Mai == 0) {
                    if ($array[$i]->Gia_Khuyen_Mai < $array[$j]->Gia_Tien) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                } else if ($array[$i]->Gia_Khuyen_Mai == 0 && $array[$j]->Gia_Khuyen_Mai != 0) {
                    if ($array[$i]->Gia_Tien < $array[$j]->Gia_Khuyen_Mai) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                } else if ($array[$i]->Gia_Khuyen_Mai != 0 && $array[$j]->Gia_Khuyen_Mai != 0) {
                    if ($array[$i]->Gia_Khuyen_Mai < $array[$j]->Gia_Khuyen_Mai) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                }
            }
        }
        return $array;
    }

    function SortDesc($array)
    {
        $array_size = count($array);
        for ($i = 0; $i < $array_size; $i++) {
            for ($j = 0; $j < $array_size; $j++) {
                if ($array[$i]->Gia_Khuyen_Mai == 0 && $array[$j]->Gia_Khuyen_Mai == 0) {
                    if ($array[$i]->Gia_Tien > $array[$j]->Gia_Tien) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                } else if ($array[$i]->Gia_Khuyen_Mai != 0 && $array[$j]->Gia_Khuyen_Mai == 0) {
                    if ($array[$i]->Gia_Khuyen_Mai > $array[$j]->Gia_Tien) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                } else if ($array[$i]->Gia_Khuyen_Mai == 0 && $array[$j]->Gia_Khuyen_Mai != 0) {
                    if ($array[$i]->Gia_Tien > $array[$j]->Gia_Khuyen_Mai) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                } else if ($array[$i]->Gia_Khuyen_Mai != 0 && $array[$j]->Gia_Khuyen_Mai != 0) {
                    if ($array[$i]->Gia_Khuyen_Mai > $array[$j]->Gia_Khuyen_Mai) {
                        $tem = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tem;
                    }
                }
            }
        }
        return $array;
    }

    public function Contact()
    {
        return view($this->viewprefix . 'contact');
    }

    public function Promotion(Request $request)
    {
        $promotion = Promotion::where('Trang_Thai', 0)->where('is_deleted', 0)->orderBy('Id', 'desc')->first();
        if ($promotion != null) {
            $detail = DetailPromotion::where('Id_Khuyen_Mai', $promotion->Id)->where('Kich_Hoat', 0)->get();
            $book = Book::where('Id', '=', 0);
            foreach ($detail as $detailpromotion) {
                $book = $book->orwhere('The_Loai', '=', $detailpromotion->Id_The_Loai);
            }
            if ($request['price']) {
                $price = $request['price'];
                switch ($price) {
                    case 1:
                        $book = $book->groupby('Id')->having('Gia_Khuyen_Mai', '>=', 0)->having('Gia_Khuyen_Mai', '<=', 100000);
                        break;
                    case 2:
                        $book = $book->groupby('Id')->having('Gia_Khuyen_Mai', '>=', 100000)->having('Gia_Khuyen_Mai', '<=', 200000);
                        break;
                    case 3:
                        $book = $book->groupby('Id')->having('Gia_Khuyen_Mai', '>=', 200000)->having('Gia_Khuyen_Mai', '<=', 300000);
                        break;
                    case 4:
                        $book = $book->groupby('Id')->having('Gia_Khuyen_Mai', '>=', 300000);
                        break;
                    default:
                        $book = $book->groupby('Id')->having('Gia_Khuyen_Mai', '>=', 0);
                        break;
                }
            }
            if ($request['category']) {
                $cate = $request['category'];
                if ($cate == 0) $book = $book;
                else
                    $book = $book->groupby('Id')->having('The_Loai', '=', $cate);
            }
            if ($request['search']) {
                $search = $request['search'];
                $book = $book->groupby('Id')->having('Ten_Sach', 'like', '%' . $search . '%');
            }
            if ($request['orderby']) {
                $orderby = $request['orderby'];
                switch ($orderby) {
                    case 'new':
                        $book = $book->orderBy('created_at', 'desc');
                        break;
                    case 'old':
                        $book = $book->orderBy('created_at', 'asc');
                        break;
                    case 'asc':
                        $book = $book->orderBy('Gia_Khuyen_Mai', 'asc');
                        break;
                    case 'des':
                        $book = $book->orderBy('Gia_Khuyen_Mai', 'desc');
                        break;
                    default:
                        $book = $book->orderBy('created_at', 'desc');
                        break;
                }
            }
            $book = $book->groupby('Id')->having('is_deleted', 0)->paginate(12);
            return view($this->viewprefix . "promotion", $promotion, ['book' => $book]);
        } else {
            $errors = new MessageBag(['error' => ["Hiện không có chương trình khuyến mãi!"]]);
            return view($this->viewprefix . "error")->withErrors($errors);
        }
    }

    public function Single($book_id)
    {

        //lấy thông tin sách chi tiết
        $sach = Book::where('Id', $book_id)->where('Trang_Thai', 2)->first();
        //

        //lấy thông tin thể loại/ nhà xuất bản
        $thong_tin_sach = Book::where('Id', $book_id)->where('Trang_Thai', 2)->get();
        //sách liên quan
        $sach_tuong_tu = Book::where('The_Loai', $sach->The_Loai)->where('Trang_Thai', 2)->whereNotIn('Id', [$book_id])->get();
        $comments = Comment::where('Id_Sach', $book_id)->where('Trang_Thai', 1)->get();
        //lấy danh sách ảnh
        $anh_sach = ImageBook::where([['Id_Sach', '=', $book_id], ['Trang_Thai', '=', 0]])->get();
        return view($this->viewprefix . 'single', $sach, ['thong_tin_sach' => $thong_tin_sach, 'sach_tuong_tu' => $sach_tuong_tu, 'comments' => $comments, 'anh_sach' => $anh_sach]);
        //return view($this->user."single");
    }
    public function About()
    {
        return view($this->viewprefix . 'about');
    }

    public function News()
    {
        $tin_tuc = News::where('Id', '<>', 0)->orderBy('created_at', 'desc')->paginate(6);
        return view($this->viewprefix . 'news', ['tin_tuc' => $tin_tuc]);
    }

    public function NewsDetail($id)
    {
        $tin_tuc = News::find($id);
        return view($this->viewprefix . 'newsdetail', $tin_tuc);
    }

    public function showCart()
    {
        if (Cookie::get('UserId') != null) {
            $gio_hang = Cart::where('Id_TK', Cookie::get('UserId'))->get();
            return view($this->viewprefix . "cart", ['gio_hang' => $gio_hang]);
        } else {
            $errors = new MessageBag(['error' => ["Bạn chưa đăng nhập. Vui lòng đăng nhập để xem giỏ hàng!"]]);
            return view($this->viewprefix . "error")->withErrors($errors);
        }
    }
    public function saveCart(Request $request)
    {
        $Id = $request->bookid_hidden;
        $So_Luong = $request->qty;
        $book_info = Book::where('Id', $Id)->where('Trang_Thai', 2)->first();

        $data['id'] = $book_info->Id;
        $data['qty'] = $So_Luong;
        $data['name'] = $book_info->Ten_Sach;
        $data['price'] = $book_info->Gia_Tien;
        $data['weight'] = $book_info->Gia_Tien;
        $data['options']['image'] = $book_info->Anh_Bia;
        Cart::add($data);


        return redirect()->route('gio-hang');
    }
    public function deleteCart($rowId) {}
    public function updateCart(Request $request) {}
    public function checkout()
    {
        return view($this->viewprefix . "checkout");
    }
    public function postComment($id, Request $request)
    {
        $comment = new Comment;
        $comment->Noi_Dung = $request->Noi_Dung;
        $comment->Id_Sach = $id;
        $comment->Trang_Thai = $request->Trang_Thai;
        $comment->Id_TK = Cookie::get('UserId');
        $comment->save();
        return back();
    }
    public function bookSearch(Request $request)
    {
        $tim_kiem = $request->search;

        $search_book = Book::where([['Ten_Sach', 'like', '%' . $tim_kiem . '%'], ['is_deleted', '=', '0']])
            ->orwhere([['Tac_Gia', 'like', '%' . $tim_kiem . '%'], ['is_deleted', '=', '0']])
            ->orwhere([['Gia_Tien', 'like', '%' . $tim_kiem . '%'], ['is_deleted', '=', '0']])
            ->paginate('12');
        return view($this->viewprefix . 'search', compact('search_book'));
    }

    public function countCart()
    {
        $gio_hang = Cart::where('Id_TK', Cookie::get('UserId'))->get();
        $so_luong = 0;
        if ($gio_hang != null) {
            foreach ($gio_hang as $cart) {
                $so_luong = $so_luong + $cart->So_Luong;
            }
        }
        return response()->json($so_luong);
    }

    public function getSuggestion()
    {
        $don_hang = Order::where('Id_KH', Cookie::get('UserId'))->orderBy('Ngay_Lap', 'desc')->having('Trang_Thai', '<>', 4)->first();
        if ($don_hang != null) {
            $ct_dh = OrderDetail::where('Id_DH', $don_hang->Id)->get();
            $goi_y_sach = Book::where('Id', 0);
            foreach ($ct_dh as $ct) {
                $sach = Book::find($ct->Id_Sach);
                $goi_y_sach = $goi_y_sach->orwhere('The_Loai', '=', $sach->The_Loai);
            }
            $goi_y_sach = $goi_y_sach->groupby('Id')->having('is_deleted', 0)->take(10)->get();
            return response()->json($goi_y_sach->toArray());
        } else {
            $goi_y_sach = Book::where('is_deleted', 0)->orderBy('created_at', 'desc')->take(10)->get();
            return response()->json($goi_y_sach->toArray());
        }
    }
}

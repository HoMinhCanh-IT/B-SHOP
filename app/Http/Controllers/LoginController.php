<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Account;
use DB;
use Cookie;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    //
    public function index()
    {
        //
        return View('Login.Login');
    }


    public function login(Request $request){
        $email = $request->email;
        $pass = $request->password;
        $account = Account::where('Email', $email)->get();
        if ($account->count() != 0)
        {
            foreach ($account as $item)
            {
                $id = $item->Id;
                $mk = $item->Mat_Khau;
                $tk = $item->Email;
                $loaitk = $item->Loai_TK;
                $tt = $item->Trang_Thai;
                $is_deleted = $item->is_deleted;
            }
            if (Hash::check($pass, $mk) && $loaitk == 0 && $is_deleted == 0)
            {
                if ($tt != 0)
                {
                    $errors = new MessageBag(['login' => ["Tài khoản chưa kích hoạt!"]]);
                    return redirect()->route('loginview')->withErrors($errors);
                }
                else {
                    Cookie::queue('AdminEmail', $tk, 14400);
                    return redirect()->route('dashboard.index');
                }
            }
            else if (Hash::check($pass, $mk) && $loaitk == 1 && $is_deleted == 0)
            {
                if ($tt != 0)
                {
                    $errors = new MessageBag(['login' => ["Tài khoản chưa kích hoạt!"]]);
                    return redirect()->route('loginview')->withErrors($errors);
                }
                else
                {
                    Cookie::queue('UserId', $id, 14400);
                    return redirect()->route('user.index');
                }
            }
            else 
            {
                $errors = new MessageBag(['login' => ["Tài khoản hoặc mật khẩu không đúng!"]]);
                return redirect()->route('loginview')->withErrors($errors);
            }
        }
        else 
        {
            $errors = new MessageBag(['login' => ["Tài khoản hoặc mật khẩu không đúng!"]]);
            return redirect()->route('loginview')->withErrors($errors);
        }
    }

    public function register(Request $request){
        $email = $request->regEmail;
        $pass = $request->regPassword;
        $account = Account::where([ ['Email', '=', $email], ['is_deleted', '=', 0] ])->get();
        if ($account->count() == 0)
        {
            $tai_khoan = Account::create([
                'Email'=> $email,
                'Mat_Khau'=> Hash::make($pass),
                'Loai_TK'=> 1,
                'Trang_Thai'=> 0
            ]);
            $errors = new MessageBag(['loginsuccess' => ["Đăng ký thành công!"]]);
            return redirect()->route('loginview')->withErrors($errors);
        }
        else 
        {
            $errors = new MessageBag(['login' => ["Tài khoản đã tồn tại!"]]);
            return redirect()->route('loginview')->withErrors($errors);
        }
    }
    
    public function logoutAd(Request $request){
        Cookie::queue(Cookie::forget('AdminEmail'));
        return redirect()->route('loginview');
    }

    public function logoutUser(Request $request){
        Cookie::queue(Cookie::forget('UserId'));
        return redirect()->route('loginview');
    }
}

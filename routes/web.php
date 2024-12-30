<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatisticalController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PublishingController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\LoginController;



Route::get('/quan-ly-tai-khoan', [AccountController::class, 'index'])->name('user.account');
Route::post('/them-sach-yeu-thich', [AccountController::class, 'addfavoritebook'])->name('user.accountheart');
Route::post('/doi-mat-khau', [AccountController::class, 'changepass'])->name('user.accountpass');
Route::post('/xoa-sach-yeu-thich', [AccountController::class, 'deletefavoritebook'])->name('user.deleteheart');
Route::post('/cap-nhat-thong-tin/{id}', [AccountController::class, 'updateinfomation'])->name('user.updateinfomation');
Route::post('/cua-hang/loc-san-pham/{Id?}', [UserController::class, 'ShopQuery'])->name('user.shopquery');
Route::post('/gui-lien-he', [AccountController::class, 'mailcontact'])->name('user.mailcontact');

// Giỏ hàng
Route::post('/them-gio-hang', [AccountController::class, 'addcart'])->name('account.addcart');
Route::get('/gio-hang', [UserController::class, 'showCart'])->name('user.cart');
Route::get('/cart', [UserController::class, 'countCart'])->name('user.cartcount');
Route::get('/xoa-gio-hang/{Id?}', [AccountController::class, 'deletecart'])->name('account.cartdelete');
Route::post('/cap-nhat-gio-hang', [AccountController::class, 'updatecart'])->name('account.updatecart');

// Thanh toán
Route::post('/thanh-toan', [AccountController::class, 'payment'])->name('account.payment');
Route::get('/thanh-toan-gio-hang', [AccountController::class, 'paymentcart'])->name('account.paymentcart');
Route::post('/thanh-toan-gio-hang', [AccountController::class, 'createpaymentcart'])->name('account.createpaymentcart');
Route::post('/thanh-toan-nhanh', [AccountController::class, 'createpaymentquick'])->name('account.createpaymentquick');

// Chi tiết đơn hàng
Route::get('/chi-tiet-don-hang/{Id?}', [AccountController::class, 'orderdetail'])->name('account.orderdetail');
Route::get('/huy-don-hang/{Id?}', [AccountController::class, 'cancelorder'])->name('account.cancelorder');

// Lấy sản phẩm gợi ý
Route::get('/goi-y', [UserController::class, 'getSuggestion'])->name('user.getsuggestion');

// Đăng nhập và đăng ký
Route::post('/dang-nhap', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logoutAd'])->name('logoutAd');
Route::get('/dang-xuat', [LoginController::class, 'logoutUser'])->name('logoutUser');
Route::get('/dang-nhap', [LoginController::class, 'index'])->name('loginview');
Route::post('/dang-ky', [LoginController::class, 'register'])->name('register');

Route::group(['prefix' => '', 'namespace' => 'user'], function () {
    Route::get('/', [UserController::class, 'Index'])->name('user.index');
    Route::get('/cua-hang/{Id?}', [UserController::class, 'Shop'])->name('user.shop');
    Route::get('/lien-he', [UserController::class, 'Contact'])->name('user.contact');
    Route::get('/chi-tiet-san-pham/{book_id?}', [UserController::class, 'Single'])->name('user.single');
    Route::get('/ve-chung-toi', [UserController::class, 'About'])->name('user.about');
    Route::get('/tin-tuc', [UserController::class, 'News'])->name('user.news');
    Route::get('/chi-tiet-tin-tuc/{Id?}', [UserController::class, 'NewsDetail'])->name('user.newsdetail');
    Route::get('/thanh-toan', [UserController::class, 'checkout'])->name('thanh-toan');
    Route::get('/khuyen-mai', [UserController::class, 'Promotion'])->name('user.promotion');
    Route::get('/tim-kiem', [UserController::class, 'bookSearch'])->name('tim-kiem');
    Route::post('/chi-tiet-san-pham/{id}', [UserController::class, 'postComment']);
});

Route::group(['middleware' => ['checklogin']], function () {
    Route::resource('admin/dashboard', DashboardController::class);
    Route::resource('admin/statistical', StatisticalController::class);
    Route::post('/admin/statistical/result', [StatisticalController::class, 'result'])->name('statistical.result');

    // Quản lý sách
    Route::resource('admin/book', BookController::class);
    Route::post('/admin/book/create', [BookController::class, 'store'])->name('book.store');
    Route::post('/admin/book/addimage', [BookController::class, 'addimage'])->name('book.addimage');
    Route::post('/admin/book/{id}/update', [BookController::class, 'update'])->name('book.update');
    Route::post('/admin/book/editimage', [BookController::class, 'editimage'])->name('book.editimage');
    Route::post('/admin/book', [BookController::class, 'search'])->name('book.search');
    Route::get('/admin/book/{id}/delete', [BookController::class, 'delete'])->name('book.delete');
    Route::get('/admin/book/{id}/deleteimage', [BookController::class, 'deleteimage'])->name('book.deleteimage');

    // Quản lý tài khoản
    Route::resource('admin/account', AdminAccountController::class);
    Route::post('/admin/account/create', [AdminAccountController::class, 'store'])->name('account.store');
    Route::post('/admin/account', [AdminAccountController::class, 'search'])->name('account.search');
    Route::post('/admin/account/{id}/update', [AdminAccountController::class, 'update'])->name('account.update');
    Route::get('/admin/account/{id}/delete', [AdminAccountController::class, 'delete'])->name('account.delete');

    // Quản lý đơn hàng
    Route::resource('admin/order', OrderController::class);
    Route::post('/admin/order/search', [OrderController::class, 'search'])->name('order.search');

    // Quản lý bình luận
    Route::resource('admin/comment', CommentController::class);
    Route::post('/admin/comment/search', [CommentController::class, 'search'])->name('comment.search');

    // Quản lý nhà xuất bản
    Route::resource('admin/publishing', PublishingController::class);
    Route::post('/admin/publishing/search', [PublishingController::class, 'search'])->name('publishing.search');

    // Quản lý khuyến mãi
    Route::resource('admin/promotion', PromotionController::class);
    Route::post('/admin/promotion/create', [PromotionController::class, 'store'])->name('promotion.store');
    Route::post('/admin/promotion/{id}/update', [PromotionController::class, 'update'])->name('promotion.update');
    Route::post('/admin/promotion', [PromotionController::class, 'search'])->name('promotion.search');
    Route::get('/admin/promotion/{id}/delete', [PromotionController::class, 'delete'])->name('promotion.delete');
    Route::post('/admin/promotion/addpromotiondetail', [PromotionController::class, 'addpromotiondetail'])->name('promotion.addpromotiondetail');
    Route::post('/admin/promotion/editpromotiondetail', [PromotionController::class, 'editpromotiondetail'])->name('promotion.editpromotiondetail');
    Route::get('/admin/promotion/{id}/delpromotiondetail', [PromotionController::class, 'delpromotiondetail'])->name('promotion.delpromotiondetail');

    // Quản lý tin tức
    Route::resource('admin/news', NewsController::class);
    Route::post('/admin/news/create', [NewsController::class, 'store'])->name('news.store');
    Route::post('/admin/news/{id}/update', [NewsController::class, 'update'])->name('news.update');
    Route::get('/admin/news/{id}/delete', [NewsController::class, 'delete'])->name('news.delete');
    Route::post('/admin/news', [NewsController::class, 'search'])->name('news.search');
});
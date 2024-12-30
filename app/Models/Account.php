<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table='tai_khoan';
    protected $primaryKey = 'Id';
    protected $fillable =[
        'Ho_Ten',
        'Gioi_Tinh',
        'Mat_Khau',
        'Email',
        'So_Dien_Thoai',
        'Dia_Chi',
        'Loai_TK',
        'Anh_Dai_Dien',
        'Trang_Thai',
        'is_deleted'
    ];
}

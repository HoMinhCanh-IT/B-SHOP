<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table='khuyen_mai';
    protected $primaryKey = 'Id';
    protected $fillable =[
        'Ten_CTKM',
        'Banner',
        'Tg_Bat_Dau',
        'Tg_Ket_Thuc',
        'Noi_Dung',
        'Link_Chi_Tiet',
        'Trang_Thai',
    ];
}

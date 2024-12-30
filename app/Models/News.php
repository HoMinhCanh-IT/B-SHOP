<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table='tin-tuc';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Tieu_De',
        'Chu_De',
        'Hinh_Anh',
        'Noi_Dung',
        'Trang_Thai',
    ];
}

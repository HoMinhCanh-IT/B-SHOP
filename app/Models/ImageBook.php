<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageBook extends Model
{
    use HasFactory;
    protected $table='anh_sach';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Anh_Sach',
        'Id_Sach',
        'Loai_Anh',
        'Trang_Thai',
    ];
}

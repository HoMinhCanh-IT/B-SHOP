<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPromotion extends Model
{
    use HasFactory;
    protected $table='noi_dung_khuyen_mai';
    protected $primaryKey = 'Id';
    protected $fillable =[
        'Id_Khuyen_Mai',
        'Banner',
        'Id_The_Loai',
        'Gia_Tri_Khuyen_Mai',
        'Kich_Hoat',
    ];

    public function TheLoai(){
        return $this->belongsTo('App\Models\Category', 'Id_The_Loai', 'Id');
    }
}

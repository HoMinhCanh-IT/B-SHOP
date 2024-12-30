<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table='sach';
    protected $primaryKey = 'Id';
    protected $fillable =[
        'Ten_Sach',
        'Nha_Xuat_Ban',
        'Tac_Gia',
        'Anh_Bia',
        'Phien_Ban',
        'Loai_Bia',
        'So_Trang',
        'SKU',
        'Gia_Tien',
        'Gia_Khuyen_Mai',
        'Mo_Ta',
        'The_Loai',
        'Trang_Thai',
        'So_Luong',
        'is_deleted'
    ];
    public function NhaXuatBan(){
        return $this->belongsTo('App\Models\PublishingHouse', 'Nha_Xuat_Ban', 'Id');
    }
    public function TheLoai(){
        return $this->belongsTo('App\Models\Category', 'The_Loai', 'Id');
    }
    public function KhuyenMai(){
        return $this->belongsTo('App\Models\DetailPromotion', 'The_Loai', 'Id_The_Loai');
    }
    public function AnhHover(){
        $anh = $this->belongsTo('App\Models\ImageBook', 'Id', 'Id_Sach');
        return $anh->where('Loai_Anh', 1);
    }
    public function Sach(){
        return $this->belongsTo('App\Models\Book', 'Id', 'Id');
    }
}

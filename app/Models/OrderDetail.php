<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='chi_tiet_don_hang';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Id_Sach',
        'Id_DH',
        'So_Luong',
    ];
    public function Sach(){
        return $this->belongsTo('App\Models\Book', 'Id_Sach', 'Id');
    }
    public function NhaXuatBan(){
        return $this->belongsTo('App\Models\PublishingHouse', 'Nha_Xuat_Ban', 'Id');
    }
    public function DonHang(){
        return $this->belongsTo('App\Models\Order', 'Id_DH', 'Id');
    }
}

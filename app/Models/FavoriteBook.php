<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteBook extends Model
{
    use HasFactory;
    protected $table='sach_yeu_thich';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Id_Sach',
        'Id_TK',
        'Trang_Thai',
    ];
    public function Sach(){
        return $this->belongsTo('App\Models\Book', 'Id_Sach', 'Id');
    }
    public function NhaXuatBan(){
        return $this->belongsTo('App\Models\PublishingHouse', 'Nha_Xuat_Ban', 'Id');
    }
}

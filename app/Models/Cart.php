<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='gio_hang';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Id_Sach',
        'Id_TK',
        'So_Luong',
    ];
    public function Sach(){
        return $this->belongsTo('App\Models\Book', 'Id_Sach', 'Id');
    }
    public function NhaXuatBan(){
        return $this->belongsTo('App\Models\PublishingHouse', 'Nha_Xuat_Ban', 'Id');
    }
}

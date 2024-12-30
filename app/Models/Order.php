<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='don_hang';
    protected $primaryKey='Id';
    protected $fillable=[
        'Id_KH',
        'Ngay_Lap',
        'Dia_Chi_Giao_Hang',
        'PT_Thanh_Toan',
        'Tong_Tien',
        'Trang_Thai'
    ];
    public function Account(){
        return $this->belongsTo('App\Models\Account', 'Id_KH', 'Id');
    }
    
    public $timestamps = false;
}

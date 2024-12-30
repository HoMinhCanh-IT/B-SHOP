<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='binh_luan';
    protected $primaryKey='Id';
    protected $fillable=[
        'Id_Sach',
        'Id_TK',
        'Noi_Dung',
        'Thoi_Gian',
        'Trang_Thai',
        'Ten_NBL'

    ];
    public function TaiKhoan(){
        return $this->belongsTo('App\Models\Account', 'Id_TK', 'Id');
    }
    public function Sach(){
        return $this->belongsTo('App\Models\Book', 'Id_Sach', 'Id');
    }
    public function user_info(){
        return $this->hasOne('App\Models\Account','Id','Id_TK');
    }
    public $timestamps = false;

}

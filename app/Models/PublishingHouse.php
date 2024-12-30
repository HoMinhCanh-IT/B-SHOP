<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishingHouse extends Model
{
    use HasFactory;
    protected $table='nha_xuat_ban';
    protected $primaryKey='Id';
    protected $fillable =[
        'Ten_NXB',
        'Dia_Chi',
        'So_Dien_Thoai',
        'Email',
        'Trang_Thai'
    ];
    public $timestamps = false;
}

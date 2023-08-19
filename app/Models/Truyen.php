<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truyen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'truyen';

    protected $fillable = [
        'ten_truyen', 'tac_gia', 'nhom_dich', 'loai_truyen', 'trang_thai',
        'mo_ta', 'bia_truyen', 'ngay_dang'
    ];
    
    public function chap()
    {
        return $this->hasMany(Chap::class, 'id_truyen', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'id_truyen', 'id');
    }

    public function theloai()
    {
        return $this->belongsToMany(The_loai::class, 'truyen_theloai');
    }

    public function store()
    {
        return $this->belongsToMany(Store_truyen::class);
    }

    public function loaitruyen()
    {
        return $this->belongsTo(Loai_truyen::class, 'loai_truyen');
    }
}

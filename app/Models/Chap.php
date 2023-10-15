<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chap extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'chap';

    protected $fillable = [
        'ten_chap','id_truyen','ngay_dang'
    ];

    public function truyen()
    {
        return $this->belongsTo(Truyen::class, 'id_truyen', 'id');
    }

    public function chap_nd()
    {
        return $this->hasMany(Chap_noi_dung::class, 'id_chap', 'id');
    }

    public function errol()
    {
        return $this->hasMany(Chap_Error::class, 'id_chap', 'id');
    }
}

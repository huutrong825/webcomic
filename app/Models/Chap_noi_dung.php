<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chap_noi_dung extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chap_noidung';

    protected $fillable = [
        'id_chap', 'noi_dung'
    ];

    public function chap()
    {
        return $this->belongsTo(Chap::class, 'id_chap', 'id');
    }
}

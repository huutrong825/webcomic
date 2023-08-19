<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trang_thai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trangthai';

    protected $fillable = [
        'trang_thai_truyen',
    ];

}

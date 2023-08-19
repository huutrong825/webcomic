<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info_page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'info_page';

    protected $fillable = [
        'phone', 'email', 'ten_web', 'tieu_de'
    ];
}

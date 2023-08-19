<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class The_loai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'theloai';

    protected $fillable = [
        'the_loai',
    ];

    public function truyen()
    {
        return $this->belongsToMany(Truyen::class, 'truyen_theloai');
    }
}

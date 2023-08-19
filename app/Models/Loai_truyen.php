<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loai_truyen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loai_truyen';

    protected $fillable = [
        'loai_truyen',
    ];

    public function truyen()
    {
        return $this->hasMany(Truyen::class, 'loai_truyen', 'id');
    }
}

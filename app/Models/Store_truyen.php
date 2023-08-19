<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store_truyen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chap_store_truyen';

    protected $fillable = [
        'id_truyen', 'id_viewer'
    ];

    public function truyen()
    {
        return $this->belongsToMany(Truyen::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}

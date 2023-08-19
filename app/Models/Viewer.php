<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viewer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_guests';

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'birth', 'is_active'
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class, 'id_viewer', 'id');
    }

    public function store()
    {
        return $this->belongsToMany(Store_truyen::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chap_Error extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chap_errol';

    protected $fillable = [
        'id_truyenloi', 'id_chap', 'id_viewer', 'mess_loi'
    ];

    public function chap()
    {
        return $this->belongsTo(Chap::class, 'id_chap', 'id');
    }
}

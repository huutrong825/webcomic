<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comment';

    protected $fillable = [
        'id_viewer', 'id_truyen','id_chap', 'noi_dung', 'ngay_dang'
    ];

    public function truyen()
    {
        return $this->belongsTo(Truyen::class, 'id_truyen');
    }

    public function viewer()
    {
        return $this->belongsTo(User::class, 'id_viewer');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Truyen_Theloai extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'truyen_theloai';

    protected $fillable = [
        'id_truyen','id_theloai'
    ];

    protected $dates =['deleted_at'];

    public function theloai()
    {
        return $this->belongsToMany(The_loai::class)->withPivot('the_loai');
    }

}

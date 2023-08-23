<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class media_pengajuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
}

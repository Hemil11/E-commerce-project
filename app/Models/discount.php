<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'limit',
        'discount',
        'is_active'
    ];
}

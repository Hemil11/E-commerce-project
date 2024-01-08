<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_fee extends Model
{
    use HasFactory;
    protected $fillable = [
        'condition',
        'fees',
        'start_price',
        'end_price',
        'check',
    ];
}

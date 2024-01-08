<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userDetails extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'birth_date',
        'address',
        'gender',
        'country',
        'city',
        'postal_code',
    ];
}

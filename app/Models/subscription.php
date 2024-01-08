<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    use HasFactory;
    protected $table ='subscriptions';
    protected $fillable = [
        'user_id',
        'plan_name',
        'status',
        'duration',
        'price',
        'payment_intent',
        'customer_id',
    ];
}

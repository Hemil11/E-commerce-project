<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_variant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'variant_id',
        'variant_value_id',
        'product_id'
    ];

    public function variant_value()
     {
         return $this->hasOne(variant_value::class, 'id', 'variant_value_id');
     }
}

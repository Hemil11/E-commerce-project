<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'categroy_id',
        'description'
     ];
     public function category()
     {
         return $this->hasOne(Category::class, 'id', 'category_id');
     }
     
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

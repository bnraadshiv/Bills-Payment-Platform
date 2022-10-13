<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_name',
        'status',
        'category_id',
        'image',
        'description',
        'apiID',

    ];


    public function category() {

        return $this->belongsTo(Category::class);
    }

    public function product_api() {

        return $this->belongsTo(Product_api::class);
    }


}



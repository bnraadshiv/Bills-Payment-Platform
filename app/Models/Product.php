<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use 
    HasFactory, //For factory
    SoftDeletes; //For soft deletes

    protected $fillable = [

        'name',
        'status',
        'category_id',
        'image',
        'description',
        'apiID',
        'provider_id',
        'serviceID',


    ];

    protected $appends = ['image_url'];

    public function category() {

        return $this->belongsTo(Category::class);
    }

    public function product_api() {

        return $this->belongsTo(Product_api::class, 'apiID');
    }

    public function provider() {

        return $this->belongsTo(provider::class, 'provider_id');
    }


    //returns image URl
    public function getImageUrlAttribute() {

        return url('services/' .$this->image); //create a new field image_url
    }

    //Creates $product->category_name instead of using $product->category->name
    public function getCategoryNameAttribute() { 
        return $this->category->name ?? 'no-category'; //create a new field category_name
    }


    //using Scope
    public function scopeActive($query) {

        return $query->where('status', 'active');

    }


    //Boot method - for anytime the model is called
    public static function boot() {

        parent::boot();

        static::creating(function($model) {

            $model->image = "MTN-Airtime.jpg"; //It will set the default name of the image when its been created
        });


        static::updating(function($model) {

            $model->image = "MTN-Airtime.jpg"; //while udating, it will set the data in that field

        });

    }

}





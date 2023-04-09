<?php

namespace Modules\ProductShowcase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductShowcase\Entities\ProductShowcaseImages;

class ProductShowcase extends Model
{
    use HasFactory;

    protected $table="product_showcase";
    protected $fillable = ['name','description'];
    
    protected static function newFactory()
    {
        return \Modules\ProductShowcase\Database\factories\ProductShowcaseFactory::new();
    }


    public function images()
    {
        return $this->hasMany(ProductShowcaseImages::class, 'product_showcase_id');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($slider) { // before delete() method call this
             $slider->images()->delete();
             // do the rest of the cleanup...
        });
    }

}

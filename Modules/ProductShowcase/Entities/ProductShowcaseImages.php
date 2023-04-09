<?php

namespace Modules\ProductShowcase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductShowcaseImages extends Model
{
    use HasFactory;

    protected $table='product_showcase_images';
    protected $fillable = ['product_showcase_id','image'];
    
    protected static function newFactory()
    {
        return \Modules\ProductShowcase\Database\factories\ProductShowcaseImagesFactory::new();
    }
}

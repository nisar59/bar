<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderImages extends Model
{
    use HasFactory;

    protected $table='slider_images';
    protected $fillable = ['slider_id','image'];
    
    protected static function newFactory()
    {
        return \Modules\Slider\Database\factories\SliderImagesFactory::new();
    }
}

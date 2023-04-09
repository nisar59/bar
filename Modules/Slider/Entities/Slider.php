<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Slider\Entities\SliderImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $table='slider';
    protected $fillable = ['name','description'];
    
    protected static function newFactory()
    {
        return \Modules\Slider\Database\factories\SliderFactory::new();
    }

    public function images()
    {
        return $this->hasMany(SliderImages::class, 'slider_id');
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

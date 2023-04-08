<?php

namespace Modules\Banner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class banner extends Model
{
    use HasFactory;

    protected $fillable = ['heading','sub_heading','link','type','image','background_image','video'];
    protected $table='banner';
    
    protected static function newFactory()
    {
        return \Modules\Banner\Database\factories\BannerFactory::new();
    }
}

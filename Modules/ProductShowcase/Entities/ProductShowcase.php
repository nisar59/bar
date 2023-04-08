<?php

namespace Modules\ProductShowcase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductShowcase extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\ProductShowcase\Database\factories\ProductShowcaseFactory::new();
    }
}

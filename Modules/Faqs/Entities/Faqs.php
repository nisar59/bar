<?php

namespace Modules\Faqs\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faqs extends Model
{
    use HasFactory;

    protected $fillable = ['title','description'];
    protected $table='faqs';
    
    protected static function newFactory()
    {
        return \Modules\Faqs\Database\factories\FaqsFactory::new();
    }
}

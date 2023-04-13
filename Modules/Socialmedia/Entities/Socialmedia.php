<?php

namespace Modules\Socialmedia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Socialmedia extends Model
{
    use HasFactory;

    protected $fillable = ['name','link','icone'];
    protected $table='social_media';
    
    protected static function newFactory()
    {
        return \Modules\Socialmedia\Database\factories\SocialmediaFactory::new();
    }
}

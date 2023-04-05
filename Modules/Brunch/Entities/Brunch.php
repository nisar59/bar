<?php

namespace Modules\Brunch\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brunch extends Model
{
    use HasFactory;

    protected $fillable = ['image','description','link'];
    protected $table='brunch';
    
    protected static function newFactory()
    {
        return \Modules\Brunch\Database\factories\BrunchFactory::new();
    }
}

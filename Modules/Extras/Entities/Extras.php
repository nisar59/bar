<?php

namespace Modules\Extras\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extras extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','price'];
    protected $table='extras';
    
    protected static function newFactory()
    {
        return \Modules\Extras\Database\factories\ExtrasFactory::new();
    }
}

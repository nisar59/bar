<?php

namespace Modules\Caffe\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caffe extends Model
{
    use HasFactory;

    protected $fillable = ['title','file','description','link'];
    protected $table='caffe';
    
    protected static function newFactory()
    {
        return \Modules\Caffe\Database\factories\CaffeFactory::new();
    }
}

<?php

namespace Modules\WeaklyEvents\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeaklyEvents extends Model
{
    use HasFactory;

    protected $fillable = ['image','description'];
    protected $table='wekaly-events';
    
    protected static function newFactory()
    {
        return \Modules\WeaklyEvents\Database\factories\WeaklyEventsFactory::new();
    }
}

<?php

namespace Modules\Events\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;

    protected $fillable = ['event_type','title','event_date','description','image','info_link','ticket_link','facebook_link'];
    protected $table='events';
    
    protected static function newFactory()
    {
        return \Modules\Events\Database\factories\EventsFactory::new();
    }
}

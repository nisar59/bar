<?php

namespace Modules\Reservationstructure\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class reservationstructure extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Reservationstructure\Database\factories\ReservationstructureFactory::new();
    }
}

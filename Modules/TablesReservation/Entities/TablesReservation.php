<?php

namespace Modules\TablesReservation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TablesReservation extends Model
{
    use HasFactory;

    protected $table='table_reservation';
    protected $fillable = ['name','guests','time_from','time_to','price'];
    
    protected static function newFactory()
    {
        return \Modules\TablesReservation\Database\factories\TablesReservationFactory::new();
    }
}

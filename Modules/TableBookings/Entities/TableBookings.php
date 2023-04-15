<?php

namespace Modules\TableBookings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TablesReservation\Entities\TablesReservation;

class TableBookings extends Model
{
    use HasFactory;

    protected $table="table_bookings";
    protected $fillable = ['user_id','table_id','booking_date','payment_status'];
    
    protected static function newFactory()
    {
        return \Modules\TableBookings\Database\factories\TableBookingsFactory::new();
    }

    public function table()
    {
        return $this->hasOne(TablesReservation::class,'id','table_id')->where('status',0);
    }

}

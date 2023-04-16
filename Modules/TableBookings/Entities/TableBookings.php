<?php

namespace Modules\TableBookings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sittings\Entities\Sittings;
use Modules\Sittings\Entities\SittingTables;
use Modules\Extras\Entities\Extras;

class TableBookings extends Model
{
    use HasFactory;

    protected $table="table_bookings";
    protected $fillable = ['user_id','sitting_id','table_id','extras_ids','booking_date','payment_status','status'];
    
    protected $casts = [
       'extras_ids' => 'json',
    ];

    protected static function newFactory()
    {
        return \Modules\TableBookings\Database\factories\TableBookingsFactory::new();
    }

    public function sitting()
    {
        return $this->hasOne(Sittings::class,'id','sitting_id');
    }

    public function table()
    {
        return $this->hasOne(SittingTables::class,'table_id', 'table_id');
    }

    public function extras() 
    {
        if($this->extras_ids==null){
           $this->extras_ids=[]; 
        }
        
        $related = $this->hasMany(Extras::class);
        $related->setQuery(
            Extras::whereIn('id', $this->extras_ids)->getQuery()
        );

        return $related;

    }


}

<?php

namespace Modules\Sittings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sittings\Entities\SittingTables;

class Sittings extends Model
{
    use HasFactory;

    protected $table='sittings';
    protected $fillable = ['name', 'time_from','time_to'];
    
    protected static function newFactory()
    {
        return \Modules\Sittings\Database\factories\SittingsFactory::new();
    }

    public function tables()
    {
        return $this->hasMany(SittingTables::class,'sitting_id', 'id');
    }

}

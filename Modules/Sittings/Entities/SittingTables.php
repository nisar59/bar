<?php

namespace Modules\Sittings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SittingStructure\Entities\StructureTables;

class SittingTables extends Model
{
    use HasFactory;

    protected $table='sitting_tables';
    protected $fillable = ['sitting_id','table_id','price'];
    
    protected static function newFactory()
    {
        return \Modules\Sittings\Database\factories\SittingTablesFactory::new();
    }

    public function table()
    {
        return $this->hasOne(StructureTables::class,'id','table_id');
    }
}

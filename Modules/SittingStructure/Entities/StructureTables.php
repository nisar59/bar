<?php

namespace Modules\SittingStructure\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StructureTables extends Model
{
    use HasFactory;

    protected $table='structure_tables';
    protected $fillable = ['sitting_structure_id','name','guests','status'];
    
    protected static function newFactory()
    {
        return \Modules\SittingStructure\Database\factories\StructureTablesFactory::new();
    }
}

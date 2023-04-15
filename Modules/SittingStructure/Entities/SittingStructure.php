<?php

namespace Modules\SittingStructure\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SittingStructure\Entities\StructureTables;
class SittingStructure extends Model
{
    use HasFactory;

    protected $table='sitting_structure';
    protected $fillable = ['map'];
 
    protected static function newFactory()
    {
        return \Modules\SittingStructure\Database\factories\SittingStructureFactory::new();
    }


    public function tables()
    {
        return $this->hasMany(StructureTables::class,'sitting_structure_id', 'id');
    }

}

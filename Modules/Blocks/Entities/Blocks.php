<?php

namespace Modules\Blocks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blocks extends Model
{
    use HasFactory;

    protected $table="page_blocks";
    protected $fillable = ['page_id','block_name','file_name','data','sort_by'];
    
    protected static function newFactory()
    {
        return \Modules\Blocks\Database\factories\BlocksFactory::new();
    }
}

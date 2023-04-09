<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blocks\Entities\Blocks;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = ['slider_banner_type','slider_banner_id','title','slug','description','status'];
    protected $table='pages';
    protected static function newFactory()
    {
        return \Modules\Pages\Database\factories\PagesFactory::new();
    }

    public function blocks()
    {
        return $this->hasMany(Blocks::class, 'page_id', 'id');
    }

}

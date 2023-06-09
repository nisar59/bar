<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['type','name','page_slug','url'];
    protected $table='menu';
    protected static function newFactory()
    {
        return \Modules\Menu\Database\factories\MenuFactory::new();
    }
}

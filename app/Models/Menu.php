<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $table='user_menu';

    public function subMenu()
    {
        return $this->belongsTo('App\Models\SubMenu',);
    }

}

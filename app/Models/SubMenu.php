<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $table='user_sub_menu';

    public function Menu()
    {
       return $this->belongsTo(Menu::class,'menu_id');
    }
}

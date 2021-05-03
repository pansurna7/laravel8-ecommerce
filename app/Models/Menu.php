<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class Menu extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='user_menu';

    // public function subMenu()
    // {
    //     return $this->belongsTo('App\Models\SubMenu',);
    // }
    public static function JoinSubmenuTable()
    {
        $result = DB::table('user_menu as a')
                ->join('user_sub_menu as b','b.menu_id','=','a.id')
                ->select('a.id','a.menu','a.icon_left','a.icon_right',DB::raw("group_concat(b.title SEPARATOR ', ') as submenu"))
                ->groupBy('a.id','a.menu','a.icon_left','a.icon_right')
                ->get();
        return $result;
     }
}

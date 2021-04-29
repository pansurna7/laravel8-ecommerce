<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $table="user_menu";

    // public function subMenu()
    // {
    //     return $this->belongsTo("App\Models\SubMenu",);
    // }
    public static function JoinTable()
    {
       return DB::table("user_menu as a")
        ->join("user_sub_menu as b","a.id","=","b.menu_id")

        ->select("a.id","a.menu","a.icon_left","a.icon_right","b.title as submenu")
        // ->groupBy("a.id")
        ->get()->dd();
    //    return DB::table("user_sub_menu")->select("user_sub_menu.*")->get()->dd();
    }
}

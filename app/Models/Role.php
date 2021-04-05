<?php

namespace App\Models;
use App\Models\Admin;
use App\Models\Parmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function parmission()
    {
        return $this->hasOne(Parmission::class);
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}

<?php

namespace App\Models;

use App\Models\Parmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $guarded=[''];

    public function pasrmission():\Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Parmission::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;

class Parmission extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts=[
        'parmission' => 'json',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function admin()
    {
        return $this->belongsTo(Admins::class,'admin_id');
    }
    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function statuses(){
        return [
            0=>'draft',
            1=>'active',
            2=>'inactive',
        ];
    }
}


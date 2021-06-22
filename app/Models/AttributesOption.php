<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes;
use Attribute;

class AttributesOption extends Model
{
    use HasFactory;
    protected $guard=[];
    public function attribute(){
        return $this->belongsTo(Attribute::class,'id');
    }
}

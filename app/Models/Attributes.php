<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\attributeoptions;


class Attributes extends Model
{
    use HasFactory;
    protected $guard=[];

    public function attributeoptions(){
        return $this->hasMany(AttributeOptions::class,'attribute_id');
    }
}

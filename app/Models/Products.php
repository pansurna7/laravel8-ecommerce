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
        return $this->belongsTo(Category::class,'category_id');
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

}


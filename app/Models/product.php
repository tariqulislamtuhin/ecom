<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function getCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function Atrribute()
    {
        return $this->hasMany(Atrribute::class, 'product_id');
    }
}

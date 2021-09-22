<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderedProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function getOrderAmmount()
    {
        return $this->belongsTo(OrderAmount::class, 'order_amount_id');
    }
    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getColor()
    {
        return $this->belongsTo(color::class, 'color_id');
    }
    public function getSize()
    {
        return $this->belongsTo(Size::class, 'product_id');
    }
}

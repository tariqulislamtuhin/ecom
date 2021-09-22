<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAmount extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function getBillingDetails()
    {
        return $this->belongsTo(BillingDetail::class, 'billing_detail_id');
    }
    public function getOrderedProduct()
    {
        return $this->hasmany(OrderedProduct::class, 'order_amount_id');
    }
}

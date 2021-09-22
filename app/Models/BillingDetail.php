<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function getOrderAmount()
    {
        return $this->hasOne(OrderAmount::class, 'billing_detail_id');
    }
}

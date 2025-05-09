<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'status', 'amount', 'type',  'created_by', 'updated_by'];
    
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'created_at', 'status', 'comment', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

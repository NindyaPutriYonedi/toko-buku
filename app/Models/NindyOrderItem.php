<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NindyOrderItem extends Model
{
    protected $table = 'nindy_order_items';
    protected $fillable = ['order_id', 'book_id', 'quantity', 'price'];

    public function book() {
        return $this->belongsTo(NindyBook::class, 'book_id');
    }
}

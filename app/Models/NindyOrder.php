<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NindyOrder extends Model
{
    protected $table = 'nindy_orders';
    protected $fillable = ['user_id', 'total_amount', 'metode_pembayaran', 'status'];

    public function items() {

        return $this->hasMany(NindyOrderItem::class, 'order_id');

    }
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}


}

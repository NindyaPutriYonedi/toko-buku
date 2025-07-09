<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NindyBook extends Model
{
    protected $table = 'nindy_books';
    protected $fillable = ['category_id', 'title', 'author', 'description', 'price', 'stock', 'cover_image'];


    public function category() {
        return $this->belongsTo(NindyCategory::class, 'category_id');
    }

    public function orderItems()
{
    return $this->hasMany(NindyOrderItem::class, 'book_id');
}
}


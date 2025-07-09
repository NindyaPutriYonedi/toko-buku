<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NindyCategory extends Model
{
    use HasFactory;

    protected $table = 'nindy_categories';

    protected $fillable = [
        'name',
        'description',
    ];
}

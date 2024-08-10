<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PER_PAGE = 40;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }
}
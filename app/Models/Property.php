<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('value');
    }

    public function scopeAllProperties(Builder $query): Builder
    {
        return $query->select('properties.name', 'product_property.value')
            ->join('product_property', 'properties.id', '=', 'product_property.property_id')
            ->groupBy('properties.name', 'product_property.value')
            ->orderBy('properties.name');
    }
}
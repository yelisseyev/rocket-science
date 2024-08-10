<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $builder, array $filters = []): Builder
    {
        if (isset($filters['properties']) && is_array($filters['properties'])) {
            foreach ($filters['properties'] as $property => $values) {
                if (is_array($values)) {
                    $builder->whereHas('properties', function ($query) use ($property, $values) {
                        $query->where('properties.name', $property)
                            ->whereIn('product_property.value', $values);
                    });
                }
            }
        }

        $builder->with(['properties' => function ($query) {
            $query->select('properties.id', 'properties.name')
                ->withPivot('value');
        }]);

        return $builder;
    }
}
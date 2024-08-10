<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    const PROPERTIES = [
        'цвет плафона' => ['белый', 'красный', 'желтый', 'зеленый', 'синий'],
        'цвет арматуры' => ['белый', 'черный', 'серый', 'золотой', 'серебряный'],
        'бренд' => ['Philips', 'Osram', 'Samsung', 'LG', 'Xiaomi'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = \App\Models\Product::all();

        foreach ($products as $product) {
            foreach (self::PROPERTIES as $propertyName => $propertyValues) {
                $property = \App\Models\Property::firstOrCreate(['name' => $propertyName]);
                $product->properties()->attach($property, ['value' => $propertyValues[array_rand($propertyValues)]]);
            }
        }
    }
}
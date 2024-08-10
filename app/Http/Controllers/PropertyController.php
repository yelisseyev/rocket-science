<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function index()
    {
        $properties = Property::allProperties()->get();

        $propertiesWithValues = $properties->groupBy('name')->map(function ($group) {
            return $group->pluck('value')->unique()->values()->all();
        })->toArray();

        return response()->json($propertiesWithValues);
    }
}
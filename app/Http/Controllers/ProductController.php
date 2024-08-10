<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::filter($request->all())->paginate(Product::PER_PAGE);
        return response()->json($products);
    }

    public function properties()
    {
        $properties = Property::allProperties()->get();
        return response()->json($properties);
    }
}
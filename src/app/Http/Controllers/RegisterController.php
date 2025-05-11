<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('register', compact('products', 'seasons'));
    }

    public function store(RegisterRequest $request)
    {
        $product = Product::create(
            $request->only(['name', 'price', 'description'])
        );
        $product['image'] = $request->image->store('image', 'public');
        $product->seasons()->sync($request->season_ids);
        return view('product');
    }
}

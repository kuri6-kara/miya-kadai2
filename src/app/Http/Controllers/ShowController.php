<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('show', compact('products', 'seasons'));
    }

    public function update(Request $request)
    {
        $products = $request->only(['name', 'price', 'image', 'description']);
        $seasons = $request->only(['name']);
        Product::find($request->id)->update($products);
Season::find($request->id)->update($seasons);
        return redirect('/products');
    }
}

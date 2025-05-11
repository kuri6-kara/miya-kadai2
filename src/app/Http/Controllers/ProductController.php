<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')->Paginate(6);
        $products = Product::all();
        $seasons = Season::all();
        return view('product', compact('products', 'seasons'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($sort = $request->sort) {
            $direction = $request->direction == 'desc' ? 'desc' : 'asc';
            $query->orderBy($sort, $direction);
        }

        $products = $query->Paginate(6);

        return view('product', compact('products', 'seasons'));
    }
}

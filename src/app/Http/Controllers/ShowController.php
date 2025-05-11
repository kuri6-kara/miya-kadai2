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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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

    public function create(Request $request)
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('register', compact('products', 'seasons'));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create(
            $request->only(['name', 'price', 'description'])
        );
        $product['image'] = $request->file('image')->store('image', 'public');
        $product->seasons()->sync($request->season_ids);
        return view('product');
    }

    public function show()
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('show', compact('products', 'seasons'));
    }

    public function update(ProductRequest $request)
    {
        $products = $request->only(['name', 'price', 'image', 'description']);
        $seasons = $request->only(['name']);
        Product::find($request->id)->update($products);
        Season::find($request->id)->update($seasons);
        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        Season::find($request->id)->delete();
        return redirect('/products');
    }

}

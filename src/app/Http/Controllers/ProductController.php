<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::Paginate(6);
        return view('product', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        // dump($request->all());
        if (!empty($request->sort)) {
            // dump('2:' . $request->sort);
            $query->orderBy('price', $request->sort);
        }

        $products = $query->Paginate(6)->appends($request->query());;

        return view('product', compact('products'));
    }

    public function create(Request $request)
    {
        $products = Product::all();
        $seasons = Season::all();
        return view('register', compact('products', 'seasons'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['name', 'price', 'description', 'image']);
        $data['image'] = $request->file('image')->store('image', 'public');
        $product = Product::create($data);
        $product->seasons()->sync($request->season_ids);
        return redirect('/products');
    }

    public function show($productId)
    {
        $product = Product::find($productId);
        $seasons = Season::all();
        return view('show', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $data = $request->only(['name', 'price', 'image', 'description']);
        $data['image'] = $request->file('image')->store('image', 'public');
        $product = Product::find($productId);
        $product->update($data);
        $product->seasons()->sync($request->season_ids);
        return redirect('/products');
    }

    public function destroy(Request $request, $productId)
    {
        Product::find($productId)->delete();
        return redirect('/products');
    }
}

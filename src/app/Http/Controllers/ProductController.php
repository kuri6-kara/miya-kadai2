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

        if ($sort = $request->sort) {
            $direction = $request->direction == 'desc' ? 'desc' : 'asc';
            $query->orderBy($sort, $direction);
        }

        $products = $query->Paginate(6);

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

    public function show($id)
    {
        $product = Product::find($id);
        $seasons = Season::all();
        return view('show', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $id)
    {
        $products = $request->only(['name', 'price', 'image', 'description']);
        $seasons = $request->only(['name']);
        Product::find($id)->update($products);
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

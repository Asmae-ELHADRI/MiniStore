<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products()->with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = auth()->user()->categories;
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $category = auth()->user()->categories()->findOrFail($request->category_id);
        
        auth()->user()->products()->create($request->all());
        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }

    public function show(Product $product)
    {
        $this->authorizeOwner($product);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorizeOwner($product);
        $categories = auth()->user()->categories;
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeOwner($product);
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $category = auth()->user()->categories()->findOrFail($request->category_id);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeOwner($product);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }

    protected function authorizeOwner(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }
    }
}

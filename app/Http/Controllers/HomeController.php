<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Removed auth middleware to allow public access
    }

    /**
     * Show the application dashboard or storefront.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $user = auth()->user();
            $stats = [
                'categories' => $user->categories()->count(),
                'products' => $user->products()->count(),
                'clients' => $user->clients()->count(),
                'orders' => $user->orders()->count(),
            ];
            return view('home', compact('stats'));
        }

        // For guests or regular users, show the storefront
        $products = Product::with('category')->where('quantity', '>', 0)->latest()->get();
        return view('store', compact('products'));
    }
}

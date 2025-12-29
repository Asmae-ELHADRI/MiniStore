<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'categories' => \App\Models\Category::count(),
            'products' => \App\Models\Product::count(),
            'clients' => \App\Models\Client::count(),
            'orders' => \App\Models\Order::count(),
        ];
        return view('home', compact('stats'));
    }
}

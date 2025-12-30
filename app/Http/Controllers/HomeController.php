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
        $user = auth()->user();
        $stats = [
            'categories' => $user->categories()->count(),
            'products' => $user->products()->count(),
            'clients' => $user->clients()->count(),
            'orders' => $user->orders()->count(),
        ];
        return view('home', compact('stats'));
    }
}

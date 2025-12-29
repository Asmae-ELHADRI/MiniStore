<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::where('quantity', '>', 0)->get();
        return view('orders.create', compact('clients', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'client_id' => $request->client_id,
                'total_price' => 0,
                'status' => 'completed', // For this simple version
            ]);

            $totalPrice = 0;

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Stock insuffisant pour le produit: {$product->name}");
                }

                $order->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $product->decrement('quantity', $item['quantity']);
                $totalPrice += $product->price * $item['quantity'];
            }

            $order->update(['total_price' => $totalPrice]);

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $order->load(['client', 'products']);
        return view('orders.show', compact('order'));
    }
}

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
        if (auth()->check() && auth()->user()->isAdmin()) {
            $orders = Order::with('client')->latest()->get();
        } else {
            $orders = auth()->user()->orders()->with('client')->latest()->get();
        }
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $selectedProductId = request('product_id');
        $products = Product::where('quantity', '>', 0)->get();
        
        $clients = [];
        if (auth()->check()) {
            $clients = auth()->user()->clients;
        }
        
        return view('orders.create', compact('clients', 'products', 'selectedProductId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Find the owner for this order (use the owner of the first product)
            $firstProduct = Product::findOrFail($request->products[0]['id']);
            $ownerId = $firstProduct->user_id;

            $orderData = [
                'client_id' => $request->client_id,
                'total_price' => 0,
                'status' => 'completed',
                'user_id' => $ownerId,
            ];

            $order = Order::create($orderData);

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
            
            if (auth()->check()) {
                return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
            }
            
            return redirect()->route('home')->with('success', 'Votre commande a été enregistrée avec succès !');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $this->authorizeOwner($order);
        $order->load(['client', 'products']);
        return view('orders.show', compact('order'));
    }

    protected function authorizeOwner(Order $order)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return;
        }

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Order $order)
    {
        $order->status = 'completed';
        $order->save();
        return redirect()->route('orders.show', $order);
    }

    public function create(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = Product::find($request->product_id);
        }
    
        $products = Product::all();
        return view('orders.create', compact('products', 'product'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'product_id' => 'required|exists:products,id',
            'status' => 'in:new,completed',
            'created_at' => 'required|date',
        ]);

        Order::create($request->all());
        return redirect()->route('orders.index');
    }
}


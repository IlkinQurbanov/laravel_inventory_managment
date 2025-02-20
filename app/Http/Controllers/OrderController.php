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

    public function updateStatus(Request $request, Order $order)
    {
        $order->status = 'completed';
        $order->save();

        // Success message after updating the status
        return redirect()->route('orders.show', $order)->with('success', 'Order status updated to completed!');
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
        // Validation with custom error messages
        $request->validate([
            'customer_name' => 'required|max:255',
            'product_id' => 'required|exists:products,id',
            'status' => 'in:new,completed',
            'created_at' => 'required|date',
            'comment' => 'nullable|string|max:500', 
        ], [
            'customer_name.required' => 'The customer name is required.',
            'customer_name.max' => 'The customer name cannot exceed 255 characters.',
            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'The selected product does not exist.',
            'status.in' => 'The status must be either "new" or "completed".',
            'created_at.required' => 'Please provide the order date.',
            'created_at.date' => 'The order date must be a valid date.',
            'comment.max' => 'The comment should not exceed 500 characters.',
            'comment.string' => 'The comment must be a valid string.',
        ]);

        Order::create([
            'customer_name' => $request->customer_name,
            'product_id' => $request->product_id,
            'status' => $request->status,
            'created_at' => $request->created_at,
            'comment' => $request->comment, 
        ]);

        // Success message after storing the order
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

}

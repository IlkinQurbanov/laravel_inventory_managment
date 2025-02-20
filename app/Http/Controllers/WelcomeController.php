<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'currency'])->get();
    
        return view('welcome', compact('products'));
    }
    
}

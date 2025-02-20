<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('welcome', compact('products'));
    }
}

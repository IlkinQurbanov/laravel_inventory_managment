<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Currency;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch products with category and currency relationships
        $products = Product::with(['category', 'currency'])->get();
        return view('products.index', compact('products'));
    }
    

    public function create()
    {
        $categories = Category::all();
        $currencies = Currency::all(); 
        return view('products.create', compact('categories', 'currencies'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'currency_id' => 'required|exists:currencies,id', 
            'description' => 'required|min:10|max:1000',
        ], [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name should not exceed 255 characters.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a numeric value.',
            'price.min' => 'Price cannot be less than zero.',
            'category_id.required' => 'Please select a category for the product.',
            'category_id.exists' => 'The selected category does not exist.',
            'currency_id.required' => 'Please select a currency for the product.',
            'currency_id.exists' => 'The selected currency does not exist.',
            'description.required' => 'Product description is required.',
            'description.min' => 'Product description should be at least 10 characters.',
            'description.max' => 'Product description should not exceed 1000 characters.',
        ]);
        
        // Create the product including the selected currency_id
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'currency_id' => $request->currency_id, // Save the selected currency_id
            'description' => $request->description,
        ]);
    
        // Success message after storing product
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    

    public function show(Product $product)
    {
        $product->load('category', 'currency');
        
        return view('products.show', compact('product'));
    }
    

    public function edit(Product $product)
    {
        $categories = Category::all();
        $currencies = Currency::all();  
        return view('products.edit', compact('product', 'categories', 'currencies'));
    }
    

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'currency_id' => 'required|exists:currencies,id', // Add validation for currency_id
            'description' => 'required|min:10|max:1000',
        ], [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name should not exceed 255 characters.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a numeric value.',
            'price.min' => 'Price cannot be less than zero.',
            'category_id.required' => 'Please select a category for the product.',
            'category_id.exists' => 'The selected category does not exist.',
            'currency_id.required' => 'Please select a currency for the product.',
            'currency_id.exists' => 'The selected currency does not exist.',
            'description.required' => 'Product description is required.',
            'description.min' => 'Product description should be at least 10 characters.',
            'description.max' => 'Product description should not exceed 1000 characters.',
        ]);
        
        // Update the product including the selected currency_id
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'currency_id' => $request->currency_id, // Update the currency_id
            'description' => $request->description,
        ]);
    
        // Success message after updating product
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    

    public function destroy(Product $product)
    {
        $product->delete();

        // Success message after deleting product
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}

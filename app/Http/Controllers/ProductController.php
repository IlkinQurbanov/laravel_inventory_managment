<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:10|max:1000',
        ], [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name should not exceed 255 characters.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a numeric value.',
            'price.min' => 'Price cannot be less than zero.',
            'category_id.required' => 'Please select a category for the product.',
            'category_id.exists' => 'The selected category does not exist.',
            'description.required' => 'Product description is required.',
            'description.min' => 'Product description should be at least 10 characters.',
            'description.max' => 'Product description should not exceed 1000 characters.',
        ]);
    
        Product::create($request->all());

        // Success message after storing product
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:10|max:1000',
        ], [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name should not exceed 255 characters.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a numeric value.',
            'price.min' => 'Price cannot be less than zero.',
            'category_id.required' => 'Please select a category for the product.',
            'category_id.exists' => 'The selected category does not exist.',
            'description.required' => 'Product description is required.',
            'description.min' => 'Product description should be at least 10 characters.',
            'description.max' => 'Product description should not exceed 1000 characters.',
        ]);
    
        $product->update($request->all());

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

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {
        $categories = Category::all();
        
        return view('categories.index', compact('categories'));
    }

  
    public function create()
    {
        return view('categories.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a valid string.',
            'name.max' => 'The category name must not exceed 255 characters.',
            'name.unique' => 'A category with the name "' . $request->name . '" already exists in the database.',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

 
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

  
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a valid string.',
            'name.max' => 'The category name must not exceed 255 characters.',
            'name.unique' => 'A category with the name "' . $request->name . '" already exists in the database.',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

  
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
  
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
    }

   
    public function create()
    {
        return view('currencies.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:currencies,name',
            'symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric',
        ], [
            'name.required' => 'Currency name is required.',
            'symbol.required' => 'Currency symbol is required.',
            'exchange_rate.required' => 'Exchange rate is required.',
        ]);

        Currency::create([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'exchange_rate' => $request->exchange_rate,
        ]);

        return redirect()->route('currencies.index')->with('success', 'Currency created successfully!');
    }


    public function edit(Currency $currency)
    {
        return view('currencies.edit', compact('currency'));
    }


    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:currencies,name,' . $currency->id,
            'symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric',
        ], [
            'name.required' => 'Currency name is required.',
            'symbol.required' => 'Currency symbol is required.',
            'exchange_rate.required' => 'Exchange rate is required.',
        ]);

        $currency->update([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'exchange_rate' => $request->exchange_rate,
        ]);

        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully!');
    }


    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully!');
    }
}

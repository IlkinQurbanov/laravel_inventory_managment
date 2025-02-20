<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample currency data
        Currency::create([
            'name' => 'USD',
            'symbol' => '$',
            'exchange_rate' => 1.000000,  // Base rate for USD
        ]);

        Currency::create([
            'name' => 'EUR',
            'symbol' => '€',
            'exchange_rate' => 0.850000,  // Example exchange rate
        ]);

        Currency::create([
            'name' => 'GBP',
            'symbol' => '£',
            'exchange_rate' => 0.750000,  // Example exchange rate
        ]);

        Currency::create([
            'name' => 'INR',
            'symbol' => '₹',
            'exchange_rate' => 74.500000,  // Example exchange rate
        ]);
    }
}

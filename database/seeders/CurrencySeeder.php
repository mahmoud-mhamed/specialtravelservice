<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Currency::first())
            return;
        Currency::create([
            'name' => 'جنية مصري',
            'code' => 'ج م',
        ]);
        Currency::create([
            'name' => 'دولار أمريكي',
            'code' => '$',
        ]);
        Currency::create([
            'name' => 'درهم إماراتي',
            'code' => 'AED',
        ]); Currency::create([
            'name' => 'يورو',
            'code' => '€',
        ]);
    }
}

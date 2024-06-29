<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::factory()
            ->create(['iso_code' => 'USD']);

        Currency::factory()
            ->create(['iso_code' => 'EUR']);

        Currency::factory()
            ->create(['iso_code' => 'GBP']);
    }
}

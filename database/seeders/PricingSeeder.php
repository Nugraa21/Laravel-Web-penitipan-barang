<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'price_per_hour', 'value' => '5000'],
            ['key' => 'price_per_day', 'value' => '50000'],
            ['key' => 'multiplier_electronics', 'value' => '1.5'],
            ['key' => 'multiplier_others', 'value' => '1.0'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}

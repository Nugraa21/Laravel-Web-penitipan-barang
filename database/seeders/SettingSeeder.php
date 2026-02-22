<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'app_name', 'value' => 'PenitipanApp'],
            ['key' => 'hero_title', 'value' => 'Solusi Penitipan Barang Terbaik'],
            ['key' => 'hero_description', 'value' => 'Mau jalan-jalan tapi bawaan ribet? Titipkan di kami! Fasilitas lengkap, aman, dan terjangkau.'],
            ['key' => 'footer_text', 'value' => 'PenitipanApp. Liquid Glass Redesign.'],
            ['key' => 'contact_phone', 'value' => '0812-3456-7890'],
            ['key' => 'contact_address', 'value' => 'Jl. Kebahagiaan No. 1, Jakarta'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}

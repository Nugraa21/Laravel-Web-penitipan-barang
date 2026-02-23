<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            // Landing Page & Promos
            ['key' => 'promo_text', 'value' => 'Promo Spesial: Diskon 20% Penitipan Mingguan!'],
            ['key' => 'store_map_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8872013867086!2d110.40624007357608!3d-7.801740677443152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a575a74041d57%3A0x6295777bc3a7261d!2sUniversitas%20Teknologi%20Digital%20Indonesia!5e0!3m2!1sid!2sid!4v1709405230950!5m2!1sid!2sid'],

            // Pricing
            ['key' => 'price_daily', 'value' => '15000'],
            ['key' => 'price_weekly', 'value' => '50000'],
            ['key' => 'price_monthly', 'value' => '150000'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/penitipanapp'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/penitipanapp'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/penitipanapp'],

            // Welcome Page Texts
            ['key' => 'welcome_pricing_title', 'value' => 'Pilih Opsi Penitipan Sesuai Kebutuhan'],
            ['key' => 'welcome_pricing_subtitle', 'value' => 'Khusus untuk lokasi Bandara atau Stasiun KRL/KAI. Pembayaran dilakukan secara lokal di loket oleh pegawai kami, namun Anda tetap dapat mendaftar dan memantau estimasi barang dari jarak jauh.'],
            ['key' => 'welcome_location_title', 'value' => 'Lokasi Strategis & Terjangkau'],
            ['key' => 'welcome_location_subtitle', 'value' => 'Kunjungi kantor layanan offline kami yang berada tepat di pusat mobilitas. Kami berdedikasi menjaga properti Anda selagi Anda beraktivitas.'],
            ['key' => 'welcome_faq_title', 'value' => 'Pertanyaan yang Sering Diajukan'],
            ['key' => 'welcome_faq_subtitle', 'value' => 'Punya pertanyaan lain? Jangan ragu hubungi Admin kami setelah Anda membuat akun secara gratis.'],
            ['key' => 'welcome_prefooter_title', 'value' => 'Siap Menitipkan Barang Anda?'],
            ['key' => 'welcome_prefooter_subtitle', 'value' => 'Buat akun hari ini, dapatkan pengalaman keamanan dan kenyamanan penitipan barang modern 100% digital tanpa antre.']
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}

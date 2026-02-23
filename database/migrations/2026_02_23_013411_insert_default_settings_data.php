<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        $settings = [
            ['key' => 'app_name', 'value' => json_encode(['id' => 'LokerKu', 'en' => 'MyLocker', 'ja' => 'マイロッカー'])],
            ['key' => 'tagline', 'value' => json_encode(['id' => 'Aman & Terpercaya', 'en' => 'Safe & Reliable', 'ja' => '安全で信頼できる'])],
            ['key' => 'description', 'value' => json_encode(['id' => 'Sistem penitipan barang modern.', 'en' => 'Modern luggage storage system.', 'ja' => '近代的な手荷物預かりシステム'])],
            ['key' => 'footer_text', 'value' => json_encode(['id' => 'LokerKu Indonesia', 'en' => 'MyLocker Global', 'ja' => 'マイロッカージャパン'])],

            ['key' => 'hero_title', 'value' => json_encode(['id' => 'Titip Barang Tenang & Mudah', 'en' => 'Store Your Luggage Safely', 'ja' => '手荷物を安全に保管する'])],
            ['key' => 'hero_description', 'value' => json_encode(['id' => 'Jalan-jalan makin bebas tanpa beban bawaan. Fasilitas lengkap, dapatkan Struk Digital QR Code seketika, dan lacak status pesanan realtime.', 'en' => 'Travel freely without luggage. Complete facilities, get an instant Digital QR Code Receipt, and track order status in real-time.', 'ja' => '荷物を持たずに自由に旅行。充実した設備、QRコード化されたデジタルレシートを即座に取得でき、荷物の状態をリアルタイムで追跡できます。'])],
            ['key' => 'promo_text', 'value' => json_encode(['id' => 'Promo Spesial: Diskon 20% Penitipan Mingguan!', 'en' => 'Special Promo: 20% Off Weekly Storage!', 'ja' => '特別プロモ：週間保管20％オフ！'])],

            ['key' => 'welcome_pricing_title', 'value' => json_encode(['id' => 'Pilih Opsi Penitipan Sesuai Kebutuhan', 'en' => 'Choose a Storage Option That Fits Your Needs', 'ja' => 'ニーズに合った保管オプションを選択してください'])],
            ['key' => 'welcome_pricing_subtitle', 'value' => json_encode(['id' => 'Khusus untuk lokasi Bandara atau Stasiun KRL/KAI. Pembayaran dilakukan secara lokal.', 'en' => 'Special for Airport or Station locations. Local payments only.', 'ja' => '空港や駅の特別な場所でローカル決済も可能です。'])],
            ['key' => 'price_daily', 'value' => '15000'],
            ['key' => 'price_weekly', 'value' => '50000'],
            ['key' => 'price_monthly', 'value' => '150000'],

            ['key' => 'welcome_location_title', 'value' => json_encode(['id' => 'Lokasi Strategis & Terjangkau', 'en' => 'Strategic & Accessible Location', 'ja' => '戦略的でアクセスしやすい場所'])],
            ['key' => 'welcome_location_subtitle', 'value' => json_encode(['id' => 'Kunjungi kantor layanan offline kami yang berada tepat di pusat mobilitas.', 'en' => 'Visit our offline service office strategically located in mobility hubs.', 'ja' => '交通の要所にあるオフラインサービスオフィスをお尋ねください。'])],

            ['key' => 'contact_email', 'value' => 'admin@lokerku.com'],
            ['key' => 'contact_phone', 'value' => '+628123456789'],
            ['key' => 'contact_address', 'value' => json_encode(['id' => 'Gedung Pusat Kegiatan Administrasi Lt. 1,\nJalan Sudirman No. 45, Kompleks Area A.', 'en' => 'Admin Central Building 1st Fl,\nSudirman St No. 45, Area A Complex.', 'ja' => '管理本部ビル1階\nスディルマン通り45番、Aエリアコンプレックス。'])],

            ['key' => 'social_facebook', 'value' => 'https://facebook.com/lokerku'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/lokerku'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/lokerku'],

            ['key' => 'welcome_faq_title', 'value' => json_encode(['id' => 'FAQ (Pertanyaan Umum)', 'en' => 'FAQ (Frequently Asked Questions)', 'ja' => 'よくある質問（FAQ）'])],
            ['key' => 'welcome_faq_subtitle', 'value' => json_encode(['id' => 'Temukan jawaban cepat untuk pertanyaan yang sering diajukan pelanggan kami.', 'en' => 'Find quick answers to common questions asked by our customers.', 'ja' => 'お客様からよく寄せられる質問に対する素早い回答を見つけてください。'])],

            ['key' => 'welcome_prefooter_title', 'value' => json_encode(['id' => 'Siap Menitipkan Barang Anda?', 'en' => 'Ready to Store Your Luggage?', 'ja' => '手荷物をお預けになりますか？'])],
            ['key' => 'welcome_prefooter_subtitle', 'value' => json_encode(['id' => 'Buat akun hari ini, dapatkan pengalaman keamanan dan kenyamanan penitipan barang modern 100% digital tanpa antre.', 'en' => 'Create an account today, experience secure and comfortable 100% digital modern luggage storage without queuing.', 'ja' => '今すぐアカウントを作成して、行列なしで100%デジタルの最新式手荷物預かりの安全性と快適さを体験してください。'])],

            [
                'key' => 'faq_data',
                'value' => json_encode([
                    [
                        'question' => [
                            'id' => 'Apakah barang berharga seperti Laptop boleh dititipkan?',
                            'en' => 'Can I store valuable items like Laptops?',
                            'ja' => 'ラップトップなどの貴重品を保管できますか？'
                        ],
                        'answer' => [
                            'id' => 'Boleh, namun kami sangat menyarankan Anda memilih Paket VIP/Khusus agar barang Elektronik atau bernilai Tinggi Anda disimpan di ruangan yang dilengkapi AC konstan dan CCTV khusus.',
                            'en' => 'Yes, but we strongly recommend choosing the VIP/Special Package for storing high-value electronics in a room equipped with constant AC and special CCTV.',
                            'ja' => 'はい、ただし、定温エアコンと専用CCTVを備えた部屋に高価な電子機器を保管するためのVIP/特別パッケージを選択することを強くお勧めします。'
                        ]
                    ],
                    [
                        'question' => [
                            'id' => 'Bagaimana jika saya terlambat mengambil barang?',
                            'en' => 'What if I am late in picking up my luggage?',
                            'ja' => '手荷物の受け取りに遅れた場合はどうなりますか？'
                        ],
                        'answer' => [
                            'id' => 'Kami memberikan toleransi waktu 2 jam dari kesepakatan 24 jam. Jika lewat dari itu, sistem akan otomatis mengakumulasi denda sebagai tambahan 1 hari penitipan.',
                            'en' => 'We allow a 2-hour grace period from the 24-hour agreement. After that, the system will automatically accumulate a fine equivalent to 1 extra day of storage.',
                            'ja' => '24時間の契約から2時間の猶予期間を設けています。それ以降は、追加の1日保管に相当する罰金が自動的に累積されます。'
                        ]
                    ],
                    [
                        'question' => [
                            'id' => 'Apa jaminan jika barang saya rusak atau hilang?',
                            'en' => 'What is the guarantee if my item is damaged or lost?',
                            'ja' => '私のアイテムが破損または紛失した場合、どのような保証がありますか？'
                        ],
                        'answer' => [
                            'id' => 'Kami memberikan garansi ganti rugi maksimal sesuai dengan "Estimasi Nilai Barang" yang Anda lampirkan di formulir pendaftaran barang. Batas asuransi dasar mencapai Rp 2.000.000,- per loker.',
                            'en' => 'We offer compensation up to the "Estimated Item Value" provided in the item registration form. The basic insurance limit is up to Rp 2,000,000 per locker.',
                            'ja' => '手荷物登録フォームに記載された「見積商品価値」までの補償を提供します。基本保険限度額はロッカーあたり最大2,000,000ルピアです。'
                        ]
                    ],
                    [
                        'question' => [
                            'id' => 'Apakah pembayaran bisa via cicilan?',
                            'en' => 'Can payments be made in installments?',
                            'ja' => '支払いを分割払いにすることはできますか？'
                        ],
                        'answer' => [
                            'id' => 'Maaf, untuk penitipan harian pembayaran bersifat tunai/QRIS lunas di awal penitipan. Jika Anda perlu langganan bulanan di masa depan, silakan bicarakan di Loket.',
                            'en' => 'Sorry, daily storage payments must be fully paid upfront via cash or QRIS. If you need a monthly subscription, please consult with our staff at the counter.',
                            'ja' => '申し訳ありませんが、日々の保管料金は現金またはQRISで全額前払いする必要があります。月額サブスクリプションが必要な場合は、カウンターのスタッフにご相談ください。'
                        ]
                    ]
                ])
            ]
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down()
    {
        // 
    }
};

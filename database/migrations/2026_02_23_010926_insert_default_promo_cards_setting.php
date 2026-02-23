<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $defaultPromoCards = [
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>',
                'title' => [
                    'id' => 'Daftar & Foto Mandiri',
                    'en' => 'Self Registration & Photo',
                    'ja' => '自己登録と写真'
                ],
                'description' => [
                    'id' => 'Tidak perlu lagi mengisi formulir kertas. Semua dicatat secara digital termasuk dokumentasi foto kondisi barang Anda untuk mencegah perselisihan.',
                    'en' => 'No more paper forms. Everything is recorded digitally including photo documentation of your items to prevent disputes.',
                    'ja' => '紙のフォームはもう必要ありません。紛争を防ぐために、アイテムの写真記録を含め、すべてデジタルで記録されます。'
                ],
                'is_popular' => false,
                'color_theme' => 'default'
            ],
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
                'title' => [
                    'id' => 'Keamanan Super Ekstra',
                    'en' => 'Extra Super Security',
                    'ja' => '超厳重なセキュリティ'
                ],
                'description' => [
                    'id' => 'Gudang penyimpanan dilengkapi kamera CCTV 24 jam. Kami juga melakukan verifikasi ketat ganda (QR dan Face Match) sebelum merilis barang.',
                    'en' => 'Storage warehouse is equipped with 24-hour CCTV. We also perform strict double verification (QR and Face Match) before releasing items.',
                    'ja' => '保管倉庫には24時間CCTVが装備されています。また、アイテムをリリースする前に、厳格な二重検証（QRと顔認証）を実行します。'
                ],
                'is_popular' => true,
                'color_theme' => 'emerald'
            ],
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>',
                'title' => [
                    'id' => 'Notifikasi & Live Chat',
                    'en' => 'Notifications & Live Chat',
                    'ja' => '通知とライブチャット'
                ],
                'description' => [
                    'id' => 'Ada masalah atau perlu mengubah jadwal pengambilan? Buka dashboard dan bicara langsung dengan Admin via antarmuka obrolan realtime terintegrasi.',
                    'en' => 'Have a problem or need to change pickup schedule? Open dashboard and talk directly with Admin via integrated realtime chat interface.',
                    'ja' => '問題があるか、ピックアップスケジュールを変更する必要がありますか？ダッシュボードを開き、統合されたリアルタイムチャットインターフェースを介して管理者に直接話しかけます。'
                ],
                'is_popular' => false,
                'color_theme' => 'blue'
            ]
        ];

        if (Schema::hasTable('settings')) {
            Setting::updateOrCreate(
                ['key' => 'promo_cards'],
                ['value' => json_encode($defaultPromoCards, JSON_UNESCAPED_UNICODE)]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('settings')) {
            Setting::where('key', 'promo_cards')->delete();
        }
    }
};

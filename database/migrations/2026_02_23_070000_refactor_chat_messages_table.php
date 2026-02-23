<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1. Drop foreign key constraint first
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
        });

        // 2. Make item_id nullable using raw SQL for compatibility
        DB::statement('ALTER TABLE chat_messages MODIFY item_id BIGINT UNSIGNED NULL');

        // 3. Re-add foreign key constraint and add receiver_id
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreignId('receiver_id')->nullable()->after('sender_id')->constrained('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('receiver_id');
            $table->dropForeign(['item_id']);
        });

        DB::statement('ALTER TABLE chat_messages MODIFY item_id BIGINT UNSIGNED NOT NULL');

        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->enum('duration_type', ['hours', 'days'])->default('hours')->after('expected_retrieval_date');
            $table->integer('duration_value')->default(1)->after('duration_type');
            $table->decimal('estimated_cost', 15, 2)->default(0)->after('duration_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['duration_type', 'duration_value', 'estimated_cost']);
        });
    }
};

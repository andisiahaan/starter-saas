<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('help_articles', function (Blueprint $table) {
            $table->unsignedBigInteger('helpful_yes_count')->default(0)->after('views_count');
            $table->unsignedBigInteger('helpful_no_count')->default(0)->after('helpful_yes_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('help_articles', function (Blueprint $table) {
            $table->dropColumn(['helpful_yes_count', 'helpful_no_count']);
        });
    }
};

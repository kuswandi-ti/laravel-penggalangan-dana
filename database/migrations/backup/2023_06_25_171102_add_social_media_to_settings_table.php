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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('instagram_link')->after('work_hours')->nullable();
            $table->string('twitter_link')->after('instagram_link')->nullable();
            $table->string('fanpage_link')->after('twitter_link')->nullable();
            $table->string('google_plus_link')->after('fanpage_link')->nullable();
            $table->string('youtube_link')->after('google_plus_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'instagram_link',
                'twitter_link',
                'fanpage_link',
                'google_plus_link',
                'youtube_link',
            ]);
        });
    }
};

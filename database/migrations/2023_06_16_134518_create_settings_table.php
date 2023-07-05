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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('owner_name')->nullable();
            $table->string('company_name');
            $table->string('short_description')->nullable();
            $table->string('keyword')->nullable();
            $table->string('phone')->nullable();
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->char('postal_code', 5)->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('work_hours')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('fanpage_link')->nullable();
            $table->string('google_plus_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('path_image_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

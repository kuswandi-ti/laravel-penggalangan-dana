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
            $table->string('business_name')->after('company_name');
            $table->string('facebook_link')->after('youtube_link')->nullable();
            $table->string('vision')->after('short_description')->nullable();
            $table->string('longitude')->after('province')->nullable();
            $table->string('latitude')->after('longitude')->nullable();
            $table->string('contact_person_name')->after('facebook_link')->nullable();
            $table->string('contact_person_title')->after('contact_person_name')->nullable();
            $table->string('contact_person_path_image')->after('contact_person_title')->nullable();
            $table->string('path_image_business')->after('path_image_logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'business_name',
                'facebook_link',
                'vision',
                'longitude',
                'latitude',
                'contact_person_name',
                'contact_person_title',
                'contact_person_path_image',
                'path_image_business',
            ]);
        });
    }
};

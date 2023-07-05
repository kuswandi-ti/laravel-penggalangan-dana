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
            $table->string('owner_name')->after('email');
            $table->string('company_name')->after('owner_name');
            $table->string('short_description')->after('company_name');
            $table->string('keyword')->after('short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'owner_name',
                'company_name',
                'short_description',
                'keyword',
            ]);
        });
    }
};

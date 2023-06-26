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
        Schema::table('bank_users', function (Blueprint $table) {
            $table->string('account_number')->after('user_id');
            $table->string('account_name')->after('account');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_users', function (Blueprint $table) {
            $table->dropColumn([
                'account_number',
                'account_name',
            ]);
        });
    }
};

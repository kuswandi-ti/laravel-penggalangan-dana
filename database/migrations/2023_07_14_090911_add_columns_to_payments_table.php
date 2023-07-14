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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('name')->after('order_number')->nullable();
            $table->string('phone')->after('name')->nullable();
            $table->string('email')->after('phone')->nullable();
            $table->string('payment_time')->after('note')->nullable();
            $table->string('payment_type')->after('payment_time')->nullable();
            $table->string('payment_currency')->after('payment_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'phone',
                'email',
                'payment_time',
                'payment_type',
                'payment_currency',
            ]);
        });
    }
};

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
        Schema::create('bank_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('setting_id')->unsigned();
            $table->foreign('setting_id')->references('id')->on('settings')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_settings');
    }
};

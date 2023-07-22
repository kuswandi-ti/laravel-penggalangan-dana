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
        Schema::create('cashouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id')->unsigned();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onUpdate('restrict')->onDelete('restrict');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->double('cashout_amount')->default(0);
            $table->double('cashout_fee')->default(0);
            $table->double('amount_received')->default(0);
            $table->double('remaining_amount')->default(0);
            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('restrict')->onDelete('restrict');
            $table->double('total')->default(0);
            $table->enum('status', [
                'pending',
                'success',
                'rejected',
                'canceled'
            ]);
            $table->string('reason_rejected')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashouts');
    }
};

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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->longtext('body');
            $table->integer('view_cont')->default(0);
            $table->enum('status', ['Public', 'Pending', 'Archieve'])->default('Pending');
            $table->integer('amount')->default(0);
            $table->integer('goal')->default(0);
            $table->datetime('end_date');
            $table->text('note')->nullable();
            $table->string('receiver');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

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
        Schema::create('professional_commission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_professional');
            $table->foreign('id_professional')->references('id')->on('professional')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_commission');
            $table->foreign('id_commission')->references('id')->on('commission')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_commission');
    }
};

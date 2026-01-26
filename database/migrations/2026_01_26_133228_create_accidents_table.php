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
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registred_professional_id');
            $table->foreign('registred_professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('affected_professional_id');
            $table->foreign('affected_professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->string('issue',255);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('description',255);
            $table->string('status',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};

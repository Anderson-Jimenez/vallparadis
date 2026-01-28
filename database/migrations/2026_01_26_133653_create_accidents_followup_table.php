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
        Schema::create('accidents_followup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accident_id');
            $table->unsignedBigInteger('professional_id');
            $table->foreign('accident_id')->references('id')->on('accidents')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->foreign('professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->string('issue',255);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents_followup');
    }
};

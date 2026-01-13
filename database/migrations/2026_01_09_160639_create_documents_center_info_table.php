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
        Schema::create('documents_center_info', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->date('date');
            $table->text('description')->nullable();
            $table->foreignId('professional_id')->references('id')->on('professionals')->onDelete('cascade');
            $table->foreignId('center_id')->references('id')->on('centers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_center_info');
    }
};

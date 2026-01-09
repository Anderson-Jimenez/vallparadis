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
        Schema::create('documents_center', function(Blueprint $table){
            $table->id();
            $table->foreignId('document_center_info_id')
                  ->constrained('documents_center_info')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
            
            // Índice para mejor rendimiento
            $table->index('document_center_info_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_center');
    }
};

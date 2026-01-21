<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hr_pending_issue', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')
                  ->references('id')
                  ->on('centers')
                  ->onDelete('cascade');
            
            $table->date('opened_at');
            
            $table->unsignedBigInteger('affected_professional_id');
            $table->foreign('affected_professional_id')
                  ->references('id')
                  ->on('professionals')
                  ->onDelete('restrict');
            
            $table->text('description');
            
            $table->unsignedBigInteger('registered_by_professional_id');
            $table->foreign('registered_by_professional_id')
                  ->references('id')
                  ->on('professionals')
                  ->onDelete('restrict');
            
            $table->unsignedBigInteger('derived_to_professional_id')->nullable();
            $table->foreign('derived_to_professional_id')
                  ->references('id')
                  ->on('professionals')
                  ->onDelete('restrict');
            $table->enum('status', ['in_process', 'urgent', 'completed'])->default('in_process');
            $table->timestamps();

            $table->index('center_id');
            $table->index('affected_professional_id');
            $table->index('registered_by_professional_id');
            $table->index('derived_to_professional_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr_pending_issue');
    }
};
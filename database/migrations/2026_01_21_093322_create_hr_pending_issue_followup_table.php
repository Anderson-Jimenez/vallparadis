<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hr_pending_issue_followup', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('hr_pending_issue_id');
            $table->foreign('hr_pending_issue_id')
                  ->references('id')
                  ->on('hr_pending_issue')
                  ->onDelete('cascade');
            
            $table->date('followup_date');
            
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')
                  ->references('id')
                  ->on('professionals')
                  ->onDelete('restrict');
            
            $table->text('description');
            $table->timestamps();

            $table->index('hr_pending_issue_id');
            $table->index('professional_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr_pending_issue_followup');
    }
};
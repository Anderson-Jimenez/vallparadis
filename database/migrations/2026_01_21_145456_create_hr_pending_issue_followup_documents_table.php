<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hr_pending_issue_followup_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('hr_followup_id');
            $table->foreign('hr_followup_id')
                  ->references('id')
                  ->on('hr_pending_issue_followup')
                  ->onDelete('cascade');
            
            $table->string('path');
            $table->timestamps();

            $table->index('hr_followup_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr_pending_issue_followup_documents');
    }
};
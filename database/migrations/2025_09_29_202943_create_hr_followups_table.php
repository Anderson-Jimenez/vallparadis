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
        Schema::create('hr_followups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_issue_id');

            $table->foreign('hr_issue_id')->references('id')->on('hr_issues')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->string('professional',255);
            $table->string('docs_route',255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_followups');
    }
};

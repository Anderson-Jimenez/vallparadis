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
        Schema::create('hr_issues_doc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_issues_id');
            $table->foreign('hr_issues_id')->references('id')->on('hr_issues')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name',255);
            $table->string('path',255);
            $table->string('status',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_issues_doc');
    }
};

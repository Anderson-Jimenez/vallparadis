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
        Schema::create('hr_followup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->unsignedBigInteger('id_hr_issue');

            $table->foreign('id_hr_issue')->references('id')->on('hr_issue')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('hr_followup');
    }
};

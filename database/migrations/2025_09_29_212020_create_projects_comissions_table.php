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
        Schema::create('projects_comissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('professional_manager_id');
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 255);
            $table->date('start_date');
            $table->foreign('professional_manager_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->text('description');
            $table->text('observation');
            $table->string('type', 255);
            $table->string('status', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_comissions');
    }
};

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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('evaluator_id'); // professional q avalua
            
            $table->unsignedBigInteger('assessed_professional_id');

            $table->date('evaluation_date')->nullable();
            $table->integer('average_score')->nullable();

            $table->foreign('evaluator_id')->references('id')->on('professionals')->onDelete('cascade');
            $table->foreign('assessed_professional_id')->references('id')->on('professionals')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};

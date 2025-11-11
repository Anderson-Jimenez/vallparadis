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
        Schema::create('evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id');

            // Camp per pregunta
            $table->tinyInteger('q1')->nullable();
            $table->tinyInteger('q2')->nullable();
            $table->tinyInteger('q3')->nullable();
            $table->tinyInteger('q4')->nullable();
            $table->tinyInteger('q5')->nullable();
            $table->tinyInteger('q6')->nullable();
            $table->tinyInteger('q7')->nullable();
            $table->tinyInteger('q8')->nullable();
            $table->tinyInteger('q9')->nullable();
            $table->tinyInteger('q10')->nullable();
            $table->tinyInteger('q11')->nullable();
            $table->tinyInteger('q12')->nullable();
            $table->tinyInteger('q13')->nullable();
            $table->tinyInteger('q14')->nullable();
            $table->tinyInteger('q15')->nullable();
            $table->tinyInteger('q16')->nullable();
            $table->tinyInteger('q17')->nullable();
            $table->tinyInteger('q18')->nullable();
            $table->tinyInteger('q19')->nullable();
            $table->tinyInteger('q20')->nullable();

            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_results');
    }
};

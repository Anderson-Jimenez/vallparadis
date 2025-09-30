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
        Schema::create('uniform_renewal', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_uniform');
            $table->foreign('id_uniform')->references('id')->on('uniform')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_professional');
            $table->foreign('id_professional')->references('id')->on('professional')->onUpdate('cascade')->onDelete('cascade');
            $table->date('renovation_date');
            $table->string('type_uniform', 255);
            $table->string('docs_route', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniform_renewal');
    }
};

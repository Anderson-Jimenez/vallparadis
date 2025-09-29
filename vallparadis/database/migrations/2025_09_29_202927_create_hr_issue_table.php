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
        Schema::create('hr_issue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->unsignedBigInteger('id_professional');
            $table->unsignedBigInteger('id_professional_sign');

            $table->foreign('id_center')->references('id')->on('center')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_professional')->references('id')->on('professional')->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date');
            $table->string('description',255);
            $table->foreign('id_professional_sign')->references('id')->on('professional')->onUpdate('cascade')->onDelete('cascade');
            $table->string('docs_route',255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_issue');
    }
};

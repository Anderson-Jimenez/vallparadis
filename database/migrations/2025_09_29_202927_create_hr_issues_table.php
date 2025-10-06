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
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('professional_id');
            
            $table->unsignedBigInteger('professional_sign_id');

            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date');
            $table->string('description',255);
            $table->foreign('professional_sign_id')->references('id')->on('professional')->onUpdate('cascade')->onDelete('cascade');
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

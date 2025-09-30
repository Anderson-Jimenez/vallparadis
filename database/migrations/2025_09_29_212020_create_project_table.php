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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date');
            $table->string('name', 255);
            $table->string('manager', 255);
            $table->text('description');
            $table->string('docs_route', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};

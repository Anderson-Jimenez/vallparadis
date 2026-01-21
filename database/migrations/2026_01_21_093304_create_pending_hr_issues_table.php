<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hr_pending_issues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('center_id')->cascadeOnDelete();

            $table->date('opened_at');

            $table->foreignId('affected_professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');

            $table->text('description');

            $table->foreignId('registered_by_professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('derived_to_professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('documents')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr_pending_issues');
    }
};

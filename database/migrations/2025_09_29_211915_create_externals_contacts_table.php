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
        Schema::create('externals_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('type',255);
            $table->enum('purpose_type', ['motiu', 'servei']);
            $table->string('purpose', 255);//per agrupar millor el nom, a mes de que les / en noms de base de dades donen error(motiu/servei). 
            
            //enum per escollir entre company o department per així guardar quin seria el tipus de contacte
            $table->enum('origin_type', ['company', 'department']);
            
            $table->string('organization', 255);//amb la provinença del contacte, ja es pot escriure el seu nom
            $table->string('manager',255);
            $table->string('phone_numer',20);
            $table->string('email_address',50);
            $table->text('comments');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('externals_contacts');
    }
};

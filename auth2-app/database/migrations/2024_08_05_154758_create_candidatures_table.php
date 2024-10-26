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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            // identite
            $table->string('first_name_fr');
            $table->string('first_name_ar');
            $table->string('last_name_fr');
            $table->string('last_name_ar');
            $table->enum('gender', ['male', 'female']);
            $table->string('national_id')->unique();
            $table->string('cnic_file')->nullable();
            $table->date('date_naissance');
            $table->enum('current_profession', ['autres', 'employe', 'fonctionnaire', 'professionLiberale'])->default('autres');
            $table->enum('military_status', ['oui', 'non'])->nullable();
            $table->string('military_status_pdf')->nullable();
            $table->enum('status', ['en attente', 'accepté', 'rejeté'])->default('en attente');
            // adresse et cordonnees
            $table->foreignId('ville_id')->references('id')->on('villes')->onDelete('set null');
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('set null');
            $table->string('address_fr');
            $table->string('phone');
            $table->string('email')->unique();

             // ID du concours
            $table->foreignId('concour_id')->constrained('concours')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};

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
        Schema::create('concours', function (Blueprint $table) {
            $table->id();
            $table->string('nom_concour');
            $table->date('date_concour');
            $table->date('date_affichage');
            $table->date('date_limite_depot_dossier');
            $table->bigInteger('nombre_poste');
            $table->string('concour_pdf');
            $table->string('resultats_pdf_1')->default('');
            $table->string('resultats_pdf_2')->default('');
            $table->string('resultats_pdf_3')->default('');
            $table->string('statut')->default('A venir');
            $table->foreignId('administration_id')->nullable()->constrained('administration')->onDelete('cascade')->nullable();
            $table->foreignId('profil_id')->nullable()->constrained('profil')->onDelete('cascade')->nullable();
            $table->foreignId('grade_id')->nullable()->constrained('grade')->onDelete('cascade')->nullable();
            $table->foreignId('filiere_id')->nullable()->constrained('filiere')->onDelete('cascade')->nullable();
            // $table->foreignId('specialite_id')->nullable()->constrained('specialite')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concours');
    }
};

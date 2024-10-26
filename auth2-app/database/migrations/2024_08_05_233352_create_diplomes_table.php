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
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures')->onDelete('cascade');
            $table->string('name');
            $table->foreignId('etablissement_id')->nullable()->references('id')->on('etablissements')->onDelete('set null');
            $table->foreignId('niveau_id')->nullable()->references('id')->on('niveaux')->onDelete('set null');
            $table->foreignId('specialite_id')->nullable()->references('id')->on('specialites')->onDelete('set null');
            $table->foreignId('filiere_id')->nullable()->references('id')->on('filieres')->onDelete('set null');
            $table->foreignId('pays_id')->nullable()->references('id')->on('pays')->onDelete('set null');
            $table->year('year_of_obtention');
            $table->string('diploma_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diplomes');
    }
};

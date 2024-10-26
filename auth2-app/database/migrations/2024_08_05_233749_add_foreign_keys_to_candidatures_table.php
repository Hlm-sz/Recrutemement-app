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
        Schema::table('candidatures', function (Blueprint $table) {
            // $table->unsignedBigInteger('diplome_id')->nullable();
            // $table->unsignedBigInteger('etablisement_id')->nullable();
            // $table->unsignedBigInteger('niveau_id')->nullable();
            // $table->unsignedBigInteger('specialite_id')->nullable();
            // $table->unsignedBigInteger('filiere_id')->nullable();
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('concour_id')->nullable();
            // $table->unsignedBigInteger('ancien_id')->nullable();
            // $table->unsignedBigInteger('ville_id')->nullable();
            // $table->unsignedBigInteger('region_id')->nullable();

            // $table->foreign('diplome_id')->references('id')->on('diplomes')->onDelete('set null');
            // $table->foreign('etablisement_id')->references('id')->on('etablisements')->onDelete('set null');
            // $table->foreign('niveau_id')->references('id')->on('niveaux')->onDelete('set null');
            // $table->foreign('specialite_id')->references('id')->on('specialites')->onDelete('set null');
            // $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('set null');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('concour_id')->references('id')->on('concours')->onDelete('set null');
            // $table->foreign('ville_id')->references('id')->on('villes')->onDelete('set null');
            // $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
        //     $table->dropForeign(['diplome_id']);
        //     $table->dropForeign(['etablisement_id']);
        //     $table->dropForeign(['niveau_id']);
        //     $table->dropForeign(['specialite_id']);
        //     $table->dropForeign(['filiere_id']);
        //     $table->dropForeign(['concour_id']);

        //     $table->dropColumn(['diplome_id', 'etablisement_id', 'niveau_id', 'specialite_id', 'filiere_id', 'concour_id']);
        });
    }
};

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
        Schema::create('candidature_concour', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidature_id');
            $table->unsignedBigInteger('concour_id');
            $table->timestamps(); // Cette méthode crée 'created_at' et 'updated_at'

            // Foreign keys
            $table->foreign('candidature_id')->references('id')->on('candidatures')->onDelete('cascade');
            $table->foreign('concour_id')->references('id')->on('concours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidature_concour');
    }
};

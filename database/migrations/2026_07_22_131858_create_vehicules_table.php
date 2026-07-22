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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->unsignedSmallInteger('annee');
            $table->string('immatriculation')->unique();
            $table->string('couleur')->nullable();
            $table->enum('carburant', ['essence', 'diesel', 'hybride', 'electrique'])->default('essence');
            $table->enum('transmission', ['manuelle', 'automatique'])->default('manuelle');
            $table->unsignedInteger('kilometrage')->default(0);
            $table->enum('type_offre', ['vente', 'location', 'vente_location'])->default('vente');
            $table->decimal('prix_vente', 12, 2)->nullable();
            $table->decimal('prix_location_jour', 10, 2)->nullable();
            $table->enum('statut', ['disponible', 'vendu', 'loue', 'maintenance', 'indisponible'])->default('disponible');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};

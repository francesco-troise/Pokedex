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
        // 1. Rinominiamo prima la colonna con l'errore di battitura
        Schema::table('pokemon_details', function (Blueprint $table) {
            $table->renameColumn('weigth', 'weight');
        });

        // 2. Cambiamo i tipi di dato in Decimal per accettare valori come '0.7'
        Schema::table('pokemon_details', function (Blueprint $table) {
            // decimal(8,2) permette numeri fino a 999999.99
            $table->decimal('height', 8, 2)->change();
            $table->decimal('weight', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon_details', function (Blueprint $table) {
            // Torniamo ai nomi e tipi originali
            $table->renameColumn('weight', 'weigth');
        });

        Schema::table('pokemon_details', function (Blueprint $table) {
            $table->string('height', 255)->change();
            $table->string('weigth', 255)->change();
        });
    }
};
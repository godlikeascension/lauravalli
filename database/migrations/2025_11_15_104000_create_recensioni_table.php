<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recensioni', function (Blueprint $table) {
            $table->id();
            $table->string('immagine')->nullable(); // path dell'immagine uploadata
            $table->text('testo');                  // testo della recensione
            $table->string('nome');                 // nome di chi lascia la recensione
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recensioni');
    }
};

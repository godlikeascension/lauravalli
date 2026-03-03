<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collezioni', function (Blueprint $table) {
            $table->id();

            // nome della collezione
            $table->string('nome');

            // slug per URL tipo /collezione/nome-collezione
            $table->string('slug')->unique();

            // descrizione opzionale
            $table->text('descrizione')->nullable();

            // collezione mostrata nella pagina /collezione del frontend
            $table->boolean('is_default')->default(false);

            // collezione mostrata nella homepage
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collezioni');
    }
};

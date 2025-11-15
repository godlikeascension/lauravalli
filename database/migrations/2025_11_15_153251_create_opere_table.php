<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opere', function (Blueprint $table) {
            $table->id();

            // immagine dell'opera (path nel disco "public")
            $table->string('immagine')->nullable();

            // titolo dell'opera
            $table->string('titolo');

            // slug per URL tipo /opera/titolo-dell-opera
            $table->string('slug')->unique();

            // prezzo (facoltativo), es. 2500.00
            $table->decimal('prezzo', 10, 2)->nullable();

            // se è stata venduta o no
            $table->boolean('venduto')->default(false);

            // dimensioni in cm (puoi cambiare tipo se vuoi i decimali)
            $table->decimal('larghezza_cm', 8, 2)->nullable();
            $table->decimal('altezza_cm', 8, 2)->nullable();

            // descrizione lunga in HTML (per WYSIWYG a frontend)
            $table->longText('descrizione_html')->nullable();

            // opera su commissione o no
            $table->boolean('commissione')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opere');
    }
};

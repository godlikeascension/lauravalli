<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collezioni', function (Blueprint $table) {
            $table->string('nome_en')->nullable()->after('nome');
            $table->string('nome_es')->nullable()->after('nome_en');
            $table->string('slug_en')->nullable()->unique()->after('slug');
            $table->string('slug_es')->nullable()->unique()->after('slug_en');
            $table->text('descrizione_en')->nullable()->after('descrizione');
            $table->text('descrizione_es')->nullable()->after('descrizione_en');
        });
    }

    public function down(): void
    {
        Schema::table('collezioni', function (Blueprint $table) {
            $table->dropColumn(['nome_en', 'nome_es', 'slug_en', 'slug_es', 'descrizione_en', 'descrizione_es']);
        });
    }
};

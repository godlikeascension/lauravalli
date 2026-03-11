<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recensioni', function (Blueprint $table) {
            $table->text('testo_en')->nullable()->after('testo');
            $table->text('testo_es')->nullable()->after('testo_en');
            $table->string('nome_en')->nullable()->after('nome');
            $table->string('nome_es')->nullable()->after('nome_en');
        });
    }

    public function down(): void
    {
        Schema::table('recensioni', function (Blueprint $table) {
            $table->dropColumn(['testo_en', 'testo_es', 'nome_en', 'nome_es']);
        });
    }
};

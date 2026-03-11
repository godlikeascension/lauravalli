<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->string('titolo_en')->nullable()->after('titolo');
            $table->string('titolo_es')->nullable()->after('titolo_en');
            $table->text('descrizione_html_en')->nullable()->after('descrizione_html');
            $table->text('descrizione_html_es')->nullable()->after('descrizione_html_en');
            $table->string('slug_en')->nullable()->unique()->after('slug');
            $table->string('slug_es')->nullable()->unique()->after('slug_en');
        });
    }

    public function down(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->dropColumn(['titolo_en', 'titolo_es', 'descrizione_html_en', 'descrizione_html_es', 'slug_en', 'slug_es']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('domanda_en')->nullable()->after('domanda');
            $table->string('domanda_es')->nullable()->after('domanda_en');
            $table->text('risposta_html_en')->nullable()->after('risposta_html');
            $table->text('risposta_html_es')->nullable()->after('risposta_html_en');
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['domanda_en', 'domanda_es', 'risposta_html_en', 'risposta_html_es']);
        });
    }
};

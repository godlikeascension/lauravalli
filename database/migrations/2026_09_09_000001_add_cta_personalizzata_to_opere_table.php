<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->boolean('cta_personalizzata')->default(false)->after('commissione');
            $table->string('cta_tipo', 20)->nullable()->after('cta_personalizzata');
            $table->string('cta_label')->nullable()->after('cta_tipo');
            $table->string('cta_label_en')->nullable()->after('cta_label');
            $table->string('cta_label_es')->nullable()->after('cta_label_en');
            $table->string('cta_whatsapp', 32)->nullable()->after('cta_label_es');
            $table->string('cta_url', 2048)->nullable()->after('cta_whatsapp');
        });
    }

    public function down(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->dropColumn([
                'cta_personalizzata',
                'cta_tipo',
                'cta_label',
                'cta_label_en',
                'cta_label_es',
                'cta_whatsapp',
                'cta_url',
            ]);
        });
    }
};

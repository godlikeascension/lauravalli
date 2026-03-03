<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->foreignId('collezione_id')
                  ->nullable()
                  ->constrained('collezioni')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->dropForeign(['collezione_id']);
            $table->dropColumn('collezione_id');
        });
    }
};

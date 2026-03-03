<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->string('opera_type')->nullable()->after('altezza_cm');
            $table->smallInteger('year')->unsigned()->nullable()->after('opera_type');
        });
    }

    public function down(): void
    {
        Schema::table('opere', function (Blueprint $table) {
            $table->dropColumn(['opera_type', 'year']);
        });
    }
};

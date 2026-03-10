<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collezioni', function (Blueprint $table) {
            $table->unsignedInteger('ordine')->default(0)->after('is_featured');
        });

        // Assign initial ordine based on existing creation order
        $rows = DB::table('collezioni')->orderBy('id')->pluck('id');
        foreach ($rows as $i => $id) {
            DB::table('collezioni')->where('id', $id)->update(['ordine' => $i + 1]);
        }

        Schema::table('collezioni', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }

    public function down(): void
    {
        Schema::table('collezioni', function (Blueprint $table) {
            $table->boolean('is_default')->default(false)->after('descrizione');
            $table->dropColumn('ordine');
        });
    }
};

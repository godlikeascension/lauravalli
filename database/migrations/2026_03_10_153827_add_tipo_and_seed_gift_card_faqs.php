<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('tipo', 20)->default('commissioni')->after('ordine');
        });

        // Mark existing rows as commissioni FAQs
        \Illuminate\Support\Facades\DB::table('faqs')->update(['tipo' => 'commissioni']);

        // Seed gift-card FAQs
        \Illuminate\Support\Facades\DB::table('faqs')->insert([
            [
                'domanda'     => 'Posso scegliere qualsiasi importo?',
                'risposta_html' => '<p>Sì, puoi selezionare tra le opzioni disponibili o richiedere un importo personalizzato.</p>',
                'ordine'      => 1,
                'tipo'        => 'gift-card',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'domanda'     => 'Quanto dura la gift card?',
                'risposta_html' => '<p>Non ha scadenza: potrà essere utilizzata in qualsiasi momento.</p>',
                'ordine'      => 2,
                'tipo'        => 'gift-card',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'domanda'     => 'Come verrà consegnata?',
                'risposta_html' => '<p>Dopo l\'acquisto riceverai un PDF via email, pronto da stampare o inoltrare.</p>',
                'ordine'      => 3,
                'tipo'        => 'gift-card',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'domanda'     => 'E se il dipinto costa di più del valore del buono?',
                'risposta_html' => '<p>Nessun problema: il destinatario potrà aggiungere la differenza al momento della commissione.</p>',
                'ordine'      => 4,
                'tipo'        => 'gift-card',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }

    public function down(): void
    {
        \Illuminate\Support\Facades\DB::table('faqs')->where('tipo', 'gift-card')->delete();

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
};

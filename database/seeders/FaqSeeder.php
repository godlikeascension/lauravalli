<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'domanda'      => 'Quanto tempo serve per una commissione?',
                'risposta_html' => '<p>Ogni opera richiede cura, tempo e presenza. La tempistica media varia da <strong>3 a 6 settimane</strong>, in base alla complessità e alla lista d\'attesa. Sarai sempre aggiornata/o su ogni fase del processo.</p>',
                'ordine'       => 1,
            ],
            [
                'domanda'      => 'Posso richiedere modifiche?',
                'risposta_html' => '<p>Sì. Al momento del bozzetto digitale terrò conto di tutti i tuoi input prima di iniziare l\'opera originale ad olio. Durante la realizzazione ti invierò aggiornamenti e foto, così potrai seguire passo dopo passo la nascita del dipinto.</p>',
                'ordine'       => 2,
            ],
            [
                'domanda'      => 'Quali misure sono disponibili?',
                'risposta_html' => '<p>La dimensione minima è <strong>30 × 40 cm</strong>.<br>Al momento la più grande è <strong>240 × 120 cm</strong>.<br>Per formati personalizzati possiamo confrontarci e trovare la soluzione più adatta a te.</p>',
                'ordine'       => 3,
            ],
            [
                'domanda'      => 'Come viene spedita l\'opera?',
                'risposta_html' => '<p>Ogni dipinto è accuratamente protetto e spedito in tutto il mondo. Puoi scegliere tra:</p><ul><li>Spedizione del quadro montato (stirato sul telaio)</li><li>Spedizione solo della tela arrotolata in un tubo in PVC</li></ul>',
                'ordine'       => 4,
            ],
            [
                'domanda'      => 'Prezzi indicativi',
                'risposta_html' => '<p><strong>Olio su tela</strong></p><ul><li>30 × 40 cm → 220 €</li><li>60 × 80 cm → 450 €</li><li>60 × 120 cm → 520 €</li><li>120 × 120 cm → 850 €</li><li>240 × 120 cm → 1.850 €</li></ul><p><strong>Olio su carta 300 g</strong></p><ul><li>30 × 40 cm → 150 €</li><li>65 × 50 cm → 300 €</li></ul><p><em>Spese di spedizione escluse.</em><br>Se desideri un formato diverso, scrivimi: creeremo insieme la soluzione perfetta.</p>',
                'ordine'       => 5,
            ],
            [
                'domanda'      => 'Modalità di pagamento',
                'risposta_html' => '<p>Il pagamento è diviso in 3 fasi:</p><ul><li><strong>30%</strong> all\'ordine – per riservare la tua commissione (non rimborsabile)</li><li><strong>30%</strong> all\'inizio del lavoro – prima della fase di bozzetto</li><li><strong>40% + spedizione</strong> – entro 7 giorni dalla consegna del dipinto</li></ul><p>Prima di iniziare riceverai via email un preventivo dettagliato da firmare e approvare.</p>',
                'ordine'       => 6,
            ],
        ];

        DB::table('faqs')->insert($faqs);
    }
}

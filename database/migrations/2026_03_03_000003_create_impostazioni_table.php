<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impostazioni', function (Blueprint $table) {
            $table->id();
            $table->string('chiave')->unique();
            $table->longText('valore')->nullable();
            $table->timestamps();
        });

        // Seed del contenuto attuale della pagina artist-statement
        DB::table('impostazioni')->insert([
            'chiave'     => 'artist_statement',
            'valore'     => <<<'HTML'
<div class="col-lg-10 mb-6 sm-mb-35px last-paragraph-no-margin text-center" style="padding-top:100px;">
    <img src="/images/atfas1.jpg" style="border-radius: 20px;" class="mb-20px" alt="">
</div>
<div class="col-lg-10 mb-6 sm-mb-35px">
    <h4 class="alt-font text-dark-gray fw-600 ls-minus-1px w-90 md-w-100">
        <span style="font-style: italic">"Siamo fatti di mille sbavature e imperfezioni e questo ci rende unici"</span> - Laura Valli
    </h4>
    <div class="row">
        <div class="col-lg-6 last-paragraph-no-margin md-mb-30px">
            <p class="w-90 lg-w-100">
                Sono un'artista italiana residente a Tenerife.<br>
                Ho iniziato a dipingere in uno dei momenti più bui della mia vita: tre anni
                segnati da attacchi di panico costanti e da una depressione che mi aveva
                svuotata.<br><br>
                Un giorno ho comprato una tela e ho ricominciato a respirare.
                La pittura è diventata il mio rifugio e il mio strumento di guarigione.<br><br>
                Un mezzo per comprendere ciò che non riuscivo a dire, per dare forma alle
                emozioni più profonde.
            </p>
        </div>
        <div class="col-lg-6 last-paragraph-no-margin">
            <p class="w-90 lg-w-100">
                Dipingo per analizzarmi, per ritrovarmi, per esistere con autenticità.
                Attraverso l'olio su tela esploro la psiche umana: dipingo bambini, animali e
                figure evocative, spesso non definite, per rappresentare l'anima nella sua
                verità, senza maschere. Unisco figurativo e astratto, per raccontare la fragilità come forza e
                l'autenticità come atto rivoluzionario.<br><br>
                L'arte, per me, è sopravvivenza.
                È la forma primordiale con cui l'essere umano dice al mondo:<br>
                <span style="font-style: italic; font-weight: 700">"Io ci sono. Esisto. E sono vero."</span>
            </p>
        </div>
    </div>
</div>
<div class="col-lg-10 mb-6 sm-mb-35px last-paragraph-no-margin text-center">
    <img src="/images/about1.jpg" style="border-radius: 20px;" class="mb-20px" alt="">
</div>
<div class="col-lg-10 mb-6 sm-mb-35px last-paragraph-no-margin">
    <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px w-95 md-w-100">Biografia</h3>
    <p class="w-90 lg-w-100">
        Laura Valli, attraverso la pittura ad olio esplora la sfera emotiva e psicologica
        dell'essere umano.<br>
        Affascinata dallo spirito espressivo del Rinascimento, concentra la sua
        ricerca sui moti dell'anima, traducendoli in pennellate marcate, colori
        simbolici e una fusione tra figurativo e astratto.<br><br>
        I suoi soggetti - bambini, animali e volti non sempre definiti - emergono
        come specchi interiori, richiamando emozioni che la società tende a
        reprimere.<br><br>
        Le sue opere, che definisce psicologiche, nascono da un processo di ascolto
        profondo e invitano l'osservatore a riconnettersi con la propria autenticità,
        trasformando fragilità e dolore in forza espressiva.
        Ogni lavoro diventa così un ponte silenzioso tra arte e introspezione.<br><br>
        <span style="font-style:italic; font-weight: 700;">"Noi non siamo solo un corpo.
        Il corpo è uno strumento di espressione."</span>
    </p>
</div>
<div class="col-lg-10 mb-6 sm-mb-35px">
    <div class="row">
        <div class="col-md-6 sm-mb-30px text-center">
            <img style="border-radius: 20px;" class="mb-20px" src="/images/about4.jpg" alt="">
        </div>
        <div class="col-md-6 text-center">
            <img style="border-radius: 20px;" class="mb-20px" src="/images/about5.jpg" alt="">
        </div>
    </div>
</div>
<div class="col-lg-10 last-paragraph-no-margin">
    <h4 class="alt-font text-dark-gray fw-600 ls-minus-1px w-90 md-w-100">Un messaggio importante</h4>
    <h5 class="alt-font text-dark-gray fw-600 ls-minus-1px w-90 md-w-100">Arte e salute mentale</h5>
    <p class="mb-6 w-90 lg-w-100">
        La pittura mi ha salvato la vita.<br><br>
        Dopo tre anni di attacchi di panico e depressione, vedevo la vita in bianco e nero.<br>
        Tutto era arido. Non conoscevo quello che sentivo, non sapevo come gestirlo… mi stava divorando.<br><br>
        Un giorno mi sono alzata dal letto, sono andata a comprare una tela, pennelli e colori.<br>
        Per venti minuti, nella mia giornata buia, ero presente. Serena. L'oscurità si era diradata.<br><br>
        Da quel momento ho capito che la pittura è per me <span style="font-weight:700">vitale</span>, e il mio desiderio più
        grande è trasmettere questa passione a quante più persone possibili.<br><br>
        La mia maestra mi diceva:<br>
        "Se vuoi essere felice per un anno, innamorati.<br>
        Se vuoi essere felice per tutta la vita, diventa giardiniere."<br><br>
        Un giardiniere non forza la crescita.<br>
        Osserva. Cura. Attende.<br><br>
        E noi? Abbiamo dimenticato di osservarci.<br>
        Ci siamo persi nell'illusione che tutto debba accadere in fretta, che il valore di
        una vita sia determinato da un pezzo di carta o dal giudizio degli altri.<br><br>
        L'anima ha fame ogni giorno.<br>
        È come un campo:<br>
        va nutrita, coltivata, protetta.<br><br>
        Quando smettiamo di prendercene cura, il cuore si inaridisce.<br>
        E, invece di annaffiarlo, finiamo per invidiare i fiori del vicino.<br>
        Odiamo ciò che vediamo fuori…<br>
        perché ci siamo dimenticati della <span style="font-weight:700">luce che abbiamo dentro.</span><br><br>
        L'arte è storia, ed è lo specchio dell'essere umano.<br>
        Ci ricorda chi siamo, ci permette di scavare dentro di noi e di dare luce alla nostra unicità.<br><br>
        Per questo vivo l'arte come un <span style="font-weight:700">processo alchemico:</span><br>
        trasforma il dolore in espressione, la fragilità in forza, il silenzio in vita.
    </p>
</div>
<div class="col-lg-10 mb-6 sm-mb-35px last-paragraph-no-margin text-center">
    <img src="/images/about6.jpg" style="border-radius: 20px;" class="mb-20px" alt="">
</div>
HTML,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('impostazioni');
    }
};

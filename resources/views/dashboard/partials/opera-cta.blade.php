@php
    /** @var \App\Models\Opera|null $opera */
    $opera = $opera ?? null;

    // Con una checkbox, old() è assente quando è stata deselezionata: distinguo
    // "form ricaricato dopo un errore" da "primo caricamento".
    $haOldInput = session()->hasOldInput();
    $ctaAttiva  = $haOldInput
        ? (bool) old('cta_personalizzata')
        : (bool) ($opera->cta_personalizzata ?? false);
    $ctaTipo    = old('cta_tipo', $opera->cta_tipo ?? '');
@endphp

<hr class="my-4">

<div class="mb-3 form-check form-switch">
    <input type="checkbox"
           name="cta_personalizzata"
           id="cta_personalizzata"
           value="1"
           class="form-check-input"
        {{ $ctaAttiva ? 'checked' : '' }}>
    <label class="form-check-label" for="cta_personalizzata">Bottone personalizzato</label>
    <div class="form-text">
        Se attivo, sostituisce il bottone “Invia un messaggio” nella pagina dell'opera.
    </div>
</div>

<div id="cta-panel" class="border rounded p-3 mb-3 {{ $ctaAttiva ? '' : 'd-none' }}" style="background:#fafbfe;">

    <div class="mb-3">
        <label for="cta_tipo" class="form-label">Tipo di bottone</label>
        <select name="cta_tipo" id="cta_tipo" class="form-select" style="max-width:320px;">
            <option value="">— Seleziona —</option>
            <option value="whatsapp" {{ $ctaTipo === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
            <option value="link" {{ $ctaTipo === 'link' ? 'selected' : '' }}>Link esterno</option>
        </select>
    </div>

    <div class="mb-1"><label class="form-label">Etichetta del bottone</label></div>
    <div class="row g-3 mb-2">
        <div class="col-md-4">
            <label class="form-label text-muted fs-12 mb-1">🇮🇹 Italiano</label>
            <input type="text"
                   name="cta_label"
                   class="form-control"
                   maxlength="60"
                   placeholder="es. Scrivimi su WhatsApp"
                   value="{{ old('cta_label', $opera->cta_label ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label text-muted fs-12 mb-1">🇬🇧 English</label>
            <input type="text"
                   name="cta_label_en"
                   class="form-control"
                   maxlength="60"
                   placeholder="es. Message me on WhatsApp"
                   value="{{ old('cta_label_en', $opera->cta_label_en ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label text-muted fs-12 mb-1">🇪🇸 Español</label>
            <input type="text"
                   name="cta_label_es"
                   class="form-control"
                   maxlength="60"
                   placeholder="es. Escríbeme por WhatsApp"
                   value="{{ old('cta_label_es', $opera->cta_label_es ?? '') }}">
        </div>
    </div>
    <small class="form-text text-muted d-block mb-3">
        L'italiano è obbligatorio. Se EN o ES restano vuoti, viene mostrata l'etichetta italiana.
    </small>

    <div id="cta-field-whatsapp" class="{{ $ctaTipo === 'whatsapp' ? '' : 'd-none' }}">
        <label for="cta_whatsapp" class="form-label">Numero WhatsApp</label>
        <input type="text"
               name="cta_whatsapp"
               id="cta_whatsapp"
               class="form-control"
               style="max-width:320px;"
               placeholder="+39 333 1234567"
               value="{{ old('cta_whatsapp', $opera->cta_whatsapp ?? '') }}">
        <small class="form-text text-muted">
            Formato internazionale con prefisso, es. <code>+39 333 1234567</code>.
            Il messaggio precompilato è in spagnolo se il sito è in spagnolo
            (<em>«Hola, estoy interesado en la obra …»</em>), altrimenti in inglese
            (<em>«Hi, I'm interested in the artwork …»</em>).
        </small>
    </div>

    <div id="cta-field-link" class="{{ $ctaTipo === 'link' ? '' : 'd-none' }}">
        <label for="cta_url" class="form-label">Link</label>
        <input type="url"
               name="cta_url"
               id="cta_url"
               class="form-control"
               placeholder="https://esempio.com/pagina"
               value="{{ old('cta_url', $opera->cta_url ?? '') }}">
        <small class="form-text text-muted">
            Deve iniziare con <code>https://</code>. Si apre in una nuova scheda.
        </small>
    </div>

</div>

<script>
    (function () {
        var toggle = document.getElementById('cta_personalizzata');
        var panel  = document.getElementById('cta-panel');
        var tipo   = document.getElementById('cta_tipo');
        var campi  = {
            whatsapp: document.getElementById('cta-field-whatsapp'),
            link:     document.getElementById('cta-field-link')
        };

        function aggiornaCampi() {
            Object.keys(campi).forEach(function (chiave) {
                campi[chiave].classList.toggle('d-none', tipo.value !== chiave);
            });
        }

        toggle.addEventListener('change', function () {
            panel.classList.toggle('d-none', !toggle.checked);
        });

        tipo.addEventListener('change', aggiornaCampi);
    })();
</script>

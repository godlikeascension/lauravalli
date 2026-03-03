<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Modifica Collezione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="loading" data-layout-mode="horizontal"
      data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>

<div id="wrapper">
    @include('inc.auth.navbar')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row mt-4">
                    <div class="col-12">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $errore)
                                        <li>{{ $errore }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title mb-0">Modifica collezione #{{ $collezione->id }}</h4>
                                    <a href="{{ route('dashboard.collezioni.index') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle collezioni
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.collezioni.update', $collezione->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome della collezione <span class="text-danger">*</span></label>
                                        <input type="text"
                                               name="nome"
                                               id="nome"
                                               class="form-control"
                                               value="{{ old('nome', $collezione->nome) }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descrizione" class="form-label">Descrizione (opzionale)</label>
                                        <textarea name="descrizione"
                                                  id="descrizione"
                                                  rows="4"
                                                  class="form-control">{{ old('descrizione', $collezione->descrizione) }}</textarea>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="is_default"
                                               id="is_default"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('is_default', $collezione->is_default) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_default">
                                            Collezione <strong>default</strong>
                                            <small class="text-muted">(mostrata nella pagina /collezione)</small>
                                        </label>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="is_featured"
                                               id="is_featured"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('is_featured', $collezione->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Collezione <strong>featured</strong>
                                            <small class="text-muted">(mostrata in homepage)</small>
                                        </label>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.collezioni.index') }}" class="btn btn-light me-2">
                                            Annulla
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva modifiche
                                        </button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                        {{-- Opere nella collezione --}}
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title mb-0">
                                        Opere in questa collezione
                                        <span class="badge bg-secondary ms-1">{{ $collezione->opere->count() }}</span>
                                    </h4>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover m-0 table-centered nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Immagine</th>
                                            <th>Titolo</th>
                                            <th>Prezzo</th>
                                            <th>Dimensioni</th>
                                            <th>Rimuovi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($collezione->opere as $opera)
                                            <tr>
                                                <td>
                                                    @if($opera->immagine)
                                                        <img src="{{ asset('storage/' . $opera->immagine) }}"
                                                             alt="Immagine opera"
                                                             style="height: 50px; width: 50px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $opera->titolo }}</td>
                                                <td>
                                                    @if($opera->venduto)
                                                        <span class="badge bg-danger">SOLD</span>
                                                    @elseif(!is_null($opera->prezzo))
                                                        € {{ number_format($opera->prezzo, 2, ',', '.') }}
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $opera->dimensioni ?? '—' }}</td>
                                                <td>
                                                    <form action="{{ route('dashboard.collezioni.opere.remove', [$collezione->id, $opera->id]) }}"
                                                          method="POST"
                                                          style="display:inline-block;"
                                                          onsubmit="return confirm('Rimuovere questa opera dalla collezione?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-danger">
                                                            <i class="mdi mdi-minus-circle"></i> Rimuovi
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    Nessuna opera in questa collezione.
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Aggiungi opera --}}
                                @if($opereDisponibili->count())
                                    <hr class="mt-4">
                                    <h5 class="mb-3">Aggiungi un'opera a questa collezione</h5>
                                    <form action="{{ route('dashboard.collezioni.opere.add', $collezione->id) }}"
                                          method="POST"
                                          class="d-flex align-items-center gap-2">
                                        @csrf
                                        <select name="opera_id" class="form-select" style="max-width: 400px;" required>
                                            <option value="">— Seleziona un'opera —</option>
                                            @foreach($opereDisponibili as $op)
                                                <option value="{{ $op->id }}">
                                                    {{ $op->titolo }}
                                                    @if($op->collezione_id)
                                                        (attualmente in: {{ $op->collezione->nome ?? '?' }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-blue waves-effect waves-light">
                                            <i class="mdi mdi-plus-circle me-1"></i> Aggiungi
                                        </button>
                                    </form>
                                @endif

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div> <!-- content -->
    </div> <!-- content-page -->
</div> <!-- END wrapper -->

<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

</body>
</html>

@extends('layouts.app')
@section('title', 'Pokèdex')

@section('content')
    @if ($all_pokemon->isEmpty())
        <div class="alert alert-warning text-center shadow-sm mb-5" style="border-radius: 15px;">
            <h1 class="display-6 fw-bold text-uppercase">Nessun risultato trovato</h1>
            <p>La ricerca non ha prodotto risultati.</p>
            <div class="text-start mt-4">
                <a href="{{ route('pokemon.index') }}" class="text-decoration-none text-muted fw-bold">
                    <i class="bi bi-arrow-left"></i> Torna alla lista pokemon
                </a>
            </div>
        </div>
    @endif
    <div class="container py-5">
        <h1 class="fw-bold mb-2 text-center w-100" style="color: #dc3545; letter-spacing: 2px;">
            POKÉDEX
        </h1>

        <p class="lead text-muted text-center mb-5 mx-auto" style="max-width: 700px;">
            Analizza la tua collezione Pokémon, o ricercane uno specifico
        </p>


        <div class="text-center mb-5">
            <a href="{{ route('pokemon.create') }}" class="btn btn-primary fw-bold shadow-sm px-4 py-2"
                style="border-radius: 50px;">
                Aggiungi un nuovo Pokemon! <i class="bi bi-plus-lg ms-1"></i>
            </a>
        </div>

        {{-- Form di Ricerca --}}
        <div class="card shadow-sm border-0 p-4 mb-5 sticky-top"
            style="top: 70px; z-index: 999; border-radius: 20px; background-color: #f8f9fa;">
            <form action="{{ route('pokemon.index') }}" method="GET" novalidate>
                <h3 class="h5 fw-bold mb-4 text-uppercase text-secondary">Ricerca una generazione specifica</h3>

                <div class="row g-3">
                    {{-- Prima riga: Nome --}}
                    <div class="col-12">
                        <label for="name" class="form-label small fw-bold text-dark">Ricerca per nome</label>
                        <input type="text" name="name" id="name"
                            class="form-control border-0 shadow-sm py-2 @error('name') is-invalid @enderror"
                            placeholder="Esempio: Blaziken, Mudikip, ...">
                    </div>

                    {{-- Seconda riga: Tipo e Numero --}}
                    <div class="col-md-4">
                        <label for="type" class="form-label small fw-bold text-dark">Ricerca per tipo</label>
                        <select name="type" id="type" class="form-select border-0 shadow-sm">
                            <option value="" selected>Scegli tipo...</option>
                            @foreach ($all_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label for="number" class="form-label small fw-bold text-dark">Ricerca per numero
                            generazione</label>
                        <input type="number" name="number" id="number" min="1" max="100"
                            class="form-control border-0 shadow-sm @error('number') is-invalid @enderror"
                            placeholder="Esempio: 1, 2, ...">
                    </div>

                    {{-- Terza riga: Regione e Bottoni --}}
                    <div class="col-md-8">
                        <label for="region" class="form-label small fw-bold text-dark">Ricerca per regione</label>
                        <select name="region" id="region" class="form-select border-0 shadow-sm">
                            <option value="" selected>Scegli regione...</option>
                            @foreach ($all_gen as $gen)
                                <option value="{{ $gen->id }}">{{ $gen->region }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-dark fw-bold px-4 flex-grow-1 shadow-sm"
                            style="border-radius: 10px; height: 38px;">
                            Cerca!
                        </button>
                        <div class="text-start mt-4 mb-4">
                            <a href="{{ route('pokemon.index') }}" class="text-decoration-none text-muted fw-bold "
                                style="border: solid 1px grey">
                                <i class="bi bi-arrow-left"></i> Torna a lista pokemon
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4">
            @foreach ($all_pokemon as $pokemon)
                <div class="col">
                    <div class="card h-100 shadow-sm">

                        <div class="card-header bg-transparent border-bottom-0 pt-3">
                            <h6 class="card-title mb-1 text-truncate">
                                <span class="fw-bold">Nome:</span>
                                <a href="{{ route('pokemon.show', $pokemon) }}"
                                    class="text-decoration-none">{{ $pokemon->name }}</a>
                            </h6>

                            <span class="fw-bold">Tipo:</span>
                            @foreach ($pokemon->types as $type)
                                <a href="{{ route('type.show', $type) }}"
                                    class="text-decoration-none">{{ $type->name }}</a>
                                @if (!$loop->last)
                                    /
                                @endif
                            @endforeach

                            <small class="text-muted d-block">
                                <strong>Generazione:</strong> {{ $pokemon->getGenerationNumber() }}ª
                                <span class="text-mutedmx-2">/</span>
                                <a href="{{ route('generation.show', $pokemon->generation->id) }}"
                                    class="text-decoration-none">{{ $pokemon->getRegion() }}</a>
                            </small>
                        </div>

                        <div class="text-center p-2">
                            <a href="{{ route('pokemon.show', $pokemon) }}">
                                <img src="{{ Storage::url($pokemon->image) }}" class="img-fluid rounded"
                                    style="max-height: 150px; filter: contrast(100%) brightness(110%);"
                                    alt="{{ $pokemon->name }}">
                            </a>
                        </div>

                        <div class="card-body py-2">
                            <p class="card-text small text-secondary"
                                style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $pokemon->getDescription() }}
                            </p>
                        </div>

                        <div class="card-footer bg-transparent border-top-0 pb-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('pokemon.show', $pokemon) }}" class="btn btn-outline-primary btn-sm">
                                    Vai ai dettagli
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

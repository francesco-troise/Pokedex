@extends('layouts.app')
@section('title', 'Pokèdex')

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold mb-2 text-center w-100" style="color: #dc3545; letter-spacing: 2px;">
            POKÉDEX
        </h1>

        <p class="lead text-muted text-center mb-5 mx-auto" style="max-width: 700px;">
            Analizza i dettagli di un singolo Pokémon, o ricercane uno specifico
        </p>
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

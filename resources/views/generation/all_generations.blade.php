@extends('layouts.app')
@section('title', 'Le generazioni')

@section('content')

    @if ($generations->isEmpty())
        <div class="alert alert-warning text-center shadow-sm mb-5" style="border-radius: 15px;">
            <h1 class="display-6 fw-bold text-uppercase">Nessun risultato trovato</h1>
            <p>La ricerca per la generazione inserita non ha prodotto risultati.</p>
            <div class="text-start mt-4">
                <a href="{{ route('generation.index') }}" class="text-decoration-none text-muted fw-bold">
                    <i class="bi bi-arrow-left"></i> Torna alla lista delle generazioni
                </a>
            </div>
        </div>
    @endif


    <div class="mb-5">
        <a href="{{ route('generation.create') }}" class="btn btn-primary fw-bold shadow-sm px-4 py-2"
            style="border-radius: 12px;">
            Aggiungi una nuova generazione! <i class="bi bi-chevron-right"></i>
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4 mb-5 "
        style=" top: 70px; z-index: 999; border-radius: 20px; background-color: #f8f9fa;">
        <form action="{{ route('generation.index') }}" method="GET" novalidate>
            <h3 class="h5 fw-bold mb-3 text-uppercase text-secondary">Ricerca una generazione specifica</h3>

            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="region" class="form-label small fw-bold">Ricerca per regione</label>
                    <input type="text" name="region" id="region" class="form-control border-0 shadow-sm py-2 "
                        required placeholder="Esempio: Kanto, Johto...">
                    @error('name')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                    <label for="number" class="form-label small fw-bold">Ricerca per numero generazione</label>
                    <input type="number" name="number" id="number" min="1" max="100"
                        class="form-control border-0 shadow-sm py-2 " required placeholder="Esempio: 1, 2, ...">
                    @error('number')
                        {{ $message }}
                    @enderror
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <button type="submit" class="btn btn-dark fw-bold px-4 py-2 shadow-sm me-3"
                        style="border-radius: 10px;">
                        Cerca!
                    </button>
                    <div class="text-start mt-4 mb-4">
                        <a href="{{ route('generation.index') }}" class="text-decoration-none text-muted fw-bold "
                            style="border: solid 1px grey">
                            <i class="bi bi-arrow-left"></i> Torna a lista generazioni
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            @foreach ($generations as $generation)
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow position-relative overflow-hidden"
                        style="border-radius: 20px; min-height: 280px;">

                        <img src="{{ Storage::url($generation->region_image) }}" class="position-absolute w-100 h-100"
                            style="   object-fit: cover; object-position: top; z-index: 0;" alt="{{ $generation->region }}">


                        <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.2); z-index: 1;"></div>

                        <div class="card-body d-flex flex-column justify-content-between position-relative p-4"
                            style="z-index: 2;">
                            <div>

                                <h2 class="fw-bold px-3 py-2 d-inline-block text-white"
                                    style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; font-size: 1.5rem;">
                                    {{ $generation->number }}° -{{ $generation->region }}
                                </h2>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('generation.show', $generation) }}"
                                    class="btn btn-light fw-bold shadow-sm px-4 py-2"
                                    style="border-radius: 12px; border: none;">
                                    Vai ai dettagli di {{ $generation->region }} <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

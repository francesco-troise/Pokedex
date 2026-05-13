@extends('layouts.app')
@section('title', 'Le tipologie')

@section('content')


    @if ($all_types->isEmpty())
        <div class="alert alert-warning text-center shadow-sm mb-5" style="border-radius: 15px;">
            <h1 class="display-6 fw-bold text-uppercase">Nessun risultato trovato</h1>
            <p>La ricerca per il nome inserito non ha prodotto risultati.</p>
            <div class="text-start mt-4">
                <a href="{{ route('type.index') }}" class="text-decoration-none text-muted fw-bold">
                    <i class="bi bi-arrow-left"></i> Torna alla lista tipi
                </a>
            </div>
        </div>
    @endif

    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Tutti i <span class="text-primary">Tipi</span> presenti nel tuo database!</h1>
        <p class="lead text-muted">Nuovo pokemon rilasciato? Se il Tipo è inedito, aggiungilo!</p>

        <div class="mt-4">
            <a href="{{ route('type.create') }}" class="btn btn-primary btn-lg fw-bold shadow-sm px-4 py-2"
                style="border-radius: 50px;">
                Aggiungi una nuova tipologia! <i class="bi bi-chevron-right ms-2"></i>
            </a>
        </div>
    </div>


    <div class="card shadow-sm border-0 p-4 mb-5 sticky-top"
        style=" top: 70px; z-index: 999; border-radius: 20px; background-color: #f8f9fa;">
        <form action="{{ route('type.index') }}" method="GET" novalidate>
            <h3 class="h5 fw-bold mb-3 text-uppercase text-secondary">Ricerca una tipologia specifica</h3>

            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="name" class="form-label small fw-bold">Ricerca per nome</label>
                    <input type="text" name="name" id="name"
                        class="form-control border-0 shadow-sm py-2 @error('name') is-invalid @enderror" required
                        placeholder="Esempio: Erba, Fuoco...">
                    @error('name')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <button type="submit" class="btn btn-dark fw-bold px-4 py-2 shadow-sm me-3"
                        style="border-radius: 10px;">
                        Cerca!
                    </button>
                    <div class="text-start mt-4 mb-4">
                        <a href="{{ route('type.index') }}" class="text-decoration-none text-muted fw-bold "
                            style="border: solid 1px grey">
                            <i class="bi bi-arrow-left"></i> Torna a lista tipi
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- Sezione Ricerca --}}


    <div class=" mt-1 row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
        @foreach ($all_types as $type)
            <div class="col">
                <div class="card h-100 shadow-sm text-center border-dark" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header bg-transparent border-0 pt-4 text-center">
                        <p class="text-uppercase small fw-bold mb-0 text-muted">Tipologia</p>

                        <h3 class="fw-bold mb-0 d-flex justify-content-center align-items-center gap-2">

                            <x-type_badge :color="$type->getTypeColor()" />

                            <a href="{{ route('type.show', $type) }}" class="text-decoration-none text-dark">
                                {{ $type->name }}
                            </a>
                        </h3>
                    </div>

                    <div class="card-body d-flex align-items-center justify-content-center p-0"
                        style="min-height: 300px; background-color: #f8f9fa;">
                        <img src="{{ Storage::url($type->image) }}" alt="{{ $type->name }}" class="img-fluid w-100"
                            style="max-height: 300px; object-fit: cover;">
                    </div>

                    <div class="card-footer p-0 border-top border-dark">
                        <div class="d-flex">
                            <a href="{{ route('type.show', $type) }}"
                                class="btn btn-outline-primary rounded-0 w-50 border-end border-dark py-3 fw-bold">
                                VAI AI DETTAGLI
                            </a>
                            <a href="{{ route('type.edit', $type) }}" class="btn btn-warning rounded-0 w-50 py-3 fw-bold">
                                <i class="bi bi-pencil"></i> MODIFICA
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection

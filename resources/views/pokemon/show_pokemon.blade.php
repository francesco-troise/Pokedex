@extends('layouts.app')
@section('title', $pokemon->name)

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">

            <div class="card-header  text-white p-3"
                style="background-color: {{ $pokemon->types->first()->getTypeColor() }};">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fw-bold">{{ $pokemon->name }} -Scheda dettaglio</h2>
                    <div>
                        <b>Tipo:</b>
                        @foreach ($pokemon->types as $type)
                            <a
                                href="{{ route('type.show', $type) }}"class="badge bg-light text-primary text-decoration-none me-1">
                                {{ $type->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img src="{{ Storage::url($pokemon->image) }}" alt="{{ $pokemon->name }}"
                            class="img-fluid rounded border p-2 bg-light">
                    </div>

                    <div class="col-md-7">
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item px-0">
                                <strong>Generazione:</strong> {{ $pokemon->getGenerationNumber() }}ª
                                <span class="text-mutedmx-2">/</span>
                                <a href="{{ route('generation.show', $pokemon->generation) }}"
                                    class="text-decoration-none">{{ $pokemon->getRegion() }}</a>
                            </li>
                            <li class="list-group-item px-0">
                                <strong>Altezza:</strong> {{ $pokemon->getHeight() }} mt
                            </li>
                            <li class="list-group-item px-0">
                                <strong>Peso:</strong> {{ $pokemon->getweight() }} Kg
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold border-bottom pb-2">Descrizione</h5>
                    <p class="text-secondary">{{ $pokemon->getDescription() }}</p>
                </div>
            </div>

            <div class="card-footer bg-light p-3">
                <div class="d-flex justify-content-between align-items-center">

                    <a href="{{ route('pokemon.edit', $pokemon) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifica {{ $pokemon->name }}
                    </a>

                    <form action="{{ route('pokemon.destroy', $pokemon) }}" method="POST" class="m-0"
                        onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente {{ $pokemon->name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Elimina {{ $pokemon->name }}
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('pokemon.index') }}" class="btn btn-outline-secondary">
                Torna ai pokemon
            </a>
        </div>
    </div>
@endsection

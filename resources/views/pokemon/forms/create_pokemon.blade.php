@extends('layouts.app')
@section('title', 'Aggiungi un nuovo pokemon')

@section('content')
    <div class="container-fluid py-5 bg-light min-vh-100">
        <div class="container">
            <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf


                <div class="row mb-5">
                    <div class="col-12">
                        <div class="bg-white p-4 shadow-sm text-center border-start border-primary border-5 rounded-3">
                            <h1 class="m-0 h3 text-uppercase fw-bold text-dark">
                                <i class="bi bi-pencil-square me-2 text-primary"></i>
                                AGGIUNGI UN POKEMON
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                            <div class="text-center border-bottom pb-3 mb-4">
                                <h3 class="h5 m-0 fw-bold text-uppercase text-primary">Info & Dettagli</h3>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold small">NOME POKEMON -Obbligatorio </label>
                                <input type="text" name="pokemon[name]" id="name"
                                    placeholder="-Es. Pikachu"class="form-control form-control-lg bg-light border-0"
                                    value="{{ old('pokemon.name') }}" required>
                                @error('pokemon.name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- NAME --}}

                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold small">
                                    CARICA NUOVA IMMAGINE -Obbligatoria
                                </label>
                                <input type="file" name="pokemon[image]" id="image"
                                    class="form-control bg-light border-0">
                                @error('pokemon.image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- IMAGE --}}

                            <div class="mb-3">
                                <label for="height" class="form-label fw-bold small">ALTEZZA (MT)</label>
                                <input type="number" name="pokemon[height]" id="height" placeholder="-Es 1,2"
                                    class="form-control bg-light border-0" min="0.1" step="0.1"
                                    value="{{ old('pokemon.height') }}">
                                @error('pokemon.height')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- HEIGHT --}}

                            <div class="mb-3">
                                <label for="weight" class="form-label fw-bold small">PESO (KG)</label>
                                <input type="number" name="pokemon[weight]" id="weight" placeholder="-Es 5,5"
                                    class="form-control bg-light border-0" min="0.1" step="0.1"
                                    value="{{ old('pokemon.weight') }}">
                                @error('pokemon.weight')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- WEIGHT --}}

                            <div class="mb-0">
                                <label for="description" class="form-label fw-bold small">DESCRIZIONE</label>
                                <textarea name="pokemon[description]" id="description" class="form-control bg-light border-0" rows="4">{{ old('pokemon.description') }}</textarea>
                                @error('pokemon.description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                    </div>
                    {{-- DESCRIPTION --}}

                    <div class="col-md-4 d-flex flex-column">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 flex-grow-1">
                            <div class="text-center border-bottom pb-3 mb-4">
                                <h3 class="h5 m-0 fw-bold text-uppercase text-primary">Tipi & Origine</h3>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold small mb-2 d-block">SCELTA MULTIPLA TIPI -Obbligatorio almeno 1
                                    tipo</label>
                                <select name="pokemon[types][]" class="form-select bg-light border-0" multiple
                                    size="5" style="border-radius: 10px;">
                                    @foreach ($aviable_types as $type)
                                        <option value="{{ $type->id }}" class="p-2">
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pokemon.types')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- TYPES --}}

                            <div class="mb-3">
                                <label class="fw-bold small mb-2 d-block">GENERAZIONE -Obbligatoria</label>
                                <select name="pokemon[generation_id]" class="form-select bg-light border-0 py-2"
                                    style="border-radius: 10px;">
                                    @foreach ($aviable_gen as $gen)
                                        <option value="{{ $gen->id }}">
                                            {{ $gen->number }}° - {{ $gen->region }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pokemon.generation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- -GENERATION --}}

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm fw-bold text-uppercase"
                            style="border-radius: 15px;">
                            <i class="bi bi-save me-2"></i>Invia modifiche
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Aggiorna ' . $pokemon->name)
@section('content')
    <div class="container-fluid py-5 bg-light min-vh-100">
        <div class="container">
            <form action="{{ route('pokemon.update', $pokemon) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="row mb-5">
                    <div class="col-12">
                        <div class="bg-white p-4 shadow-sm text-center border-start border-primary border-5 rounded-3">
                            <h1 class="m-0 h3 text-uppercase fw-bold text-dark">
                                <i class="bi bi-pencil-square me-2 text-primary"></i>AGGIORNA IL POKEMON: <span
                                    class="text-primary">{{ $pokemon->name }}</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3">
                            <div class="bg-primary text-white p-2 rounded-3 mb-3 text-center fw-bold small">
                                IMMAGINE ATTUALE
                            </div>
                            <div class="d-flex align-items-center justify-content-center bg-white border border-2 border-dashed rounded-4 p-2"
                                style="height: 350px;">
                                <img src="{{ Storage::url($pokemon->image) }}" class="img-fluid"
                                    style="max-height: 100%; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));"
                                    alt="{{ $pokemon->name }}">
                            </div>
                        </div>
                    </div>
                    {{-- CURRENT IMAGE --}}

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                            <div class="text-center border-bottom pb-3 mb-4">
                                <h3 class="h5 m-0 fw-bold text-uppercase text-primary">Info & Dettagli</h3>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold small">NOME POKEMON -Obbligatorio </label>
                                <input type="text" name="pokemon[name]" id="name"
                                    class="form-control form-control-lg bg-light border-0"
                                    value="{{ old('pokemon.name', $pokemon->name) }}" required>
                                @error('pokemon.name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- NAME --}}

                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold small">CARICA NUOVA IMMAGINE -Obbligatoria,
                                    se non presente</label>
                                <input type="file" name="image" id="image" class="form-control bg-light border-0">
                                @error('pokemon.image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- IMAGE --}}

                            <div class="mb-3">
                                <label for="height" class="form-label fw-bold small">ALTEZZA (MT)</label>
                                <input type="number" name="pokemon[height]" id="height"
                                    class="form-control bg-light border-0" min="0.1" step="0.1"
                                    value="{{ old('pokemon.height', $pokemon->getHeight()) }}">
                                @error('pokemon.height')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- HEIGHT --}}

                            <div class="mb-3">
                                <label for="weight" class="form-label fw-bold small">PESO (KG)</label>
                                <input type="number" name="pokemon[weight]" id="weight"
                                    class="form-control bg-light border-0" min="0.1" step="0.1"
                                    value="{{ old('pokemon.weight', $pokemon->getWeight()) }}">
                                @error('pokemon.weight')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- WEIGHT --}}

                            <div class="mb-0">
                                <label for="description" class="form-label fw-bold small">DESCRIZIONE</label>
                                <textarea name="pokemon[description]" id="description" class="form-control bg-light border-0" rows="4">{{ old('pokemon.description', $pokemon->getDescription()) }}</textarea>
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
                                    @foreach ($types_selected as $type_sel)
                                        <option class="p-2" value="{{ $type_sel->id }}" selected>{{ $type_sel->name }}
                                        </option>
                                    @endforeach
                                    @foreach ($aviable_types as $type_av)
                                        <option value="{{ $type_av->id }}" class="p-2">
                                            {{ $type_av->name }}
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
                                        <option value="{{ $gen->id }}"
                                            {{ $pokemon->generation->id == $gen->id ? 'selected' : '' }}>
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

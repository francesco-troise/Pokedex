@extends('layouts.app')
@section('title', 'Aggiungi Generazione')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('generation.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Torna alla lista delle generazioni
            </a>
        </div>

        <div class="row g-5 justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 15px;">
                    <h2 class="h4 fw-bold mb-4 text-primary">Aggiungi nuova Generazione</h2>

                    <form action="{{ route('generation.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="number" class="form-label fw-semibold text-secondary">Numero Generazione</label>
                            <input type="number" name="number" id="number" min="1" max="100"
                                class="form-control border-0 bg-light py-2" placeholder="Es: 1" value="{{ old('number') }}"
                                required>
                            @error('number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- NUMBER GEN /required --}}

                        <div class="mb-3">
                            <label for="region" class="form-label fw-semibold text-secondary">Nome Regione</label>
                            <input type="text" name="region" id="region" class="form-control border-0 bg-light py-2"
                                placeholder="Es: Kanto" value="{{ old('region') }}" required>
                            @error('region')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- REGION GEN /required --}}

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold text-secondary">Descrizione della
                                generazione/regione</label>
                            <textarea name="description" id="description" class="form-control border-0 bg-light" rows="5"
                                placeholder="Descrivi la regione...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- DESCRIPTION GEN --}}

                        <div class="mb-4">
                            <label for="region_image" class="form-label fw-semibold text-secondary">Immagine della
                                regione</label>
                            <input type="file" name="region_image" id="region_image"
                                class="form-control border-0 bg-light">
                            @error('region_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- IMAGE GEN --}}

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3 fw-bold text-uppercase shadow-sm">
                                <i class="bi bi-plus-circle me-2"></i> Crea Generazione
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

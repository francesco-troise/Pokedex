@extends('layouts.app')
@section('title', "Aggiorna generazione: {$generation->number} - {$generation->region}")

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('generation.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Torna alla lista delle generazioni
            </a>
        </div>

        <div class="row g-5">
            <div class="col-md-4 text-center">
                <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
                    <div class="bg-light p-2 border-bottom">
                        <span class="small fw-bold text-uppercase text-muted">Immagine Attuale</span>
                    </div>
                    <img src="{{ Storage::url($generation->region_image) }}" class="img-fluid"
                        style="height: 250px; width: 100%; object-fit: cover;" alt="Mappa {{ $generation->region }}">
                    <div class="card-body bg-white">
                        <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">
                            Gen: {{ $generation->number }}° - {{ $generation->region }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 15px;">
                    <h2 class="h4 fw-bold mb-4">Modifica Dettagli</h2>

                    <form action="{{ route('generation.update', $generation) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="number" class="form-label fw-semibold text-secondary">Associa la generazione al
                                suo numero</label>
                            <select name="number" id="number" class="form-select border-0 bg-light" required>
                                @foreach ($aviable_numbers as $num)
                                    <option value="{{ $num }}" {{ $generation->number == $num ? 'selected' : '' }}>
                                        {{ $num }}° Generazione
                                    </option>
                                @endforeach
                            </select>
                            @error('number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- NUMBER GEN /required --}}

                        <div class="mb-3">
                            <label for="region" class="form-label fw-semibold text-secondary">Associa la relativa
                                regione</label>
                            <select name="region" id="region" class="form-select border-0 bg-light" required>
                                @foreach ($aviable_regions as $region)
                                    <option value="{{ $region }}"
                                        {{ $generation->region == $region ? 'selected' : '' }}>
                                        {{ $region }}
                                    </option>
                                @endforeach
                            </select>
                            @error('region')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- REGION GEN /required --}}

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold text-secondary">Descrizione della
                                generazione/regione</label>
                            <textarea name="description" id="description" class="form-control border-0 bg-light" rows="5">{{ $generation->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- DESCRIPTION GEN --}}

                        <div class="mb-4">
                            <label for="region_image" class="form-label fw-semibold text-secondary">Cambia immagine della
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
                                <i class="bi bi-check-lg me-2"></i> Salva modifiche
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

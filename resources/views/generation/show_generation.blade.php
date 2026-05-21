@extends('layouts.app')
@section('title', 'Generazione: ' . $generation->region)

@section('content')
    <div class="container py-5">
        <div class="grid">
            <div class="row g-4">

                <div class="col-lg-8 col-gen">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">

                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <a href="{{ route('generation.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                                ← Torna
                                alle generazioni</a>
                            <h1 class="fw-bold mb-0">{{ $generation->number }}° generazione - {{ $generation->region }}</h1>
                        </div>

                        <div class="card-body text-center p-4">
                            <img src="{{ Storage::url($generation->region_image) }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 450px; width: 100%; object-fit: contain; background-color: #f8f9fa;"
                                alt="{{ $generation->name }}">
                        </div>

                        <div class="card-footer bg-light border-0 p-4">
                            <p class="mb-4 text-secondary leading-relaxed">{{ $generation->description }}</p>

                            <div class="d-flex shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                <a href="{{ route('generation.edit', $generation) }}"
                                    class="btn btn-warning rounded-0 w-50 py-3 fw-bold border-end border-dark text-uppercase">
                                    <i class="bi bi-pencil"></i> MODIFICA
                                </a>

                                <form action="{{ route('generation.destroy', $generation) }}" method="POST"
                                    class="w-50 m-0"
                                    onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente {{ $generation->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger rounded-0 w-100 h-100 py-3 fw-bold text-white text-uppercase">
                                        <i class="bi bi-trash"></i> Elimina
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-pkm">
                    <div class="card h-100 shadow-sm border-0 text-center" style="border-radius: 20px;">
                        <div class="card-header bg-transparent border-0 pt-4">
                            <div class="card-title h4 fw-bold text-muted  mb-1">POKEMON ESEMPIO</div>
                            <span class="display-6 fw-bold"
                                style="color: {{ $random_pkm?->types?->first()->getTypeColor() }};">
                                {{ $random_pkm?->name ?? 'Nessun Pokémon di esempio' }}
                            </span>
                            <div class="card-body d-flex align-items-center justify-content-center p-4">

                                    <img src="{{ $random_pkm?->image ? Storage::url($random_pkm->image) : Storage::url('image_default.jpg') }}"
                                        class="img-fluid"
                                        style="max-height: 300px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));"
                                        alt="{{ $random_pkm?->name ?? 'Nessun Pokémon di esempio' }}">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

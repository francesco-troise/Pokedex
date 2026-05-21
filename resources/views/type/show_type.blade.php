@extends('layouts.app')
@section('title', 'Tipo: ' . $type->name)

@section('content')
    <div class="container py-5">
        <div class="text-start mt-4">
            <a href="{{ route('type.index') }}" class="text-decoration-none text-muted fw-bold">
                <i class="bi bi-arrow-left"></i> Torna alla lista
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">

                <div class="card shadow text-center border-dark" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header bg-transparent border-0 pt-4">
                        <p class="text-uppercase small fw-bold mb-0 text-muted">Tipologia</p>
                        <h2 class="fw-bold mb-0 d-flex justify-content-center align-items-center gap-2">
                            <x-type_badge :color="$type->getTypeColor()" />
                            {{ $type->name }}
                        </h2>
                    </div>

                    <div class="card-body d-flex align-items-center justify-content-center p-0"
                        style="min-height: 400px; background-color: #f8f9fa;">
                        <img src="{{ Storage::url($type->image) }}" alt="{{ $type->name }}" class="img-fluid w-100"
                            style="max-height: 400px; object-fit: cover;">
                    </div>

                    <div class="p-4 border-top border-light">
                        <p class="mb-0 text-secondary" style="font-size: 1.1rem; line-height: 1.6;">
                            {{ $type->description }}
                        </p>
                    </div>

                    <div class="card-footer p-0 border-top border-dark">
                        <div class="d-flex">
                            <a href="{{ route('type.edit', $type) }}"
                                class="btn btn-warning rounded-0 w-50 py-3 fw-bold border-end border-dark text-uppercase">
                                <i class="bi bi-pencil"></i> MODIFICA
                            </a>

                            <form action="{{ route('type.destroy', $type) }}" method="POST" class="w-50 m-0"
                                onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente {{ $type->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger rounded-0 w-100 h-100 py-3 fw-bold text-black text-uppercase">
                                    <i class="bi bi-trash"></i> Elimina {{ $type->name }}
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
                        <span class="display-6 fw-bold" style="color: {{ $type->getTypeColor() }};">
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

@extends('layouts.app')
@section('title', 'Le generazioni')

@section('content')
    <a href="{{ route('generation.create') }}">Aggiungi una nuova generazione</a>
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

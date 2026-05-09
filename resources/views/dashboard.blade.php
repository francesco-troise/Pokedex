@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container py-5">
        <div class="row g-4">

            <!--Card Pokedex-->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow position-relative overflow-hidden"
                    style="border-radius: 20px; min-height: 280px;">

                    <img src="{{ Storage::url('welcome/pokemon.jpg') }}" class="position-absolute w-100 h-100"
                        style="object-fit: cover; z-index: 0;" alt="Pokèdex">


                    <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.2); z-index: 1;"></div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative p-4"
                        style="z-index: 2;">
                        <div>

                            <h2 class="fw-bold px-3 py-2 d-inline-block text-white"
                                style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; font-size: 1.5rem;">
                                POKEDEX
                            </h2>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('pokemon.index') }}" class="btn btn-light fw-bold shadow-sm px-4 py-2"
                                style="border-radius: 12px; border: none;">
                                Esplora i Pokemon <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Card Tipologie-->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow position-relative overflow-hidden"
                    style="border-radius: 20px; min-height: 280px;">
                    <img src="{{ Storage::url('welcome/types.jpg') }}" class="position-absolute w-100 h-100"
                        style="object-fit: cover; z-index: 0;" alt="Tipologie">
                    <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.2); z-index: 1;"></div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative p-4"
                        style="z-index: 2;">
                        <div>
                            <h2 class="fw-bold px-3 py-2 d-inline-block text-white"
                                style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; font-size: 1.5rem;">
                                TIPOLOGIE
                            </h2>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('type.index') }}" class="btn btn-light fw-bold shadow-sm px-4 py-2"
                                style="border-radius: 12px; border: none;">
                                Gestisci Tipi <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Card Generazioni-->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow position-relative overflow-hidden"
                    style="border-radius: 20px; min-height: 280px;">
                    <img src="{{ Storage::url('welcome/generations.jpg') }}" class="position-absolute w-100 h-100"
                        style="object-fit: cover; z-index: 0;" alt="Generazioni">
                    <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.2); z-index: 1;"></div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative p-4"
                        style="z-index: 2;">
                        <div>
                            <h2 class="fw-bold px-3 py-2 d-inline-block text-white"
                                style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; font-size: 1.5rem;">
                                GENERAZIONI
                            </h2>
                        </div>
                        <div class="text-end">
                            <a href="" class="btn btn-light fw-bold shadow-sm px-4 py-2"
                                style="border-radius: 12px; border: none;">
                                Vai alle generazioni <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Forms -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow position-relative overflow-hidden"
                    style="border-radius: 20px; min-height: 280px;">
                    <img src="{{ Storage::url('welcome/forms.jpg') }}" class="position-absolute w-100 h-100"
                        style="object-fit: cover; z-index: 0;" alt="Pagina forms">
                    <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.3); z-index: 1;"></div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative p-4"
                        style="z-index: 2;">
                        <div>
                            <div class="px-3 py-2 text-white"
                                style="background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(10px); border-left: 4px solid #ffc107; border-radius: 5px; max-width: 80%;">
                                <p class="mb-0 fw-bold">Vuoi aggiungere nuovi dati?</p>
                                <small class="opacity-75">Inserisci nuovi Pokemon o Generazioni</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="" class="btn btn-warning fw-bold shadow px-4 py-2"
                                style="border-radius: 12px; border: none;">
                                Vai ai Forms <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

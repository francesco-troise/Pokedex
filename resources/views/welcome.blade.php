@extends('layouts.app')
@section('title', 'welcome')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="fw-bold mb-3">BENVENUTO NELLA TUA AREA DI AMMINISTRAZIONE!</h1>
        <p class="lead mb-5 text-muted">Aggiorna il tuo database, ottieni info sulla gestione del tuo sito</p>

        <!--Griglia Statistiche-->
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">

            <!--Card Pokemon-->
            <div class="col">
                <div class="card h-100 shadow-sm border-dark" style="border-radius: 25px;">
                    <div class="card-body d-flex flex-column justify-content-center py-4">
                        <h5 class="text-uppercase fw-bold text-muted">Pokemon Totali</h5>
                        <span class="display-4 fw-bold text-primary">{{ $welcome_data['total_pokemon'] }}</span>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-4">
                        <img src="{{ Storage::url('welcome/pokemon.jpg') }}" class="img-fluid rounded"
                            style="max-height: 175px;" alt="Pokemon">
                    </div>
                </div>
            </div>

            <!--Card Generazioni-->
            <div class="col">
                <div class="card h-100 shadow-sm border-dark" style="border-radius: 25px;">
                    <div class="card-body d-flex flex-column justify-content-center py-4">
                        <h5 class="text-uppercase fw-bold text-muted">Generazioni</h5>
                        <span class="display-4 fw-bold text-success">{{ $welcome_data['total_generations'] }}</span>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4">
                        <img src="{{ Storage::url('welcome/generations.jpg') }}" class="img-fluid rounded"
                            style="max-height: 175px;" alt="Generazioni">
                    </div>
                </div>
            </div>

            <!--Card Tipologie-->
            <div class="col">
                <div class="card h-100 shadow-sm border-dark" style="border-radius: 25px;">
                    <div class="card-body d-flex flex-column justify-content-center py-4">
                        <h5 class="text-uppercase fw-bold text-muted">Tipologie</h5>
                        <span class="display-4 fw-bold text-warning">{{ $welcome_data['total_types'] }}</span>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4">
                        <img src="{{ Storage::url('welcome/types.jpg') }}" class="img-fluid rounded"
                            style="max-height: 175px;" alt="Tipologie">
                    </div>
                </div>
            </div>

        </div>

        <!--Pulsante Dashboard-->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <a href="{{ route('dashboard') }}" class="btn btn-dark btn-lg w-100 py-3 shadow"
                    style="border-radius: 15px;">
                    <i class="bi bi-speedometer2 me-2"></i> VAI ALLA DASHBOARD DI AMMINISTRAZIONE
                </a>
            </div>
        </div>
    </div>
@endsection

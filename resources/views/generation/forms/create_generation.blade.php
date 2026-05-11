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
                            <label for="gen_num" class="form-label fw-semibold text-secondary">Numero Generazione</label>
                            <input type="number" name="gen_num" id="gen_num" min="1" max="100"
                                class="form-control border-0 bg-light py-2" placeholder="Es: 1">
                        </div>

                        <div class="mb-3">
                            <label for="gen_region" class="form-label fw-semibold text-secondary">Nome Regione</label>
                            <input type="text" name="gen_region" id="gen_region"
                                class="form-control border-0 bg-light py-2" placeholder="Es: Kanto">
                        </div>

                        <div class="mb-3">
                            <label for="gen_desc" class="form-label fw-semibold text-secondary">Descrizione della
                                generazione/regione</label>
                            <textarea name="gen_desc" id="gen_desc" class="form-control border-0 bg-light" rows="5"
                                placeholder="Descrivi la  regione..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="gen_image" class="form-label fw-semibold text-secondary">Immagine della
                                regione</label>
                            <input type="file" name="gen_image" id="gen_image" class="form-control border-0 bg-light">
                        </div>

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

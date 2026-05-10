@extends('layouts.app')
@section('title', 'Crea nuovo Tipo')

@section('content')
    <div class="container py-5">

        <div class="mb-4">
            <a href="{{ route('type.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-arrow-left me-2"></i>Torna a lista Tipi
            </a>
        </div>

        <div class="row">


            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-dark py-3">
                        <h5 class="card-title mb-0 fw-bold">
                            Aggiungi le informazioni relative ad un nuovo <b>Tipo</b>
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('type.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" mb-3">
                                <label for="name" clasS="fw-bold">Nome tipologia</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nome tipologia" value="">

                            </div>

                            <div class="mb-3 text-start">
                                <label for="description" class="form-label fw-bold">Descrizione del tipo</label>
                                <textarea class="form-control" name="description" id="description" rows="3"
                                    placeholder="Aggiungere descrizoine della tipologia"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label small fw-bold text-muted">Aggiungi immagine del
                                    tipo</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold">
                                    <i class="bi bi-check-circle me-2"></i>Salva Modifiche
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

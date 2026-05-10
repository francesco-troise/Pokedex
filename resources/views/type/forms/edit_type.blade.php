@extends('layouts.app')
@section('title', 'Aggiorna il tipo: ' . $type->name)

@section('content')
    <div class="container py-5">

        <div class="mb-4">
            <a href="{{ route('type.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-arrow-left me-2"></i>Torna a lista Tipi
            </a>
        </div>

        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div>
                    <div class="mb-3">
                        <img src="{{ Storage::url($type->image) }}" class="rounded-circle shadow-lg border border-4"
                            style="width: 200px; height: 200px; object-fit: cover; border-color: {{ $type->getTypeColor() }} !important;"
                            alt="">
                    </div>
                    <span class="badge bg-secondary-subtle text-secondary p-2 px-3 rounded-pill border">
                        <i class="bi bi-image me-1"></i> Immagine attuale del <b>TIPO: {{ $type->name }}</b>
                    </span>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-white py-3"
                        style="background-color: {{ $type->getTypeColor() }} !important;">
                        <h5 class="card-title mb-0 fw-bold">
                            Modifica informazioni del <b>Tipo:</b> - <b>{{ $type->name }}</b>
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('type.update', $type) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class=" mb-3">
                                <label for="name" clasS="fw-bold">Nome tipologia</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nome tipologia" value="{{ $type->name }}">

                            </div>

                            <div class="mb-3 text-start">
                                <label for="description" class="form-label fw-bold">Descrizione del tipo</label>
                                <textarea class="form-control" name="description" id="description" rows="3">{{ $type->description }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label small fw-bold text-muted">Sostituisci immagine del
                                    tipo: {{ $type->name }}</label>
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

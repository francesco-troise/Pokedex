@extends('layouts.app')
@section('title', 'Le tipologie pokèmon')

@section('content')
    <div class="container py-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
            @foreach ($all_types as $type)
                <div class="col">
                    <div class="card h-100 shadow-sm text-center border-dark" style="border-radius: 20px; overflow: hidden;">

                        <div class="card-header bg-transparent border-0 pt-4 text-center">
                            <p class="text-uppercase small fw-bold mb-0 text-muted">Tipologia</p>

                            <h3 class="fw-bold mb-0 d-flex justify-content-center align-items-center gap-2">

                                <x-type_badge :color="$type->getTypeColor()" />

                                <a href="{{ route('type.show', $type) }}" class="text-decoration-none text-dark">
                                    {{ $type->name }}
                                </a>
                            </h3>
                        </div>

                        <div class="card-body d-flex align-items-center justify-content-center p-0"
                            style="min-height: 300px; background-color: #f8f9fa;">
                            <img src="{{ Storage::url($type->image) }}" alt="{{ $type->name }}" class="img-fluid w-100"
                                style="max-height: 300px; object-fit: cover;">
                        </div>

                        <div class="card-footer p-0 border-top border-dark">
                            <div class="d-flex">
                                <a href="{{ route('type.show', $type) }}"
                                    class="btn btn-light rounded-0 w-50 border-end border-dark py-3 fw-bold">
                                    VAI AI DETTAGLI
                                </a>
                                <a href="{{ route('type.edit', $type) }}" class="btn btn-light rounded-0 w-50 py-3 fw-bold">
                                    MODIFICA
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

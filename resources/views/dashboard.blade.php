@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <a href="{{ route('pokemon.index') }}">VAI ALLA ALL_POKEMON</a>
    <br>
    <a href="{{ route('type.index') }}">VAI A TUTTI I TIPI</a>
@endsection

@extends('layouts.app')

@section('title', 'Panel Klienta')

@section('content')

    @include('partials.books-list', ['books' => $books])
@endsection

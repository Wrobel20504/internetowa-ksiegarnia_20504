@extends('layouts.app')

@section('title', 'Panel Administratora')

@section('content')

    @include('partials.books-list', ['books' => $books])
@endsection

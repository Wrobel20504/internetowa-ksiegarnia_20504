@extends('layouts.app')

@section('title', 'Panel Pracownika')

@section('content')

    @include('partials.books-list', ['books' => $books])
@endsection

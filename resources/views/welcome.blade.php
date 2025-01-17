@extends('layouts.app')

@section('title', 'Strona główna')

@section('content')
    <h1 class="text-center">Witamy w naszej księgarni!</h1>
    <p class="text-center">Przeglądaj książki i znajdź coś dla siebie.</p>

    @auth
        <div class="text-center mb-4">
            @if (Auth::user()->role === 'admin')
                <a href="{{ url('/admin') }}" class="btn btn-primary">Przejdź do panelu administratora</a>
            @elseif (Auth::user()->role === 'employee')
                <a href="{{ url('/employee') }}" class="btn btn-success">Przejdź do panelu pracownika</a>
            @else
                <a href="{{ url('/client') }}" class="btn btn-info">Przejdź do panelu klienta</a>
            @endif
        </div>
    @endauth

    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary btn-sm w-100">
                                {{ $book->title }}
                            </a>
                        </h5>
                        <p class="card-text">
                            <a href="{{ route('author.show', $book->author->id) }}" class="btn btn-secondary btn-sm w-100">
                                {{ $book->author->name }}
                            </a>
                        </p>
                        <p class="card-text">Cena: {{ $book->price }} zł</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection

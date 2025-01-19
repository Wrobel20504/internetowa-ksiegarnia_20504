@extends('layouts.app')

@section('title', 'Panel Administratora')

@section('content')
    <h1>Panel Administratora</h1>

    <!-- Lista autorów -->
    <div class="mb-5">
        <h2>Autorzy</h2>
        <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Dodaj autora</a>
        <ul class="list-group">
            @foreach ($authors as $author)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $author->name }}
                    <div>
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-info btn-sm">Szczegóły</a>
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">Edytuj</a>
                        <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć tego autora?')">Usuń</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $authors->appends(request()->except('authors_page'))->links() }}
        </div>
    </div>

    <!-- Lista książek -->
    <div class="mb-5">
        <h2>Książki</h2>
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Dodaj książkę</a>
        <ul class="list-group">
            @foreach ($books as $book)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $book->title }}
                    <div>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">Szczegóły</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Edytuj</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć tę książkę?')">Usuń</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $books->appends(request()->except('books_page'))->links() }}
        </div>
    </div>

    <!-- Lista użytkowników -->
    <div class="mb-5">
        <h2>Użytkownicy</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Dodaj użytkownika</a>
        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $user->name }} ({{ $user->role }})
                    <div>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Szczegóły</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edytuj</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">Usuń</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $users->appends(request()->except('users_page'))->links() }}
        </div>
    </div>
@endsection

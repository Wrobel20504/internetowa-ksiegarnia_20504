@extends('layouts.app')

@section('title', 'Panel Pracownika')

@section('content')
    <div class="sidebar">
        <h5>Filtry i sortowanie</h5>
        <form method="GET" action="{{ url('/employee') }}">
            <!-- Wyszukiwanie tytułu i autora -->
            <div class="mb-3">
                <label for="search" class="form-label">Szukaj</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Tytuł lub autor" value="{{ request('search') }}">
            </div>

            <!-- Filtr kategorii -->
            <div class="mb-3">
                <label for="categories" class="form-label">Kategorie</label>
                <select id="categories" name="categories[]" class="form-select" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, (array)request('categories', [])) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sortowanie -->
            <div class="mb-3">
                <label for="sort_by" class="form-label">Sortuj według</label>
                <select id="sort_by" name="sort_by" class="form-select">
                    <option value="">Wybierz</option>
                    <option value="title" {{ request('sort_by') === 'title' ? 'selected' : '' }}>Tytuł</option>
                    <option value="author" {{ request('sort_by') === 'author' ? 'selected' : '' }}>Autor</option>
                </select>
            </div>

            <!-- Przycisk wyszukiwania -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Zastosuj</button>
            </div>
        </form>
    </div>

    <h1>Panel Pracownika</h1>


    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary btn-sm w-100">{{ $book->title }}</a>
                        </h5>
                        <p class="card-text">
                            Autor: <a href="{{ route('author.show', $book->author->id) }}" class="btn btn-secondary btn-sm w-100">
                                {{ $book->author->name }}
                            </a>
                        </p>
                        <p class="card-text">Cena: {{ $book->price }} zł</p>
                        <p class="card-text">
                            Kategorie:
                            @foreach ($book->categories as $category)
                                <span class="badge bg-info">{{ $category->name }}</span>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-grid gap-3">
        <!-- Przycisk do zarządzania zamówieniami -->
        <a href="{{ route('employee.orders.index') }}" class="btn btn-primary btn-lg">Zarządzaj zamówieniami</a>


    </div>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Panel Administratora')

@section('content')
    <h1>Panel Administratora</h1>

    <form method="GET" action="{{ url('/admin') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Szukaj po tytule lub autorze" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="categories[]" class="form-select" multiple>
                    <option disabled>Filtruj po kategoriach</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, (array)request('categories', [])) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="sort_by" class="form-select">
                    <option value="">Sortuj</option>
                    <option value="title" {{ request('sort_by') === 'title' ? 'selected' : '' }}>Tytuł</option>
                    <option value="author" {{ request('sort_by') === 'author' ? 'selected' : '' }}>Autor</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Szukaj</button>
            </div>
        </div>
    </form>

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

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection

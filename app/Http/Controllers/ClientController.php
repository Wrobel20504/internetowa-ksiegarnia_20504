<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book; // Dodaj ten import
use App\Models\Category;

class ClientController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Book::with('author', 'categories');

        // Filtr tytułu lub autora
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%$search%")
                ->orWhereHas('author', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                });
        }

        // Filtr kategorii
        if ($request->filled('categories')) {
            $categoryIds = $request->input('categories');
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }

        // Sortowanie
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            if ($sortBy === 'title') {
                $query->orderBy('title');
            } elseif ($sortBy === 'author') {
                $query->orderBy(function ($q) {
                    $q->select('name')
                        ->from('authors')
                        ->whereColumn('authors.id', 'books.author_id');
                });
            }
        }

        $books = $query->paginate(6)->appends($request->all());
        $categories = Category::all();

        return view('client.dashboard', compact('books', 'categories'));
    }

}

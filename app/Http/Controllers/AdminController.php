<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book; // Dodaj ten import


class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $books = Book::with('author')->paginate(6);
        return view('admin.dashboard', compact('user', 'books'));
    }

}

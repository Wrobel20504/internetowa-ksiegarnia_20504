<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        // Tworzenie autorów
        $author1 = Author::create([
            'name' => 'Jan Kowalski',
            'biography' => 'Polski autor książek historycznych.',
        ]);

        $author2 = Author::create([
            'name' => 'Anna Nowak',
            'biography' => 'Specjalistka w literaturze fantasy.',
        ]);

        $author3 = Author::create([
            'name' => 'Piotr Wiśniewski',
            'biography' => 'Znany pisarz książek kryminalnych.',
        ]);


    }
}



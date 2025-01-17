<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        /*
        // Pobranie autorów z bazy danych
        $author1 = Author::where('name', 'Jan Kowalski')->first();
        $author2 = Author::where('name', 'Anna Nowak')->first();
        $author3 = Author::where('name', 'Piotr Wiśniewski')->first();

        // Dodawanie książek
        Book::create([
            'title' => 'Historia Polski',
            'price' => 49.99,
            'stock' => 100,
            'category_id' => 1,
            'author_id' => $author1->id,
        ]);

        Book::create([
            'title' => 'II Wojna Światowa',
            'price' => 59.99,
            'stock' => 50,
            'category_id' => 1,
            'author_id' => $author1->id,
        ]);

        Book::create([
            'title' => 'Magiczne Krainy',
            'price' => 39.99,
            'stock' => 80,
            'category_id' => 2,
            'author_id' => $author2->id,
        ]);

        Book::create([
            'title' => 'Legendy Smoków',
            'price' => 44.99,
            'stock' => 70,
            'category_id' => 2,
            'author_id' => $author2->id,
        ]);

        Book::create([
            'title' => 'Tajemnice Miasta',
            'price' => 54.99,
            'stock' => 40,
            'category_id' => 3,
            'author_id' => $author3->id,
        ]);
        */
        $categories = Category::all();
        $authors = Author::all();

        Book::factory(50)->create()->each(function ($book) use ($categories, $authors) {
            // Przypisz losowego autora
            $book->author_id = $authors->random()->id;
            $book->save();

            // Przypisz losowe kategorie (od 1 do 3 na książkę)
            $book->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}

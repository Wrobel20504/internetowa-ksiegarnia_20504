<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            //$table->unsignedBigInteger('author_id')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('authors')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            //$table->foreignId('category_id')->constrained('categories');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
}

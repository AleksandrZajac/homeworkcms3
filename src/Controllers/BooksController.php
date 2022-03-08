<?php

namespace App\Controllers;

use App\Models\Book;
use App\View;

class BooksController
{
    public function reader()
    {
        $books = Book::all();
        return new View('personal.books.show', ['title' => 'Personal Books', 'books' => $books]);
    }
}

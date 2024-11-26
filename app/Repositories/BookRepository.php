<?php
namespace App\Repositories;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
    public function all($title = null, $author = null): LengthAwarePaginator
    {
        $query = Book::query();

        if ($title) {
            $query->where('title', 'like', "%$title%");
        }

        if ($author) {
            $query->where('author', 'like', "%$author%");
        }

        return $query->paginate(10);
    }

    public function find($id): ?Book
    {
        return Book::leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->where('books.id', $id)
            ->select('books.*', 'ratings.*') 
            ->first();
    }
}

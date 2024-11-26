<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface
{
    public function all($title = null, $author = null): LengthAwarePaginator;
    public function find($id): ?Book;
}

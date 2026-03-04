<?php

namespace Modules\Library\Infrastructure\Persistence;

use Modules\Library\Models\Book;

class EloquentBookRepository implements BookRepositoryInterface
{
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function find(string $id): ?Book
    {
        return Book::find($id);
    }
}

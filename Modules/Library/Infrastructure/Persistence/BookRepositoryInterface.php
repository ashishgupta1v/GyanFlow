<?php

namespace Modules\Library\Infrastructure\Persistence;

use Modules\Library\Models\Book;

interface BookRepositoryInterface
{
    public function create(array $data): Book;

    public function find(string $id): ?Book;
}

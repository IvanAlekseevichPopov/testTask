<?php

declare(strict_types=1);

namespace App\Model\Response;

interface PaginatedListInterface
{
    public function getData(): array;

    public function getTotal(): int;

    public function getTotalPages(): int;
}

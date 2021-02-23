<?php

declare(strict_types=1);

namespace App\Model\Response;

class PaginatedList implements PaginatedListInterface
{
    /** @var array */
    private $data;

    /** @var int */
    private $total;

    /** @var int */
    private $totalPages;

    public function __construct(int $total, int $totalPages, array $data)
    {
        $this->total = $total;
        $this->totalPages = $totalPages;
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}

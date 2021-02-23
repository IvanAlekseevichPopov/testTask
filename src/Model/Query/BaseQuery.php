<?php

declare(strict_types=1);

namespace App\Model\Query;

class BaseQuery implements SimpleQueryInterface
{
    /** @var int */
    protected $page = 1;

    /** @var int */
    protected $perPage = 20;

    /** @var string|null */
    private $sortBy = 'id';

    /** @var string */
    private $sortOrder = 'DESC';

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    public function getFirstResult(): int
    {
        return $this->getPerPage() * ($this->getPage() - 1);
    }

    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    public function setSortBy(?string $sortBy): void
    {
        $this->sortBy = $sortBy;
    }

    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

    public function setSortOrder(?string $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }
}

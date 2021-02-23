<?php

declare(strict_types=1);

namespace App\Model\Query;

interface SimpleQueryInterface
{
    public function getPage(): int;

    public function getPerPage(): int;

    public function getFirstResult(): int;

    public function getSortBy(): ?string;

    public function getSortOrder(): string;
}

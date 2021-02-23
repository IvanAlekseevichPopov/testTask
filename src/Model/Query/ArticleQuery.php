<?php

declare(strict_types=1);

namespace App\Model\Query;

class ArticleQuery extends BaseQuery
{
    /**
     * @var string|null
     */
    protected $title;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
}

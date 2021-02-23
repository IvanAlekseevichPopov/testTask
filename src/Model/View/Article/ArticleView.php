<?php

declare(strict_types=1);

namespace App\Model\View\Article;

use OpenApi\Annotations as OA;

class ArticleView
{
    /**
     * @var string
     *
     * @OA\Property(example="14005ca1-faab-46dd-945e-024acc024554")
     */
    public $id;

    /**
     * @var string
     *
     * @OA\Property(example="Title example")
     */
    public $title;

    /**
     * @var string
     *
     * @OA\Property(example="Body example")
     */
    public $body;

    /**
     * @var \DateTimeImmutable
     */
    public $createdAt;

    /**
     * @var \DateTimeImmutable
     */
    public $updatedAt;
}

<?php

declare(strict_types=1);

namespace App\Model\View;

use OpenApi\Annotations as OA;

class MetaView
{
    /**
     * @OA\Property(example=1)
     *
     * @var int
     */
    public $total;
}

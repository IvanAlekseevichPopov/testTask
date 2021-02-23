<?php

declare(strict_types=1);

namespace App\Model\View;

class ListView
{
    /** @var array */
    protected $data;

    /** @var MetaView */
    protected $meta;

    public function __construct(array $data, MetaView $meta)
    {
        $this->data = $data;
        $this->meta = $meta;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getMeta(): MetaView
    {
        return $this->meta;
    }
}

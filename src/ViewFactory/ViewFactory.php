<?php

declare(strict_types=1);

namespace App\ViewFactory;

use App\Model\Response\PaginatedListInterface;
use App\Model\View\ListView;
use App\Model\View\MetaView;

abstract class ViewFactory
{
    public function createCollectionView(array $list): array
    {
        return array_map([$this, 'createSingleView'], $list);
    }

    protected function createMeta(PaginatedListInterface $list): MetaView
    {
        $meta = new MetaView();
        $meta->total = $list->getTotal();

        return $meta;
    }

    abstract public function createPaginatedView(PaginatedListInterface $list): ListView;
}

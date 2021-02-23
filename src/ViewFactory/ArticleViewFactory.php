<?php

declare(strict_types=1);

namespace App\ViewFactory;

use App\Entity\Article;
use App\Model\Response\PaginatedListInterface;
use App\Model\View\Article\ArticleListView;
use App\Model\View\Article\ArticleView;

class ArticleViewFactory extends ViewFactory
{
    public function createSingleView(Article $article): ArticleView
    {
        $view = new ArticleView();

        $view->id = $article->getId();
        $view->title = $article->getTitle();
        $view->body = $article->getBody();
        $view->createdAt = $article->getCreatedAt();
        $view->updatedAt = $article->getUpdatedAt();

        return $view;
    }

    public function createPaginatedView(PaginatedListInterface $list): ArticleListView
    {
        $data = array_map([$this, 'createSingleView'], $list->getData());
        $meta = $this->createMeta($list);

        return new ArticleListView($data, $meta);
    }
}

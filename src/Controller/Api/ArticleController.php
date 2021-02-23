<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Article;
use App\Form\Query\ArticleQueryType;
use App\Form\Request\UpdateArticleType;
use App\Model\Query\ArticleQuery;
use App\Model\View\Article\ArticleListView;
use App\Model\View\Article\ArticleView;
use App\Repository\ArticleRepository;
use App\ViewFactory\ArticleViewFactory;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    /**
     * @OA\Tag(name="article")
     * @OA\Response(
     *     response=200,
     *     description="Single article data",
     *     @Model(type="App\Model\View\Article\ArticleView")
     * )
     * @OA\Response(
     *     response=404,
     *     description="No such article"
     * )
     *
     * @Route(
     *     path="/articles/{id}",
     *     methods={"GET"}
     * )
     *
     * @return ArticleView
     */
    public function getArticle(Article $article, ArticleViewFactory $viewFactory)
    {
        return $viewFactory->createSingleView($article);
    }

    /**
     * @OA\Tag(name="article")
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="number of page",
     *     @OA\Schema(
     *         type="integer",
     *         default=1
     *     )
     * )
     * @OA\Parameter(
     *     name="perPage",
     *     in="query",
     *     description="Quantity per page",
     *     @OA\Schema(
     *         type="integer",
     *         default=20
     *     )
     * )
     * @OA\Parameter(
     *     name="sortBy",
     *     in="query",
     *     description="field for sort",
     *     @OA\Schema(
     *         default="id",
     *         enum={"id", "createdAt", "updatedAt"},
     *         type="string"
     *     )
     * )
     * @OA\Parameter(
     *     name="sortOrder",
     *     in="query",
     *     description="Sort order",
     *     @OA\Schema(
     *         default="DESC",
     *         enum={"ASC", "DESC"},
     *         type="string"
     *     )
     * )
     * @OA\Parameter(
     *     name="title",
     *     in="query",
     *     description="Part of article title",
     *     @OA\Schema(
     *         type="string"
     *     )
     * )
     * @OA\Response(
     *     response=200,
     *     description="List of articles",
     *     @Model(type="App\Model\View\Article\ArticleListView")
     * )
     *
     * @Route(
     *     path="/articles",
     *     methods={"GET"}
     * )
     *
     * @return ArticleListView|FormInterface
     */
    public function getArticleCollection(Request $request, ArticleRepository $repository, ArticleViewFactory $viewFactory)
    {
        $query = new ArticleQuery();

        $form = $this->createForm(ArticleQueryType::class, $query);
        $form->submit($request->query->all(), false);
        if (!$form->isValid()) {
            return $form;
        }

        $paginatedList = $repository->findByQuery($query);

        return $viewFactory->createPaginatedView($paginatedList);
    }

    /**
     * @OA\Tag(name="article")
     * @OA\RequestBody(
     *     @Model(type="App\Form\Request\UpdateArticleType")
     * )
     * @OA\Response(
     *     response=200,
     *     description="Article created",
     *     @Model(type="App\Model\View\Article\ArticleView")
     * )
     * @OA\Response(
     *     response=400,
     *     description="Invalid request"
     * )
     * @OA\Response(
     *     response=401,
     *     description="You have to login first"
     * )
     *
     * @Route(
     *     path="/articles",
     *     methods={"POST"}
     * )
     *
     * @return ArticleView|FormInterface
     */
    public function createArticle(Request $request, EntityManagerInterface $entityManager, ArticleViewFactory $viewFactory)
    {
        $article = new Article();

        $form = $this->createForm(UpdateArticleType::class, $article);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }

        $entityManager->persist($article);
        $entityManager->flush();

        return $viewFactory->createSingleView($article);
    }

    /**
     * @OA\Tag(name="article")
     * @OA\RequestBody(
     *     @Model(type="App\Form\Request\UpdateArticleType")
     * )
     * @OA\Response(
     *     response=200,
     *     description="Article created",
     *     @Model(type="App\Model\View\Article\ArticleView")
     * )
     * @OA\Response(
     *     response=400,
     *     description="Invalid request"
     * )
     * @OA\Response(
     *     response=401,
     *     description="You have to login first"
     * )
     * @OA\Response(
     *     response=404,
     *     description="No such article"
     * )
     *
     * @Route(
     *     path="/articles/{id}",
     *     methods={"PUT"}
     * )
     *
     * @return ArticleView|FormInterface
     */
    public function updateArticle(Request $request, Article $article, EntityManagerInterface $entityManager, ArticleViewFactory $viewFactory)
    {
        $form = $this->createForm(UpdateArticleType::class, $article);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }

        $entityManager->persist($article);
        $entityManager->flush();

        return $viewFactory->createSingleView($article);
    }

    /**
     * @OA\Tag(name="article")
     * @OA\Response(
     *     response=204,
     *     description="Article sucessfuly deleted."
     * )
     * @OA\Response(
     *     response=401,
     *     description="You have to login first."
     * )
     * @OA\Response(
     *     response=404,
     *     description="No such article"
     * )
     *
     * @Route(
     *     path="/articles/{id}",
     *     methods={"DELETE"}
     * )
     *
     * @return void
     */
    public function deleteArticle(Article $article, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($article);
        $entityManager->flush();
    }
}

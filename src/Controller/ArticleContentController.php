<?php

namespace App\Controller;

use CatCasCarSymfony\ArticleContentProviderBundle\ArticleContentProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleContentController extends AbstractController
{
    /**
     * @Route("/article/article_content", name="app_article_content")
     * @return Response
     */
    public function createContent(Request $request, ArticleContentProvider $articleContent): Response
    {
        $paragraphsCount = (int)$request->get('paragraphsCount');
        $word = $request->get('word');
        $wordsCount = (int)$request->get('wordsCount');
        $articleContent = $articleContent->get($paragraphsCount, $word, $wordsCount);

        return $this->render('article_content/content.html.twig', [
            'articleContent' => $articleContent
        ]);
    }
}

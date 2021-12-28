<?php

namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\SlackClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findLatestPublished();

        $banner = rand(0, 1)
            ? 'images/cat-banner1.jpg'
            : 'images/cat-banner.jpg'
        ;
        
        return $this->render('articles/homepage.html.twig', [
            'articles' => $articles,
            'banner' => $banner
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="app_article_show")
     */
    public function show(Article $article, SlackClient $slack)
    {
        if ($article->getSlug() === 'slack') {
           $slack->send('Привет, это важное уведомление!');
        }

        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }
}

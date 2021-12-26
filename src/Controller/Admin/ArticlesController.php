<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class ArticlesController extends AbstractController
{
     /**
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     * @Route("/admin/articles", name="app_admin_articles")
     */
    public function index(ArticleRepository $articleRepository, Request $request, PaginatorInterface $paginator)
    {
        $pagination = $paginator->paginate(
            $articleRepository->latest(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/article/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function create(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);

        if ($this->handleFormRequest($form, $em, $request)) {
            $this->addFlash('flash_message', 'Статья успешно создана');

            return $this->redirectToRoute('app_admin_articles');
        }

        return $this->render('admin/article/create.html.twig', [
            'articleForm' => $form->createView(),
            'showError' => $form->isSubmitted()
        ]);
    }

    /**
     * @Route("/admin/articles/{id}/edit", name="app_admin_articles_edit")
     * @IsGranted("MANAGE", subject="article")
     */
    public function edit(Article $article, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class, $article, [
            'enable_published_at' => true
        ]);

        if ($this->handleFormRequest($form, $em, $request)) {
            $this->addFlash('flash_message', 'Статья успешно изменена');

            return $this->redirectToRoute('app_admin_articles_edit', ['id' => $article->getId()]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'articleForm' => $form->createView(),
            'showError' => $form->isSubmitted()
        ]);
    }

    private function handleFormRequest(FormInterface $form, EntityManagerInterface $em, Request $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();

            $em->persist($article);
            $em->flush();

            return $article;
        }
        return null;
    }
}

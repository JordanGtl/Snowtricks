<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    /**
     * @Route("/Figures", name="app_figures")
     */
    public function showfigureslist(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $figures = $repository->findAll();

        return $this->render('figure/list.html.twig', ['figures' => $figures]);
    }

    /**
     * @Route("/Figure/{slug}", name="app_figurepage")
     */
    public function show($slug, Request $request, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $repositorycom = $em->getRepository(Comment::class);

        $figure = $repository->findOneBy(['name' => $slug]);
        $form = $this->createForm(CommentType::class);
        $comments = $repositorycom->findBy(['figureid' => $figure->getId()], array('updatedate' => 'DESC'), 2, 0);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                $user = $this->getUser();
                $com = $form->getData();
                $com->setFigureid($figure);
                $com->setAuthorid($user);
                $com->setUpdatedate(new \DateTime('@'.strtotime('now')));

                $em->persist($com);
                $em->flush();
            }
        }

        return $this->render('figure/detail.html.twig', [
            'figure' => $figure,
            'commentform' => $form->createView(),
            'comments' => $comments,
            'commpentbaseindex' => 2
        ]);
    }

    /**
     * @Route("/FigureCom/{slug}/{index}", name="app_commentajax")
     */
    public function ajaxcomment($slug, $index, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $repositorycom = $em->getRepository(Comment::class);

        $figure = $repository->findOneBy(['id' => $slug]);
        $comments = $repositorycom->findBy(['figureid' => $figure->getId()], array('updatedate' => 'DESC'), 2, $index);

        $results = array();

        foreach($comments as $comment)
        {
            $results[] = array('id' => $comment->getId(), 'author' => $comment->getAuthorid()->getUsername(), 'content' => $comment->getContent(), 'date' => $comment->getUpdatedate()->format('d/m/Y h:i'));
        }

        return $this->json($results);
    }

    /**
     * @Route("/FigureLoad/{index}", name="app_figureajax")
     */
    public function ajaxfigure($index, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $figures = $repository->createQueryBuilder('n')->setMaxResults(6)->setFirstResult($index)->getQuery()->getResult();

        $results = array();

        foreach($figures as $figure)
        {
            $results[] = array('id' => $figure->getId(), 'name' => $figure->getName(),  'author' => $figure->getAuthorid()->getUsername(), 'date' => $figure->getPublishedAt()->format('d/m/Y h:i'));
        }

        return $this->json($results);
    }
}
<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TrickController extends AbstractController
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

        $trick = $repository->findOneBy(['name' => $slug]);
        $form = $this->createForm(CommentType::class);

        $comments = ($trick != null) ? $repositorycom->findBy(['trickid' => $trick->getId()], array('updatedate' => 'DESC'), 2, 0) : '';

        if ($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $user = $this->getUser();
                $com = $form->getData();
                $com->setFigureid($trick);
                $com->setAuthorid($user);
                $com->setUpdatedate(new \DateTime('@'.strtotime('now')));

                $em->persist($com);
                $em->flush();
            }
        }

        return $this->render('figure/detail.html.twig', [
            'trick' => $trick,
            'commentform' => $form->createView(),
            'comments' => $comments,
            'commpentbaseindex' => 2,
            'editmode' => false
        ]);
    }

    /**
     * @Route("/Figure/{slug}/edit", name="app_figurepage_edit")
     * @Security("has_role('ROLE_USER')")
     */
    public function edit($slug, Request $request, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $trick = $repository->findOneBy(['name' => $slug]);
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('notice','La figure à été éditée');

            return $this->redirectToRoute('app_figurepage', ['slug' => $form->getViewData()->getName()]);
        }



        return $this->render('figure/edit.html.twig', [
            'trick' => $trick,
            'trickform' => $form->createView(),
            'editmode' => true]);
    }

    /**
     * @Route("/Figure/{slug}/trash", name="app_figurepage_trash")
     * @Security("has_role('ROLE_USER')")
     */
    public function trash($slug, Request $request, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $trick = $repository->findOneBy(['name' => $slug]);

        if($trick != null) {
            $em->remove($trick);
            $em->flush();
        }

        $this->addFlash('notice','La figure à été supprimées');

        return $this->redirectToRoute('homepage');
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
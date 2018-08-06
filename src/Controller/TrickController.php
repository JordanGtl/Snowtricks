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
     * @Route("/Tricks", name="app_tricks")
     */
    public function showfigureslist(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $tricks = $repository->findAll();

        return $this->render('trick/list.html.twig', ['tricks' => $tricks]);
    }

    /**
     * @Route("/Trick/{slug}", name="app_trick")
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
                $com->setTrickid($trick);
                $com->setAuthorid($user);
                $com->setUpdatedate(new \DateTime('@'.strtotime('now')));

                $em->persist($com);
                $em->flush();

                return $this->redirectToRoute('app_trick', array('slug' => $slug));
            }
        }

        return $this->render('trick/detail.html.twig', [
            'trick' => $trick,
            'commentform' => $form->createView(),
            'comments' => $comments,
            'commpentbaseindex' => 2,
            'editmode' => false
        ]);
    }

    /**
     * @Route("/Trick/{slug}/edit", name="app_trick_edit")
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

            return $this->redirectToRoute('app_trick', ['slug' => $form->getViewData()->getName()]);
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'trickform' => $form->createView(),
            'editmode' => true]);
    }

    /**
     * @Route("/Trick/{slug}/trash", name="app_trick_trash")
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
     * @Route("/TrickCom/{slug}/{index}", name="app_commentajax")
     */
    public function ajaxcomment($slug, $index, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $repositorycom = $em->getRepository(Comment::class);

        $trick = $repository->findOneBy(['id' => $slug]);
        $comments = $repositorycom->findBy(['trickid' => $trick->getId()], array('updatedate' => 'DESC'), 2, $index);

        $results = array();

        foreach($comments as $comment)
        {
            $results[] = array('id' => $comment->getId(), 'author' => $comment->getAuthorid()->getUsername(), 'content' => $comment->getContent(), 'date' => $comment->getUpdatedate()->format('d/m/Y h:i'));
        }

        return $this->json($results);
    }

    /**
     * @Route("/TrickLoad/{index}", name="app_figureajax")
     */
    public function ajaxfigure($index, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $tricks = $repository->createQueryBuilder('n')->setMaxResults(6)->setFirstResult($index)->getQuery()->getResult();

        $results = array();

        foreach($tricks as $trick)
        {
            $results[] = array('id' => $trick->getId(), 'name' => $trick->getName(),  'author' => $trick->getAuthorid()->getUsername(), 'date' => $trick->getPublishedAt()->format('d/m/Y h:i'));
        }

        return $this->json($results);
    }
}
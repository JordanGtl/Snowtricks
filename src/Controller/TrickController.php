<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\TrickMedia;
use App\Form\CommentType;
use App\Form\TrickMediaType;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        $tricks = $repository->findBy(['active' => true]);

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

        if($trick == null)
        {
            $this->addFlash('error', 'La figure que vous essayez d\'atteindre n\'existe pas.');
            return $this->redirectToRoute('app_tricks');
        }

        $form = $this->createForm(CommentType::class);

        $comments = ($trick != null) ? $repositorycom->findBy(['trickid' => $trick->getId()], array('updatedate' => 'DESC'), $this->getParameter('comment_per_page'), 0) : '';

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $com = $form->getData();
            $com->setTrickid($trick);
            $com->setAuthorid($user);
            $com->setUpdatedate(new \DateTime('@'.strtotime('now')));

            $em->persist($com);
            $em->flush();

            return $this->redirectToRoute('app_tricks', array('slug' => $slug));
            }

        return $this->render('trick/detail.html.twig', [
            'trick' => $trick,
            'commentform' => $form->createView(),
            'comments' => $comments,
            'commpentbaseindex' => $this->getParameter('comment_per_page'),
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
            $trick->setUpdatedDate(new \DateTime('now'));
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
     * @Route("/TrickNew", name="app_trick_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $tricRepo = $em->getRepository(Trick::class);
        $dbtrick = $tricRepo->findOneBy(['authorid' => $this->getUser(), 'active' => false]);

        if($dbtrick == null)
        {
            $trick = new Trick();
            $trick->setPublishedAt(new \DateTime('now'));
            $trick->setUpdatedDate(new \DateTime('now'));
            $trick->setAuthorid($this->getUser());
            $trick->setCoverMedia(null);
            $trick->setActive(false);
            $trick->setName('');
            $trick->setDescription('');

            $em->persist($trick);
            $em->flush();
        }
        else
            $trick = $dbtrick;

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $trick->setPublishedAt(new \DateTime('now'));
            $trick->setUpdatedDate(new \DateTime('now'));
            $trick->setActive(true);
            $em->flush();

            $this->addFlash('notice','La figure à été ajoutée');

            return $this->redirectToRoute('app_trick', ['slug' => $form->getViewData()->getName()]);
        }

        return $this->render('trick/add.html.twig', [
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

        if($trick != null)
        {
            $trick->setCoverMedia(null);
            $em->flush();

            foreach($trick->getComments() as $comment)
            {
                $em->remove($comment);
                $em->flush();
            }

            foreach($trick->getTrickMedia() as $media)
            {
                $em->remove($media);
                $em->flush();
            }

            $em->remove($trick);
            $em->flush();
        }

        $this->addFlash('notice','La figure à été supprimées');

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/TrickNewSave/{id}", name="app_tricknewsaveajax")
     */
    public function ajaxnewsave($id, Request $request, EntityManagerInterface $em)
    {
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $group = $request->request->get('group');
        $results = array();

        $repository = $em->getRepository(Trick::class);
        $repositoryGroup = $em->getRepository(TrickGroup::class);

        $trick = $repository->find($id);
        $group = $repositoryGroup->find($group);

        if($trick != null) {
            $trick->setName($name);
            $trick->setDescription($description);
            $trick->setGroupid($group);
            $em->flush();
            $results['status'] = true;
        }
        else
        {
            $results['status'] = false;
            $eresult['message'] = "La figure n'existe pas";
        }


        return $this->json($results);
    }

    /**
     * @Route("/TrickCom/{slug}/{index}", name="app_commentajax")
     */
    public function ajaxcomment($slug, $index, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $repositorycom = $em->getRepository(Comment::class);

        $trick = $repository->findOneBy(['id' => $slug]);
        $comments = $repositorycom->findBy(['trickid' => $trick->getId()], array('updatedate' => 'DESC'), $this->getParameter('comment_per_page'), $index);

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

        $tricks = $repository->findByPagination($this->getParameter('trick_index_nbr'), $index);

        $results = array();

        foreach($tricks as $trick)
        {
            $results[] = array('id' => $trick->getId(), 'name' => $trick->getName(),  'author' => $trick->getAuthorid()->getUsername(), 'date' => $trick->getPublishedAt()->format('d/m/Y h:i'));
        }

        return $this->json($results);
    }
}
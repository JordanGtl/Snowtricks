<?php
namespace App\Controller;

use App\Entity\Trick;
use App\Entity\TrickMedia;
use App\Form\TrickMediaType;
use App\Repository\TrickPictureRepository;
use App\Service\Upload;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TrickMediaController extends AbstractController
{
    /**
     * @Route("/MediaDel/{index}", name="app_mediadelajax")
     * @Security("has_role('ROLE_USER')")
     */
    public function mediadel($index, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(TrickMedia::class);

        $media = $repository->findOneBy(['id' => $index]);
        $result = false;

        if($media != null)
        {
            $em->remove($media);
            $em->flush();
            $result = true;
        }

        $return = array('id' => $media->getId(), 'result' => $result);

        return $this->json($return);
    }

    /**
     * @Route("/MediaSetCover/{trickid}/{index}", name="app_mediasetcover")
     * @Security("has_role('ROLE_USER')")
     */
    public function mediasetcover($trickid, $index, EntityManagerInterface $em)
    {
        $Trickrepository = $em->getRepository(Trick::class);
        $Mediarepository = $em->getRepository(TrickMedia::class);

        $trick = $Trickrepository->findOneBy(['id' => $trickid]);
        $media = $Mediarepository->findOneBy(['id' => $index]);

        $result = false;

        if($trick != null && $media != null)
        {
            $trick->setCoverMedia($media);
            $em->flush();
            $result = true;
        }

        return $this->json(array('result' => $result));
    }

    /**
     * @Route("/Trick/{slug}/addmedia", name="app_trick_addmedia")
     * @Security("has_role('ROLE_USER')")
     */
    public function addmedia($slug, Request $request, EntityManagerInterface $em, Upload $upload)
    {
        $repository = $em->getRepository(Trick::class);
        $trick = $repository->findOneBy(['id' => $slug]);

        $trickmedia = new TrickMedia();
        $form = $this->createForm(TrickMediaType::class, $trickmedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $trickmedia->setLink($upload->Upload($trickmedia->getLink(), $this->getParameter('upload_directory_trick')));
            $trickmedia->setIdFigure($trick);

            $em->persist($trickmedia);
            $em->flush();
            $this->addFlash('notice','Le nouveau média à été ajouté');

            if($trick->getName() == $this->getUser()->getUsername())
            {
                if($trick->getCoverMedia() == null)
                {
                    $trick->setCoverMedia($trickmedia);
                    $em->flush();
                }

                return $this->redirectToRoute('app_trick_new');
            }
            else
                return $this->redirectToRoute('app_trick', ['slug' => $trick->getName()]);
        }

        return $this->render('trick/addmedia.html.twig', [
            'trick' => $trick,
            'mediaform' => $form->createView(),
            'editmode' => false,
            'edit' => false]);
    }


    /**
     * @Route("/MediaEdit/{index}", name="app_mediaedit")
     * @Security("has_role('ROLE_USER')")
     */
    public function mediaedit($index, Request $request, EntityManagerInterface $em, TrickPictureRepository $trickmediaRepo)
    {
        $trickmedia = $trickmediaRepo->find($index);
        $string = $trickmedia->getLink();
        $trickmedia->setTempLink($trickmedia->getLink());
        $trickmedia->setLink(null);

        if($trickmedia == null)
        {
            $this->addFlash('error', 'Le media que vous essayez d\'éditer n\'existe pas');
            return $this->redirectToRoute('app_trick');
        }

        $form = $this->createForm(TrickMediaType::class, $trickmedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $trickmedia->setLink($trickmedia->getTempLink());
            $em->flush();

            $this->addFlash('notice', 'Le média à été modifié');

            return $this->redirectToRoute('app_trick', ['slug' => $trickmedia->getIdFigure()->getName()]);
        }

        return $this->render('trick/addmedia.html.twig', [
            'trick' => $trickmedia->getIdFigure(),
            'mediaform' => $form->createView(),
            'editmode' => false,
            'edit' => true]);
    }
}
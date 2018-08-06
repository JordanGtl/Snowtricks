<?php
namespace App\Controller;

use App\Entity\Trick;
use App\Entity\TrickMedia;
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
}
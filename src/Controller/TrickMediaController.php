<?php
namespace App\Controller;

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
    public function ajaxcomment($index, EntityManagerInterface $em)
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
}
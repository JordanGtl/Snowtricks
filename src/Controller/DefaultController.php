<?php
namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);

        $figures = $repository->findActive($this->getParameter('trick_index_nbr'));

        return $this->render('default/home.html.twig', ['figures' => $figures, 'figurebaseindex' => $this->getParameter('trick_index_nbr')]);
    }

    /**
     * @Route("/MentionsLegales", name="ml")
     */
    public function ml(EntityManagerInterface $em)
    {
        return $this->render('default/ml.html.twig');
    }

    
}
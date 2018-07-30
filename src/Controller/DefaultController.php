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

        $figures = $repository->createQueryBuilder('n')->setMaxResults(6)->getQuery()->getResult();

        return $this->render('default/home.html.twig', ['figures' => $figures, 'figurebaseindex' => 6]);
    }

    
}
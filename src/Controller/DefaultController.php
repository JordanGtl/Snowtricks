<?php
namespace App\Controller;

use App\Entity\Figure;
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
        $repository = $em->getRepository(Figure::class);

        $figures = $repository->findAll();

        return $this->render('default/home.html.twig', ['figures' => $figures]));
    }

    
}
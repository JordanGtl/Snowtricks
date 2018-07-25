<?php
namespace App\Controller;

use App\Entity\Figure;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    /**
     * @Route("/Figures", name="app_figures")
     */
    public function showfigureslist(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Figure::class);

        $figures = $repository->findAll();

        return $this->render('figure/list.html.twig', ['figures' => $figures]);
    }
}
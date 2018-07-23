<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    /**
     * @Route("/Figures", name="app_figures")
     */
    public function showfigureslist()
    {
        return $this->render('figure/list.html.twig');
    }
}
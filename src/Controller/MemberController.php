<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/Register", name="app_register")
     */
    public function register()
    {
        return $this->render('member/register.html.twig');
    }

    /**
     * @Route("/Login", name="app_login")
     */
    public function login()
    {
        return $this->render('member/login.html.twig');
    }
}
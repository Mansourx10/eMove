<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function index()
    {
        return $this->render('security/login.html.twig');

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){}
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'PERRY',
            'firstName' => 'Here'
        ]);
    
    }
    #[Route('/nom', name: 'nom')]
    public function nom(): Response
    {
        return $this->render('first/nom.html.twig', [
        ]);
    
    }
    #[Route('/sayHello/{param?here}', name: 'sayHello')]
    public function sayHello($param): Response
    {
        return $this->render('first/sayHello.html.twig', [
            'nom' => $param
        ]);
    }
}

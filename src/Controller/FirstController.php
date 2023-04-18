<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
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

    // #[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello(Request $request, $name, $firstname): Response
    {
        return $this->render('first/sayHello.html.twig', [
            'nom' => $name,
            'prenom' => $firstname,
        ]);
    }

    
    #[Route('/template', name: 'template')]
    public function template(): Response
    {
        return $this->render('Template.html.twig',);
    }
}

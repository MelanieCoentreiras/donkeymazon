<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{firstname}', name: 'app_hello')] // {firstname} paramètre dynamique
    public function index(string $firstname): Response
    {
        return $this->render('hello/index.html.twig', [ // on doit passer la var au template twig
            'name' => $firstname,
        ]);
    }
}

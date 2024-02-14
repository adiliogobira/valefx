<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeloController extends AbstractController
{
    #[Route('/modelo', name: 'app_modelo')]
    public function index(): Response
    {
        return $this->render('modelo/index.html.twig', [
            'controller_name' => 'ModeloController',
        ]);
    }
}

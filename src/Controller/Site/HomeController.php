<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_site_home')]
    public function index(): Response
    {
        return $this->render('site/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Deixar as páginas todas dinanicas, para que
     * não tenha a necessidade de ficar criando telas
     * no front-end deixando assim o sistema mais leve.
     */
    #[Route('/page/{slug}', name: 'app_site_pages')]
    public function pages(Request $request, $slug): Response
    {

        return $this->render("site/{$slug}/index.html.twig", [
            'controller_name' => 'HomeController',
        ]);
    }
}

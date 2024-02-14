<?php

namespace App\Controller\Adm;

use App\Authenticate\Auth;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/adm/sys/home', name: 'app_adm_dashboard_home')]
    public function home(EntityManagerInterface $em, Request $request): Response
    {
        //dd($request->getSession());
        return $this->render('adm/dashboard/index.html.twig', [
            'controller_name' => 'AdmDashboardController',
            'user' => (new Auth())->getUserData($request, $em),
        ]);
    }
}

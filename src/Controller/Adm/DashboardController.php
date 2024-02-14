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
        $boxes = $em->getRepository(\App\Entity\Apport::class);
        $ganhos = $boxes->blockBoxes($request->getSession()->get('authUser'), '>');
        $perdas = $boxes->blockBoxes($request->getSession()->get('authUser'), '<');
        $saldo = $boxes->blockSaldo($request->getSession()->get('authUser'));
        //dd($saldo);
        return $this->render('adm/dashboard/index.html.twig', [
            'controller_name' => 'AdmDashboardController',
            'user' => (new Auth())->getUserData($request, $em),
            'ganhos' => number_format($ganhos['budget'], 2, ',', '.'),
            'perdas' => number_format($perdas['budget'], 2, ',', '.'),
            'saldo' => number_format($saldo['value'], 2, ',', '.'),
        ]);
    }
}

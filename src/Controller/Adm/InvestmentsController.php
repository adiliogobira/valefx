<?php

namespace App\Controller\Adm;

use App\Authenticate\Auth;
use App\Entity\Applications;
use App\Entity\Apport;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvestmentsController extends AbstractController
{

    #[\Symfony\Component\Routing\Annotation\Route('/adm/sys/investment/lista', name: 'app_adm_investment_lista')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);

        $lists = $em->getRepository(Applications::class)->listaAplicacao();
        return $this->render('adm/investments/index.html.twig', [
            'users' => $users,
            'lists' => $lists,
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }

    #[Route('/adm/sys/investment/novo', name: 'app_adm_investment_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);
        $ativos = $em->getRepository(Applications::class)->listaAtivos();

        $lists = $em->getRepository(Applications::class)->listaAplicacao();
        return $this->render('adm/investments/create.html.twig', [
            'users' => $users,
            'lists' => $lists,
            'ativos' => $ativos,
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }

    #[Route('/adm/sys/investment/novo/store', name: 'app_adm_investment_store')]
    public function store(EntityManagerInterface $em, Request $request): JsonResponse
    {

//        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);
        return new JsonResponse($_POST);
    }

    #[Route('/adm/sys/investment/{investId}', name: 'app_adm_investment_edit')]
    public function edit(EntityManagerInterface $em, Request $request, $investId): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);
        $ativos = $em->getRepository(Applications::class)->listaAtivos();
        $investimento = $em->getRepository(Apport::class)->find($investId);
        // Quebrando os ativos do usuario
        $actives = explode(",", $investimento->getDataAport());
        $ativo = '';
        foreach($actives as $active){
            $ativo .='<div class="item">'.$active.'</div>';
        }
//        dd($actives);
        return $this->render('adm/investments/edit.html.twig', [
            'users' => $users,
            'investiment' => $investimento,
            'ativos' => $ativos,
            'ativo' => $ativo,
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }

    #[Route('/adm/sys/investment/{investId}/update', name: 'app_adm_investment_update')]
    public function update(EntityManagerInterface $em, Request $request): JsonResponse
    {
//        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);
        return new JsonResponse($_POST);
    }
}

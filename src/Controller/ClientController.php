<?php

namespace App\Controller;

use App\Authenticate\Auth;
use App\Entity\Applications;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        return $this->render('client/index.html.twig', [
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ClientController',
        ]);
    }


    #[Route('/cliente/sys/application/nova', name: 'app_client_applications')]
    public function lista(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);
        $ativos = $em->getRepository(Applications::class)->listaAtivos();

        return $this->render('adm/applications/index.html.twig', [
            'users' => $users,
            'user' => (new Auth())->getUserData($request, $em),
            'ativos' => $ativos,
            'controller_name' => 'ApplicationsController',
        ]);
    }

    #[Route('/cliente/sys/application/lista', name: 'app_client_applications_lista')]
    public function listApplication(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);

        $lists = $em->getRepository(Applications::class)->listaAplicacao($request->getSession()->get('authUser'));
        return $this->render('adm/applications/list.html.twig', [
            'users' => $users,
            'lists' => $lists,
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }

    #[Route('/cliente/sys/application/grafico', name: 'app_client_application_grafico')]
    public function grafico(EntityManagerInterface $em, Request $request): Response
    {

        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);

        $lists = $em->getRepository(Applications::class)->listaAplicacao($request->getSession()->get('authUser'));
        $meses = [];
        $valores = [];
        $porcentagem = [];
        $investimento = [];
        $grafico = [];
        $totalValue = [];
        foreach ($lists as $lista) {

            $grafico[] = [
                'mes' => (new \App\Service\Util)->converteMes(date('m', strtotime($lista['created_at']))),
                'valores' => $lista['value'],
                'porcentagem' => $lista['percentual'],
                'investimento' => $lista['budget'],
            ];
            $totalValue[] = $lista['value'];
            $meses[] = (new \App\Service\Util)->converteMes(date('m', strtotime($lista['created_at'])));
            $valores[] = $lista['value'];
            $porcentagem[] = $lista['percentual'];
            $investimento[] = $lista['budget'];
        }

        return $this->render('client/grafico.html.twig', [
            'users' => $users,
            'lists' => $lists,
            'totalValue' => max($totalValue),
            'meses' => json_encode($meses),
            'valores' => json_encode($valores),
            'porcentagem' => json_encode($porcentagem),
            'investimento' => json_encode($investimento),
            'grafico' => json_encode($grafico),
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }
}

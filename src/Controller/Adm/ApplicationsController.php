<?php

namespace App\Controller\Adm;

use App\Authenticate\Auth;
use App\Entity\Applications;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationsController extends AbstractController
{
    #[Route('/adm/sys/application/nova', name: 'app_adm_applications')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);

        return $this->render('adm/applications/index.html.twig', [
            'users' => $users,
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }

    #[Route('/adm/sys/application/lista', name: 'app_adm_applications_lista')]
    public function listApplication(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(Users::class)->findBy(['accessLevel' => '2']);

        $lists = $em->getRepository(Applications::class)->listaAplicacao();
        return $this->render('adm/applications/list.html.twig', [
            'users' => $users,
            'lists' => $lists,
            'user' => (new Auth())->getUserData($request, $em),
            'controller_name' => 'ApplicationsController',
        ]);
    }
}

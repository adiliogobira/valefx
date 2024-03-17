<?php

namespace App\Controller\Adm;

use App\Authenticate\Auth;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/adm/user', name: 'app_adm_user')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $clientes = $em->getRepository(Users::class)->listClients();
        
        return $this->render('adm/user/list.html.twig', [
            'controller_name' => 'UserController',
            'user' => (new Auth())->getUserData($request, $em),
            'clientes' => $clientes,
        ]);
    }

    #[Route('/adm/sys/user/edit/{userId}', name: 'app_adm_dashboard_user_edit')]
    public function editUser(EntityManagerInterface $em, Request $request): Response
    {
        //dd($request->getSession());
        return $this->render('adm/user/index.html.twig', [
            'controller_name' => 'AdmDashboardController',
            'user' => (new Auth())->getUserData($request, $em, $request->get('userId')),
        ]);
    }

    #[Route('/adm/sys/user/edit/{userId}/update', name: 'app_adm_dashboard_user_edit_update')]
    public function updateUser(EntityManagerInterface $em, Request $request): Response
    {
        $user = $em->getRepository(Users::class)->find($request->get('userId'));
        $update = false;
        if ($user->getName() != $request->get('name')) {
            $user->setName($request->get('name'));
            $update = true;
        } elseif ($user->getLastname() != $request->get('lastname')) {
            $user->setLastname($request->get('lastname'));
            $update = true;
        } elseif ($user->getEmail() != $request->get('email')) {
            $user->setEmail($request->get('email'));
            $update = true;
        }

        if ($request->get('password') && $request->get('repeatpassword')) {
            if ($request->get('repeatPassword') != $request->get('repeatPassword')) {
                return new Response(" As senhas não conferem");
            }
            if ($request->get('password') < Auth::CONF_PASSWD_MIN_LEN && $request->get('password') > Auth::CONF_PASSWD_MAX_LEN) {
                return new Response("Para o cadastro é necessário o mínimo 6 caracteres para a senha, o maximo 40 caracteres para a senha!");
            }
            $user->setPassword((new Auth())->passwd($request->get('password')));
        }

        if ($update) {
            $em->persist($user);
            $em->flush();
        }
        return $this->redirectToRoute('app_adm_dashboard_user_edit', ['userId' => $request->get('userId')]);
    }
}

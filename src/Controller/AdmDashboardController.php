<?php

namespace App\Controller;

use App\Authenticate\Auth;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class AdmDashboardController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/adm/sys/login', name: 'app_adm_dashboard_login')]
    public function login(Request $request): Response
    {
        if ($request->getSession()->get('authUser')) {
            return $this->redirectToRoute('app_adm_dashboard_home');
        }

        return $this->render('adm_dashboard/login.html.twig', [
            'controller_name' => 'AdmDashboardController',
            'user' => false,
        ]);
    }

    /**
     * @return Response
     */
    #[Route('/adm/sys/login/authenticate', name: 'app_adm_dashboard_login_authenticate')]
    public function authenticate(EntityManagerInterface $entityManager, Request $request): Response
    {
        (new Auth())->login($request, $entityManager, $entityManager->getRepository(Users::class));

        if ($request->getSession()->get('authUser')) {
            return $this->redirectToRoute('app_adm_dashboard_home');
        }

        return new Response("Seu login não foi possivel, tente novamente mais tarde!");
    }

    #[Route('/adm/sys/logout', name: 'app_adm_dashboard_logout')]
    public function logout(EntityManagerInterface $entityManager, Request $request): Response
    {
        $request->getSession()->clear();
        return $this->redirectToRoute('app_adm_dashboard_login');
    }

    /**
     * @return Response
     */
    #[Route('/adm/sys/register', name: 'app_adm_dashboard_register')]
    public function register(): Response
    {
        return $this->render('adm_dashboard/register.html.twig', [
            'controller_name' => 'AdmDashboardController',
            'user' => false,
        ]);
    }

    /**
     * @return Response
     */
    #[Route('/adm/sys/register/create', name: 'app_adm_dashboard_registerCreate')]
    public function registerCreate(EntityManagerInterface $entityManager, MailerInterface $mailer, Request $request): Response
    {
        $auth = new Auth();

        if (!$request->get('name')) {
            echo "É necessário informar o nome para o cadastro";
        }
        if (!$request->get('lastname')) {
            echo "É necessário informar o sobrenome para o cadastro";
        }
        if (!$request->get('email')) {
            echo "É necessário informar o e-mail para o cadastro";
        }
        if (!$request->get('password')) {
            echo "É necessário informar a senha para o cadastro";
        }
        if (!$request->get('repeatPassword')) {
            echo "É necessário informar novamente a senha para o cadastro";
        }
        if ($request->get('repeatPassword') != $request->get('repeatPassword')) {
            echo " As senhas não conferem";
        }
        if ($request->get('password') < Auth::CONF_PASSWD_MIN_LEN && $request->get('password') > Auth::CONF_PASSWD_MAX_LEN) {

            echo "Para o cadastro é necessário o mínimo 6 caracteres para a senha, o maximo 40 caracteres para a senha!";
        }
        try {

            $user = new Users();
            $user->setName($request->get('name'));
            $user->setLastname($request->get('lastname'));
            $user->setEmail($request->get('email'));
            $user->setPassword($auth->passwd($request->get('password')));
            $user->setAccessLevel('0');
            $user->setStatus('Inativo');
            $user->setCreatedAt(date('Y-m-d H:i:s'));
            $user->setUpdatedAt(date('Y-m-d H:i:s'));
            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new Email())
                ->from($_SERVER['MAILER_USER'])
                ->to($request->get('email'))
                ->subject('A Sua Conta Foi Criada Com Sucesso!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);
            $link = $this->generateUrl('app_adm_activate_account', ['hash' => base64_encode($request->get('email'))]);
            dd($email, $mailer, $link);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return $this->render('adm_dashboard/register.html.twig', [
            'controller_name' => 'AdmDashboardController',
        ]);
    }

    /**
     * @return Response
     */
    #[Route('/adm/sys/recover', name: 'app_adm_dashboard_recover')]
    public function recover(): Response
    {
        return $this->render('adm_dashboard/recover.html.twig', [
            'controller_name' => 'AdmDashboardController',
            'user' => false,
        ]);
    }

    #[Route('/adm/sys/activate-account/{hash}', name: 'app_adm_activate_account')]
    public function activeAcccount(EntityManagerInterface $entityManager, Request $request, $hash): Response
    {
        $hash = base64_decode($hash);
        $user = $entityManager->getRepository(Users::class)->findOneBy(['email' => $hash]);
        $user->setAccessLevel('2');
        $user->setStatus('Ativo');
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('app_adm_dashboard_login');
    }
}

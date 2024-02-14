<?php

namespace App\Authenticate;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

class Auth
{
    const CONF_PASSWD_MIN_LEN = 6;
    const CONF_PASSWD_MAX_LEN = 40;
    const CONF_PASSWD_ALGO = PASSWORD_DEFAULT;
    const CONF_PASSWD_OPTION = ['cost' => 10];
    protected $credential;

    private $em;
    private $repository;
    private $request;

    public function validateLogin(Request $request, $em, $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->request = $request;
        return $this->attempt($request->get('email'), $request->get('password'));
    }

    public function getUserData($request, $em)
    {
        return $em->getRepository(\App\Entity\Users::class)->find($request->getSession()->get('authUser'));
    }

    private function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @throws \Exception
     */
    public function attempt(string $email, string $password, int $level = 2): ?Users
    {
        if (!$this->isEmail($email)) {
            throw new \Exception("O e-mail informado não é válido");
            return null;
        }

        if (!$this->isPasswd($password)) {
            throw new \Exception("A senha informada não é válida");
            return null;
        }

        $user = $this->repository->findOneBy(['email' => $email]);

        if (!$user) {
            throw new \Exception("O e-mail informado não está cadastrado");
            return null;
        }

        if (!$this->passwdVerify($password, $user->getPassword())) {
            throw new \Exception("A senha informada não confere");
            return null;
        }

        if ($user->getAccessLevel() < $level) {
            throw new \Exception("Desculpe, mas você não tem permissão para logar-se aqui");
            return null;
        }

//        dd($this->passwd_rehash($password));
        if ($this->passwdRehash($password)) {
            $user->setPassword($this->passwd($password));
            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $save
     * @param int $level
     * @return bool
     */
    public function login(Request $request, $em, $repository): bool
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->request = $request;

        $user = $this->attempt($request->get('email'), $request->get('password'));
        if (!$user) {
            return false;
        }

        if ($request->get('remember') == 'on') {
            setcookie("authEmail", $request->get('email'), time() + 604800, "/");
        } else {
            setcookie("authEmail", null, time() - 3600, "/");
        }

        //LOGIN
        $this->request->getSession()->set("authUser", $user->getId());
        return true;
    }

    function passwd(string $password): string
    {
        if (!empty(password_get_info($password)['algo'])) {
            return $password;
        }

        return password_hash($password, self::CONF_PASSWD_ALGO, self::CONF_PASSWD_OPTION);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    function passwdVerify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * @param string $hash
     * @return bool
     */
    function passwdRehash(string $hash): bool
    {
        return password_needs_rehash($hash, self::CONF_PASSWD_ALGO, self::CONF_PASSWD_OPTION);
    }

    private function isPasswd(string $password): bool
    {
        if (password_get_info($password)['algo'] || (mb_strlen($password) >= self::CONF_PASSWD_MIN_LEN && mb_strlen($password) <= self::CONF_PASSWD_MAX_LEN)) {
            return true;
        }

        return false;
    }
}

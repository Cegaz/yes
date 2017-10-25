<?php

namespace Controller;
session_start();

class LogIn extends AbstractController
{
    protected $_user;
    protected $_password;

    public function getUser(){
        $this->_user = 'jo';//$_POST['user'];
        return $this->_user;
    }

    public function getPassword()
    {
        $this->_password = 'madalton';//$_POST['password'];
        return $this->_password;
    }

    public function logIn() {
        require_once '../app/connect.php';
        $manager = new LogInManager($db);
        $user = $this->getUser();
        $password = $this->getPassword();
        $login = $manager->checkUser($user, $password);

        return $this->_twig->render('textlogin.html.twig', ['login' => $login]);

    }

    public function logOut()
    {
        session_destroy();
        var_dump($_SESSION);
        return $this->_twig->render('textlogin.html.twig');
    }

    public function session()
    {
        var_dump($_SESSION);
        return $this->_twig->render('textlogin.html.twig');
    }

}
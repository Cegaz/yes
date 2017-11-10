<?php

namespace Controller;
session_start();
use Model\LogInManager;

class LogIn extends AbstractController
{
    protected $_user;
    protected $_password;

    public function getUser(){
        $this->_user = $_POST['user'];
        return $this->_user;
    }

    public function getPassword()
    {
        $this->_password = $_POST['password'];
        return $this->_password;
    }

    public function logIn() {
        require_once '../app/connect.php';
        $manager = new LogInManager($db);
        $user = $this->getUser();
        $password = $this->getPassword();
        $login = $manager->checkUser($user, $password);

        return $this->_twig->render('home.html.twig', ['login' => $login, 'sess' => $_SESSION]);
    }

    public function logOut()
    {
        session_destroy();
        return $this->_twig->render('textlogin.html.twig');
    }

    public function session()
    {
        return $this->_twig->render('textlogin.html.twig');
    }
}
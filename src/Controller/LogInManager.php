<?php


namespace Controller;
session_start();
class LogInManager
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function checkUser($user, $password)
    {
        $queryUser = "SELECT *
                  FROM user 
                  WHERE pseudo =:user
                  AND password =:password";
        $prep = $this->_db->prepare($queryUser);

        $prep->bindValue(':user', $user);
        $prep->bindValue(':password', $password);
        $prep->execute();
        $fetch = $prep->fetchAll();

        if (!empty($fetch)) {
            $this->logUser($user);
            return "Bonjour " . $_SESSION['name'];
        } else {
            return "Vous n'êtes pas connecté";
        }

    }

    public function logUser($user)
    {
        return $_SESSION['name'] = $user;

    }


}
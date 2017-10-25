<?php


namespace Controller;

class LogInManager
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function checkUser($user, $password)
    {
        if(!empty($_POST['name'] || $_POST['password'])) {
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
            } else {
                return "Identifiants invalides";
            }
        }else {
            return "veuillez remplir tous les champs";

        }

    }

    public function logUser($user)
    {
        return $_SESSION['name'] = $user;

    }


}
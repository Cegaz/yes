<?php


namespace Model;

class LogInManager
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function checkUser($user, $password)
    {

        if (!empty($_POST['pseudo'] || $_POST['password'])) {
            $queryUser = "SELECT *
                  FROM user 
                  WHERE pseudo =:user
                  AND password =:password";
            $prep = $this->_db->prepare($queryUser);

            $prep->bindValue(':user', $user);
            $prep->bindValue(':password', $password);
            $prep->execute();
            $fetch = $prep->fetch();


            if (!empty($fetch)) {
                $_SESSION['pseudo'] = $user;
                $_SESSION['idUser'] = $fetch['id'];

            } else {
                $_SESSION['error'] = "Identifiants invalides";

            }
        } else {
            $_SESSION['error'] = "veuillez remplir tous les champs";

        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: cecile
 * Date: 25/10/17
 * Time: 09:43
 */

namespace Model;


class SigninManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function newUser($pseudo, $email, $password)
    {
        $prep = $this->db->prepare('INSERT INTO user(pseudo, email, password) VALUES(:pseudo, :email, :password)');
        $querySuccess = $prep->execute([':pseudo'=>$pseudo,
            ':email'=>$email,
            ':password'=>$password,
            ]);
        return $querySuccess;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: cecile
 * Date: 25/10/17
 * Time: 09:55
 */

namespace Controller;
use Model\SigninManager;

class Signin extends AbstractController
{
    public function index(){
        $message = '';

        if(!isset($_POST['cgu'])){
            $message .= 'Veuillez accepter les CGU pour valider votre inscription.';
        }

        if(isset($_POST['pseudo'])){ // ajouter vérif que pseudo n'existe pas déjà !!
            $pseudo = htmlspecialchars($_POST['pseudo']);
        } else {
            $message .= 'Veuillez renseigner votre pseudo<br>';
        }

        if (isset($_POST['email'])) {
            $email_valid = preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,5}$#", $_POST['email']);
            if ($email_valid) {
                $email = $_POST['email'];
            } else {
                $message .= 'Veuillez renseigner un email valide<br>';
            }
        } else {
            $message .= 'Veuillez renseigner un email.<br>';
        }

        if(isset($_POST['password']) && isset($_POST['password_conf'])) {
            if ($_POST['password'] === $_POST['password_conf']) {
                $password = $_POST['password'];
            } else {
                $message .= 'Les deux mots de passe sont différents<br>';
            }
        } else {
            $message .= 'Veuillez renseigner votre mot de passe et le confirmer<br>';
        }

        if (isset($pseudo) && isset($email) && isset($password) && isset($_POST['cgu'])) {
            require_once '../app/connect.php';
            $manager = new SigninManager($db);
            $manager->newUser($pseudo, $email, $password);
            return $this->_twig->render('home.html.twig');

        } else {
            return $this->_twig->
            render('home.html.twig', ['message' => $message, 'error' => 'true']);
        }
    }
}
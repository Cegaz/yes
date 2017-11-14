<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 */

namespace Controller;
use Model\DepositManager;


class Deposit extends AbstractController
{
    public function index(){
        // TO DO : AJOUTER SI PROJECT HOLDER DEJA LIÉ À L'USER -> RENVOI VERS ESPACE PP
        return $this->_twig->render('deposit.html.twig');
    }

    public function form1(){
        require_once '../app/connect.php';
        $manager = new DepositManager($db);
        $manager->updateStep(0);

        return $this->_twig->render('form1.html.twig');
    }

    public function form2(){
        $avatar = $this->upload_image($_FILES['avatar'], 'form1.html.twig');

        require_once '../app/connect.php';
        $manager = new DepositManager($db);
        $result = $manager->newProjectHolder($_POST['structure_name'], $_POST['name'], $_POST['first_name'],
            $_POST['phone'], $avatar);
        $_SESSION['idProjectHolder'] = $db->lastInsertId();

        if($result) {
            require_once '../app/connect.php';
            $manager = new DepositManager($db);
            $manager->updateStep(1);
            return $this->_twig->render('form2.html.twig',
                ['message' => 'Vos données ont bien été sauvegardées.']);
        } else {
            return $this->_twig->render('form1.html.twig',
                ['message' => 'Il y a eu une erreur. Veuillez recommencer.']);
        }
    }

    public function form3(){
        require_once '../app/connect.php';
        $manager = new DepositManager($db);
        $manager->updateStep(2);

        $littlePicture = $this->upload_image($_FILES['littlePicture'], 'form2.html.twig');

        $manager = new DepositManager($db);
        $result = $manager->newDeposit($_POST['title'], $_POST['shortDescription'],
            $littlePicture);
        $_SESSION['idProject'] = $db->lastInsertId();

        if($result) {
            $manager = new DepositManager($db);
            $manager->updateStep(2);
            return $this->_twig->render('form3.html.twig',
                ['message' => 'Vos données ont bien été sauvegardées.']);
        } else {
            return $this->_twig->render('form2.html.twig',
                ['message' => 'Il y a eu une erreur. Veuillez recommencer.']);
        }
    }

    public function form4()
    {
        $nbFiles = count($_FILES['upload']['name']);
        $pathList = [];

        for ($i = 0; $i < $nbFiles; $i++) {
            if ($_FILES['upload']['error'][$i] == 2) {
                return $this->_twig->render('form3.html.twig',
                    ['message' => 'Les fichiers sont trop gros (1 Mo max).']);
                // AJOUTER CONTRAINTE SUR FORMAT FICHIER ?
            } else {
                $tmpFile = $_FILES['upload']['tmp_name'][$i];
                $extension = pathinfo($_FILES['upload']['name'][$i])['extension'];
                $path = '/assets/img/projects/' . $_SESSION['idProject'] . '-' . ($i + 1) .
                    '.' . $extension;
                $destination = $_SERVER['DOCUMENT_ROOT'] . $path;
                if(move_uploaded_file($tmpFile, $destination)){
                    $pathList[] = $destination;
                }
            }
        }

        require_once '../app/connect.php';
        $manager = new DepositManager($db);
        $result = $manager->updateDeposit($_POST['description1'], $_POST['description2'],
            $_POST['description3'], $_POST['description4'], $_POST['sponsors'], $pathList);
        if($result) {
            $manager = new DepositManager($db);
            $manager->updateStep(3);
            return $this->_twig->render('form4.html.twig',
                ['message' => 'Vos données ont bien été sauvegardées.']);
        } else {
            return $this->_twig->render('form3.html.twig',
                ['message' => 'Il y a eu une erreur. Veuillez recommencer.']);
        }
    }

    public function upload_image($file, $pageIfError)
    {
        if($file['littlePicture']['error'] == 2) {
            return $this ->_twig->render($pageIfError,
                ['message' => 'Le fichier est trop gros (1 Mo max).']);
        } else {
            $extension = pathinfo($file['name'])['extension'];
            $newFileName = md5_file($file['tmp_name']);
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/projects/' .
                $newFileName . '.' . $extension;
            move_uploaded_file($file['tmp_name'], $destination);
        }

        return $destination;
    }

    public function publish()
    {
        require_once '../app/connect.php';
        $manager = new DepositManager($db);
        $manager->changeProgress($_SESSION['idProject'], 'en attente de validation');

        header('Location:/espace-porteur');
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: gilles
 * Date: 07/11/17
 * Time: 16:35
 */

namespace Controller;


use Model\ProjectHolderSpaceManager;

class ProjectHolderSpace extends AbstractController
{
    public function index() {
        require_once '../app/connect.php';
        $manager = new ProjectHolderSpaceManager($db);

        $datas = $manager->checkProjectHolder($_SESSION['idUser']);
        if($datas == false) {
            $unauthorized = "Vous n'avez pas accès à cet espace";
        } else {
            $_SESSION= $datas;
            $projectManager = new ProjectsManager($db);
            $projectPreparation = $projectManager->getProjectsAbstracts($_SESSION->id, 'en rédaction');
            $published = $projectManager->getProjectsAbstracts($_SESSION->id, 'publié');
            $financing = $projectManager->getProjectsAbstracts($_SESSION->id, 'en financement');
            $closed= $projectManager->getProjectsAbstracts($_SESSION->id, 'terminé');
            $validationWaiting= $projectManager->getProjectsAbstracts($_SESSION->id, 'en attente de validation');
        }
            return $this->_twig->render('projectHolderSpace.html.twig', ['unauthorized' => $unauthorized, 'sess' => $_SESSION, 'projectPreparation' => $projectPreparation, 'published' => $published, 'financing' => $financing, 'closed' => $closed, 'validationWaiting' => $validationWaiting]);
    }
}


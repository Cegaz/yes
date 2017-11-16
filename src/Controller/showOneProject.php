<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 15/11/17
 * Time: 11:06
 */

namespace Controller;
use Model\showOneProjectManager;

class showOneProject extends AbstractController
{

    public function index($id) {
        require_once '../app/connect.php';
        $manager = new showOneProjectManager($db, $id);
        $project = $manager->showOne();

        return $this->_twig->render('oneProject.html.twig', ['project' => $project]);

    }
}
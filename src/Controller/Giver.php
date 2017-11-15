<?php
/**
 * Created by PhpStorm.
 * User: hurricane
 * Date: 07/11/17
 * Time: 17:12
 */

namespace Controller;
use Model\GiverManager;
use Model\CommentManager;

class Giver extends AbstractController
{
    public function index(){
        require_once '../app/connect.php';

        $manager = new GiverManager($db);
        $projects = $manager->get3Projects();

        $manager = new CommentManager($db);
        $comments = $manager->getComments();

        $manager = new GiverManager($db);
        $amounts = $manager->getAmounts();

        return $this->_twig->render('giver.html.twig', ['projects' => $projects, 'comments' => $comments, 'amounts'
            => $amounts]);
    }
}
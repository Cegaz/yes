<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 */

namespace Controller;

use Model\TagsManager;
use Model\ProjectsManager;

class Projects extends AbstractController
{
    public function index(){
        require_once '../app/connect.php';
        $limit = 3;
        $start = 0;
        //$progress = 'en financement';

        if(isset($_GET['page']) && $_GET['page'] > 1){
            $start = 3 * ($_GET['page'] - 1);
        }

        $manager = new ProjectsManager($db);
        $projects = $manager->getProjectsAbstracts(null, null, $limit, $start);
        $tags = new TagsManager($db);
        $results = $tags->listTags();

        return $this->_twig->render('home.html.twig', ['projects' => $projects, 'tags' => $results]);
    }


}

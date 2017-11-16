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
    public function index($page){
        require_once '../app/connect.php';
        $limit = 3;
        $start = 0;
        //$progress = 'en financement';


       if(isset($page) && $page > 1){
           $start = 3 * ($page - 1);
       } else{
           $page = 1;
       }


        $manager = new ProjectsManager($db);
        $projects = $manager->getProjectsAbstracts(null, null, $limit, $start);
        $allProjects = $manager->getProjectsAbstracts(null, null);
        $nbPages = ceil(sizeof($allProjects)/3);

        $tags = new TagsManager($db);
        $results = $tags->listTags();

        return $this->_twig->render('home.html.twig', ['numPage' => $page, 'nbPages' => $nbPages, 'projects' => $projects, 'tags' => $results]);
    }


}

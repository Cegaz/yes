<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 */

namespace Controller;

class Projects extends AbstractController
{
    public function index(){
        require_once '../app/connect.php';

        $manager = new ProjectsManager($db);
        $projects = $manager->get3Projects();
        $tags = new TagsManager($db);
        $results = $tags->listTags();
        /*foreach($projects as $project){
            $project['collected'] = 2000;
        }*/

        return $this->_twig->render('projects.html.twig', ['projects' => $projects, 'tags' => $results]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 07/11/17
 * Time: 16:13
 */

namespace Controller;


use Model\sortByTagManager;
use Model\TagsManager;

class sortByTag extends AbstractController
{

    public function index($tag){
        require_once '../app/connect.php';
        $manager = new sortByTagManager($db, $tag);
        $projects = $manager->sortByTagRequest();
        $tags = new TagsManager($db);
        $results = $tags->listTags();

        return $this->_twig->render('tag.html.twig', ['tag' => $tag, 'projects' => $projects, 'tags' => $results]);
    }

}
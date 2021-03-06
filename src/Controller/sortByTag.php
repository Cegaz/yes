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
        $numPages = 1;
        $nbPages = 1;
        $tags = new TagsManager($db);
        $results = $tags->listTags();

        return $this->_twig->render('home.html.twig',
            ['numPage' => $numPages, 'nbPages' => $nbPages, 'tag' => $tag, 'projects' => $projects, 'tags' => $results]);
    }

}
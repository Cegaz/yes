<?php
/**
 * Created by PhpStorm.
 * User: gilles
 * Date: 19/10/17
 * Time: 16:18
 */

namespace Controller;


class Tags extends AbstractController
{
    public function Index()
    {
        require '../app/connect.php';
        $tags = new TagsManager($db);
        $results = $tags->listTags();
        return $this->_twig->render('tags.html.twig', ['tags' => $results]);
    }
}
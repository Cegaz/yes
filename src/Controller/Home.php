<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 */

namespace Controller;

class Home extends AbstractController
{
    public function index(){
        return $this->_twig->render('home.html.twig');
    }

}
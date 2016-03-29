<?php

use Phalcon\Mvc\Controller;

class IndexController extends GController
{
    public function onConstruct(){
        $this->pageTitle = '首页-';
    }

    public function indexAction()
    {
        
    }
}
<?php

use Phalcon\Mvc\Controller;
/**
 * Description of UserController
 *
 * @author Administrator
 */
class UserController extends Controller {
    public function onConstruct(){
        if(!$this->session->get('user-name')){
            $this->response->redirect('signup/login');
        }
    }
    public function indexAction(){
        $this->view->setVar('user_name',  $this->session->get('user-name'));
    }
}

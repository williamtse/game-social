<?php

use Phalcon\Mvc\Controller;

/**
 * Description of GController
 *
 * @author Administrator
 */
class GController extends Controller{
    
    protected $controllerName='Index';
    protected $pageTitle='';
    
    public function beforeExecuteRoute($dispatcher)
    {
        $this->controllerName = $dispatcher->getControllerName();
        $this->view->setVar('controllerName',  $this->controllerName);
        if($userName = $this->session->get('user-name')){
            $this->view->setVar('userName',$userName);
            $this->view->setVar('userId',$this->session->get('user-id'));
        }else{
            $this->view->setVar('userName',false);
            $this->view->setVar('userId',false);
        }
    }
    
    public function afterExecuteRoute($dispatcher){
        $this->view->setVar('pageTitle',  $this->pageTitle);
    }
    
    protected function jsonOp($status,$msg=''){
        echo json_encode(array('status'=>$status,'message'=>$msg));
        exit();
    }
    
    protected function isLogin(){
        return $this->session->get('user-id');
    }
    
    protected function datetime($format='Y-m-d H:i:s',$time=null){
        $time = !$time?time():$time;
        return date($format,$time);
    }
    
    protected function getRandomToken(){
        $str = 'abcdefghijklmn0123456789!@#$%^&*()_+=-;[]~';
        return crypt(substr(str_shuffle($str),rand(0,36),6),md5(rand(1000,9999)));
    }
    
    protected function breakD($var){
        var_dump($var);
        exit();
    }
}

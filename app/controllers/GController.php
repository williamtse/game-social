<?php

use Phalcon\Mvc\Controller;

/**
 * Description of GController
 *
 * @author Administrator
 */
class GController extends Controller{
    protected $controllerName='Index';
    public function beforeExecuteRoute($dispatcher)
    {
        // 这个方法会在每一个能找到的action前执行
        $this->controllerName = $dispatcher->getControllerName();
        $this->view->setVar('controllerName',  $this->controllerName);
        if($userName = $this->session->get('user-name')){
            $this->view->setVar('userName',$userName);
        }else{
            $this->view->setVar('userName',false);
        }
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
        return crypt(substr(str_shuffle($str),rand(0,36),6),md5(rand(1000,9999)));
    }
}

<?php
use Phalcon\Mvc\Controller;
/**
 * Description of SystemController
 * @author xiewenfeng 2016-3-25 16:53:26
 * @version 1.0
 */
class SystemController  extends Controller{
    public function infoAction(){
        phpinfo();
    }
}

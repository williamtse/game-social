<?php
use Phalcon\Mvc\Controller;
/**
 * Description of ValidatecodeController
 * @author xiewenfeng 2016-3-25 16:41:54
 * @version 1.0
 */
class ValidatecodeController extends Controller{
    public function flushAction(){
        $validcode = new ValidateCode(80, 30, 4);
        $this->session->set("validate_code", $validcode->getcode()); 
        echo $validcode->outimg();
    }
    
}

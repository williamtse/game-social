<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller {

    public function registerAction() {
        if ($this->request->isPost() == true) {
            $name = $this->request->getPost('name');
            if (strlen(trim($name)) == 0) {
                $this->view->setVar('nameError', 'Please enter your name!');
            } elseif (!preg_match('/^[a-zA-Z]{1}[0-9a-zA-Z]{2,11}$/', $name)) {
                $this->view->setVar('nameError', 'name must start with a-z or A-Z and length between 3-12!');
            }
            if (!$email = $this->request->getPost('email', 'email')) {
                $this->view->setVar('emailError', 'Please input a valid email!');
            }
            $password = $this->request->getPost('password');
            if (strlen($password) == 0) {
                $this->view->setVar('passwordError', 'Please enter your password!');
            } elseif (strlen($password) < 6) {
                $this->view->setVar('passwordError', 'password must has at least 6 characters!');
            }
            $password_confirm = $this->request->getPost('password_confirm');
            if (strlen($password_confirm) == 0) {
                $this->view->setVar('password_confirmError', 'Please enter your password_confirm!');
            } elseif ($password_confirm != $password) {
                $this->view->setVar('password_confirmError', 'password must equal to password-confirm');
            }
            $validate_code = $this->request->getPost('validate_code');
            if (!strlen($validate_code)) {
                $this->view->setVar('validate_codeError', 'Please enter validate code');
            } elseif ($validate_code != $this->session->get('validate_code')) {
                $this->view->setVar('validate_codeError', 'error validate code');
            }
            
            $user = new UsersModel();
            $userdata = array(
                'name'=>$name,
                'password'=>$password,
                'email'=>$email
            );
            $userId = $user->save($userdata);
            if($userId>0){
                $this->session->set('user-name',$name);
                $this->response->redirect("index");
            }
        }
    }

}

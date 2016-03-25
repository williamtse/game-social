<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller {

    public function registerAction() {
        if ($this->request->isPost() == true) {
            $user = new Users();
            $str = 'abcdefghijklmn0123456789!@#$%^&*()_+=-;[]~';
            $token = crypt(substr(str_shuffle($str),rand(0,36),6));
            $name = $this->request->getPost('name');
            if (strlen(trim($name)) == 0) {
                $this->view->setVar('nameError', 'Please enter your name!');
                return;
            } elseif (!preg_match('/^[a-zA-Z]{1}[0-9a-zA-Z]{2,11}$/', $name)) {
                $this->view->setVar('nameError', 'name must start with a-z or A-Z and length between 3-12!');
                return;
            }
            $user_exists = $this->db->query('select * from users where name="'.$name.'"')->fetch();
            if($user_exists){
                $this->view->setVar('nameError', '用户名'.$name.'已存在!');
                return;
            }
            if (!$email = $this->request->getPost('email', 'email')) {
                $this->view->setVar('emailError', 'Please input a valid email!');
                return;
            }elseif($this->db->query('select * from users where email="'.$email.'"')->fetch()){
                $this->view->setVar('emailError', '邮箱'.$email.'已存在!');
                return;
            }
            $password = $this->request->getPost('password');
            if (strlen($password) == 0) {
                $this->view->setVar('passwordError', 'Please enter your password!');
                return;
            } elseif (strlen($password) < 6) {
                $this->view->setVar('passwordError', 'password must has at least 6 characters!');
                return;
            }
            $password_confirm = $this->request->getPost('password_confirm');
            if (strlen($password_confirm) == 0) {
                $this->view->setVar('password_confirmError', 'Please enter your password_confirm!');
                return;
            } elseif ($password_confirm != $password) {
                $this->view->setVar('password_confirmError', 'password must equal to password-confirm');
                return;
            }
            $validate_code = $this->request->getPost('validate_code');
            if (!strlen($validate_code)) {
                $this->view->setVar('validate_codeError', 'Please enter validate code');
                return;
            } elseif (strtolower($validate_code) != strtolower($this->session->get('validate_code'))) {
                $this->view->setVar('validate_codeError', 'error validate code');
                return;
            }
            
            
            $userdata = array(
                'name'=>$name,
                'password'=>md5($password.$token),
                'token'=>$token,
                'email'=>$email
            );
            $userId = $user->save($userdata);
            if($userId>0){
                $this->session->set('user-name',$name);
                $this->response->redirect("index");
            }
        }
    }
    
    public function loginAction(){
        if($this->request->isPost()){
            $validate_code = $this->request->getPost('validate_code');
            if(strtolower($validate_code)!=  strtolower($this->session->get('validate_code'))){
                $this->view->setVar('validate_codeError','验证码不正确!');
                return;
            }
            $name = $this->request->getPost('name');
            if(strlen(trim($name))==0){
                $this->view->setVar('nameError','请输入用户名！');
                return;
            }
            $user = $this->db->query('select * from users where (name="'.$name.'" or email="'.$name.'")')->fetch();
            if(!$user){
                $this->view->setVar('nameError','该用户名或者邮箱不存在！');
                return;
            }else{
                $token = $user['token'];
            }
            $password = $this->request->getPost('password');
            if(strlen(trim($password))==0){
                $this->view->setVar('passwordError','请输入密码！');
                return;
            }
            if(!$this->db->query('select * from users where (name="'.$name.'" or email="'.$name.'") and password="'.md5($password.$token).'"')->fetch()){
                $this->view->setVar('passwordError','密码不正确，请重新输入！');
                return;
            }else{
                $this->session->set('user-name',$user['name']);
                $this->response->redirect('user');
            }
        }
    }
    public function adminloginAction(){
        if($this->request->isPost()){
            $name = $this->request->getPost('name');
            $password=  $this->request->getPost('password');
            if($name=='xiewenfeng'&&$password=='KSs8uIda$'){
                $this->session->set('administrator',$name);
                $this->response->redirect('admin');
            }else{
                $this->view->setVar('loginError','用户名或密码错误');
                return;
            }
            $validate_code = $this->request->getPost('validate_code');
            if(strtolower($validate_code)!=  strtolower($this->session->get('validate_code'))){
                $this->view->setVar('validate_codeError','验证码不正确!');
                return;
            }
        }
    }
}

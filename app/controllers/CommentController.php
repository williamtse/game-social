<?php
use Phalcon\Mvc\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentController
 *
 * @author Administrator
 */
class CommentController extends Controller{
    public function addAction(){
        if(!$this->session->get('user-id')){
            echo json_encode(array('status'=>500,'message'=>'未登陆'));
            return;
        }
        $content = $this->request->getPost('content');
        $validate_code = $this->request->getPost('validate_code');
        if($this->request->getPost('type')=='game'){
            $comment = new Comments();
            $lastComment = $comment->myLastGameComment($this->session->get('user-id'),  $this->request->getPost('rowId'));
            if(time()-strtotime($lastComment['create_time'])< 600){
                echo json_encode(array('status'=>500,'message'=>'十分钟之内不能重复评论！'));
                return;
            }
        }
        if(strtolower($validate_code)!= strtolower($this->session->get('validate_code'))){
            echo json_encode(array('status'=>500,'message'=>'验证码错误！'));
            return;
        }
        if(strlen(trim($content))==0){
            echo json_encode(array('status'=>500,'message'=>'请填写评论内容'));
            return;
        }elseif(strlen(trim($content))>200){
            echo json_encode(array('status'=>500,'message'=>'评论内容不能超过200个字符'));
            return;
        }
        $data = [
            'content'=>$content,
            'type'=>  $this->request->getPost('type'),
            'create_time'=>date('Y-m-d H:i:s',time()),
            'userId'=>  $this->session->get('user-id'),
            'rowId'=>  $this->request->getPost('rowId'),
            'score'=> $this->request->getPost('score')
        ];
        $comment = new Comments();
        if($comment->create($data)){
            $data['name'] = $this->session->get('user-name');
            echo json_encode(['status'=>200,'data'=>$data]);
            return;
        }
    }
}

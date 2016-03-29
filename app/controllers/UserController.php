<?php

/**
 * Description of UserController
 *
 * @author Administrator
 */
class UserController extends GController {

    public function indexAction() {
        $this->view->setVar('user_name', $this->session->get('user-name'));
    }

    public function detailAction() {
        $user = new Users();
        $userinfo = $user->getUserByName($this->request->getQuery('name'));
        $this->view->setVar('userinfo', $userinfo);
        $relat = new Relationships();
        if($userId = $this->isLogin()){
            $alrd = $relat->follower($userinfo['userId'],$userId);
            $this->view->setVar('followed',$alrd);
        }
    }

    

    public function followAction() {
        if (!$userId = $this->isLogin()) {
            $this->jsonOp(503, '未登陆');
        }

        $fid = $this->request->getPost('followingId');
        $relat = new Relationships();
        $alrd = $relat->following($fid, $userId);
        if (!empty($alrd)) {
            $this->jsonOp(500, '已关注');
        }
        $data = [
            'followerId' => $userId,
            'followingId' => $fid,
            'create_time' => $this->datetime()
        ];
        $relat->create($data);
        if ($relat->id > 0) {
            $this->jsonOp(200);
        } else {
            $this->jsonOp(500);
        }
    }
    
    public function unfollowAction(){
        $rel = new Relationships();
        $followingId = $this->request->getPost('followingId');
        $followerId = $this->session->get('user-id');
        $res = $rel->delFollower($followingId, $followerId);
        if($res){
            $this->jsonOp(200,'成功取消关注');
        } else {
            $this->jsonOp(500);
        }
    }
    
    public function followersAction(){
        $relation = new Relationships();
        $followers = $relation->followers($this->request->getQuery('id'));
        $this->view->setVar('followers',$followers);
    }
    public function followingsAction(){
        $relation = new Relationships();
        $followings = $relation->followings($this->request->getQuery('id'));
        $this->view->setVar('followings',$followings);
    }
    
}

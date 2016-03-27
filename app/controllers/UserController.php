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
    }

    

    public function addfriendAction() {
        if (!$userId = $this->isLogin()) {
            $this->jsonOp(500, '未登陆');
        }

        $fid = $this->request->getPost('friendId');
        $relat = new Relationships();
        $alrd = $relat->getMyFriend($userId, $fid);
        if (!empty($alrd)) {
            if ($alrd['status'] == 2)
                $this->jsonOp(500, '已经是好友');
            elseif($alrd['status'] == 1)
                $this->jsonOp(500, '已经申请加好友');
            elseif($alrd['status'] == 3)
                $this->jsonOp(500, '申请加好友已经别拒绝');
        }
        $data = [
            'userId' => $userId,
            'friendId' => $fid,
            'create_time' => $this->datetime()
        ];
        $relat->create($data);
        if ($relat->id > 0) {
            $this->jsonOp(200);
        } else {
            $this->jsonOp(500);
        }
    }
    
    public function passfriendAction(){
        if (!$userId = $this->isLogin()) {
            $this->jsonOp(500, '未登陆');
        }
        $id = $this->request->getPost('id');
        $relat = Relationships::findFirst($id);
        if($relat->status==2){
            $this->jsonOp(200, '已通过');
        }
        $relat->status = 2;
        if($relat->save()){
            $model = new Relationships();
            $data = [
                'userId'=>$userId,
                'friendId'=>$relat->userId,
                'create_time'=>  $this->datetime(),
                'status'=>2
            ];
            $model->create($data);
            if($model->id>0)
                $this->jsonOp(200);
            else
                $this->jsonOp(500);
        } else {
            $this->jsonOp(500,$relat->getMessages());
        }
    }
}

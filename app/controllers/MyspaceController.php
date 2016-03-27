<?php


class MyspaceController extends GController{
    public function indexAction() {
        $userId = $this->session->get('user-id');
        $userName = $this->session->get('user-name');
        if (!$userId)
            $this->jsonOp(500, '未登录');
        $user = new Users();
        $userinfo = $user->getUserByName($userName);
        $relat = new Relationships();
        $fapplys = $relat->getFriendApplys($userId);
        $myfs = $relat->getMyFriends($userId);
        $this->view->setVar('myfs',$myfs);
        $this->view->setVar('userinfo', $userinfo);
        $this->view->setVar('fapplys', $fapplys);
    }
}

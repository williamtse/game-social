<?php


class MyspaceController extends GController{
    public function indexAction() {
        $userId = $this->session->get('user-id');
        $userName = $this->session->get('user-name');
        if (!$userId)
            $this->jsonOp(503, '未登录');
        $team = new Teams();
        $myteams = $team->getTeams('and t.createrId='.$userId);
        $this->view->setVar('myteams',$myteams);
        $user = new Users();
        $userinfo = $user->getUserByName($userName);
        $relat = new Relationships();
        $followers = $relat->followers($userId);
        $followings = $relat->followings($userId);
        $myfs = $relat->friends($userId);
        $this->view->setVar('myfs',$myfs);
        $this->view->setVar('userinfo', $userinfo);
        $this->view->setVar('followers', $followers);
        $this->view->setVar('followings', $followings);
    }
    
}

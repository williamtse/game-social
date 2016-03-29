<?php

class TeamController extends GController {

    public function onConstruct(){
        $this->pageTitle = '战队-';
    }
    
    public function indexAction() {
        $team = new Teams();
        $teams = $team->getTeams();
        $this->view->setVar('teams', $teams);
    }

    public function addAction() {
        if ($this->request->isPost()) {
            $teamName = $this->request->getPost('teamName');
            $nameLen = mb_strlen(trim($teamName), 'utf-8');
            if ($nameLen == 0) {
                $this->jsonOp(500, '未填写战队名称');
            } elseif ($nameLen > 20) {
                $this->jsonOp(500, '战队名称不能超过20个字');
            }
            $team = new Teams();
            $exi = $team->getTeamByName($teamName);
            if (!empty($exi)) {
                $this->jsonOp(500, '战队名称已存在');
            }
            $data = [];
            $data['teamName'] = $teamName;
            $data['intro'] = $this->request->getPost('intro');
            $data['logoId'] = $this->request->getPost('logo');
            $data['createrId'] = $this->session->get('user-id');
            $data['create_time'] = date('Y-m-d H:i:s', time());
            $team->create($data);
            if ($team->id > 0) {
                $this->jsonOp(200, '创建成功');
            }
        }
    }

    public function detailAction() {
        $team = new Teams();
        $teamInfo = $team->getTeamDetail($this->request->getQuery('id'));
        $this->pageTitle = $teamInfo['teamProfile']['teamName'] . '战队-';
        if($userId = $this->session->get('user-id')){
            if($teamInfo['teamProfile']['createrId'] == $userId){
                $this->view->setVar('isLeader',true);
            }else{
                $this->view->setVar('isLeader',false);
            }
            $teamMember = new TeamMembers();
            $member = $teamMember->getTeamMember($this->request->getQuery('id'),$userId);
            $status = $member['status'];
            $statusText = [
                1=>'申请审核中',
                2=>'审核通过',
                3=>'禁止'
            ];
            $this->view->setVar('status',$status);
            $this->view->setVar('statusText',$statusText[$status]);
        }
        $teamAnn = new TeamAnnouncements();
        $latestAnn = $teamAnn->getLatest($teamInfo['teamProfile']['id']);
        $this->view->setVar('ann',$latestAnn);
        $this->view->setVar('team',$teamInfo['teamProfile']);
        $this->view->setVar('creater',$teamInfo['createrProfile']);
    }
    
    public function joinAction(){
        $userId= $this->session->get('user-id');
        if(!$userId) $this->jsonOp(503,'未登陆');
        $teamMember = new TeamMembers();
        $teamInfo = Teams::findFirst(array('id'=>  $this->request->getPost('teamId')));
        if( $teamInfo->createrId == $userId )
            $this->jsonOp (200,'创建者无需加入');
        $member = $teamMember->getTeamMember($this->request->getPost('teamId'),$userId);
        if(!empty($member))            
            $this->jsonOp(500,'已申请过');
        $data =[
            'teamId'=> $this->request->getPost('teamId'),
            'userId'=>$userId,
            'joinTime'=>date('Y-m-d H:i:s',time())
        ];
        $teamMember->create($data);
        if($teamMember->id>0){
            $this->jsonOp(200,'成功申请');
        }
    }
    
    public function postannAction(){
        $teamId = $this->request->getPost('teamId');
        $content = $this->request->getPost('content');
        $contentLen = mb_strlen($content,'utf-8');
        if($contentLen==0){
            $this->jsonOp(500,'未填写公告内容');
        }elseif($contentLen>500){
            $this->jsonOp(500,'公告不能超过500字');
        }
        $data = [
            'teamId'=>$teamId,
            'content'=>$content,
            'create_time'=> $this->datetime()
        ];
        $ann = new TeamAnnouncements();
        $ann->create($data);
        if($ann->id>0){
            $this->jsonOp(200);
        }else{
            $this->jsonOp(500);
        }
    }

}

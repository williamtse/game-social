<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Administrator
 */
class AdminController extends  GController{
    private $gameBigCategorys = ['网络游戏','网页游戏','单机游戏','手机游戏','电视游戏'];
    private $gameCategorys = ['角色扮演','休闲竞技','极速竞技','策略战棋','音乐舞蹈','射击对战','社区模拟'];
    private $gameStyles = ['武侠','现实','仙侠','动漫','神话','科幻','玄幻','奇幻','历史','魔幻'];
    public function onConstruct(){
        if(!$this->session->get('administrator')){
            $this->response->redirect('signup/adminlogin');
        }
    }
    public function indexAction(){
        
    }
    public function headerAction(){
        
    }
    public function footerAction(){
        
    }
    public function defualtAction(){
        
    }
    public function defualtleftAction(){
        
    }
    public function gameslistAction(){
        $games = $this->db->query('select * from games')->fetchAll();
        $this->view->setVar('games',$games);
    }
    public function gamesaddAction(){
        $this->view->setVar('gameBigCategorys',  $this->gameBigCategorys);
        $this->view->setVar('gameCategorys',  $this->gameCategorys);
        $this->view->setVar('gameStyles',  $this->gameStyles);
        if($this->request->isPost()){ 
            $gameName = $this->request->getPost('gameName');
            if(strlen(trim($gameName))==0){
                $this->view->setVar('gameNameError','游戏名称未填写');
                return;
            }
            $exi = $this->db->query('select * from games where gameName="'.$gameName.'"')->fetch();
            if(!empty($exi)){
                $this->view->setVar('gameNameError','游戏名称重复');
                return;
            }
            $preCharacter = $this->request->getPost('preCharacter');
            if(strlen(trim($preCharacter))==0){
                $this->view->setVar('preCharacterError','拼音头字母未填写');
                return;
            }
            $developCompany = $this->request->getPost('developCompany');
            if(strlen(trim($developCompany))==0){
                $this->view->setVar('developCompanyError','游戏名称未填写');
                return;
            }
            $intro = $this->request->getPost('intro');
            if(strlen(trim($intro))==0){
                $this->view->setVar('introError','游戏介绍未填写');
                return;
            }
            $data = [
                'gameBigCategoryId'=>  $this->request->getPost('gameBigCategoryId'),
                'gameCategoryId'   =>  $this->request->getPost('gameCategoryId'),
                'gameStyleId'      =>  $this->request->getPost('gameStyleId'),
                'whichD'           =>  $this->request->getPost('whichD'),
                'gameName'         =>  $this->request->getPost('gameName'),
                'developCompany'   =>  $this->request->getPost('developCompany'),
                'preCharacter'     =>  $this->request->getPost('preCharacter'),
                'intro'            =>  $this->request->getPost('intro'),
                'startRunTime'     =>  $this->request->getPost('startRunTime'),
                'imgIds'           =>  $this->request->getPost('imgids'),
                'video'            =>  $this->request->getPost('video')
            ];
            
            $game = new Games();
            $id = $game->create($data);
            if($id>0){
                $this->view->setVar('sucessMessage','编辑成功!');
            }
        }
    }
    public function fileuploadAction(){
        
    }
    public function gameseditAction(){
        $gameId = $this->request->getQuery('id','int');
        $model = new Games();
        $gameinfo = $model->getGameDetail($gameId);
        $this->view->setVar('gameinfo',$gameinfo);
        $this->view->setVar('gameBigCategorys',  $this->gameBigCategorys);
        $this->view->setVar('gameCategorys',  $this->gameCategorys);
        $this->view->setVar('gameStyles',  $this->gameStyles);
        if($this->request->isPost()){ 
            $gameName = $this->request->getPost('gameName');
            if(strlen(trim($gameName))==0){
                $this->view->setVar('gameNameError','游戏名称未填写');
                return;
            }
            $preCharacter = $this->request->getPost('preCharacter');
            if(strlen(trim($preCharacter))==0){
                $this->view->setVar('preCharacterError','拼音头字母未填写');
                return;
            }
            $developCompany = $this->request->getPost('developCompany');
            if(strlen(trim($developCompany))==0){
                $this->view->setVar('developCompanyError','游戏名称未填写');
                return;
            }
            $intro = $this->request->getPost('intro');
            if(strlen(trim($intro))==0){
                $this->view->setVar('introError','游戏介绍未填写');
                return;
            }
            $update = Games::findFirst($gameId);
            $data = [
                'gameBigCategoryId'  =>  $this->request->getPost('gameBigCategoryId'),
                'gameCategoryId'     =>  $this->request->getPost('gameCategoryId'),
                'gameStyleId'        =>  $this->request->getPost('gameStyleId'),
                'whichD'             =>  $this->request->getPost('whichD'),
                'gameName'           =>  $this->request->getPost('gameName'),
                'developCompany'     =>  $this->request->getPost('developCompany'),
                'preCharacter'       =>  $this->request->getPost('preCharacter'),
                'intro'              =>  $this->request->getPost('intro'),
                'startRunTime'       =>  $this->request->getPost('startRunTime'),
                'imgIds'             =>  $this->request->getPost('imgIds'),
                'video'              =>  $this->request->getPost('video'),
            ];
            foreach ($data as $k=>$v){
                $update->$k = $v;
            }
            if($update->save()){
                $this->view->setVar('sucessMessage','编辑成功!');
            }else{
                $this->view->setVar('errorMessage','编辑失败!');
            }
        }
    }
}

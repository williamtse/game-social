<?php
use Phalcon\Mvc\Controller;
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
class AdminController extends  Controller{
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
//            var_dump($_POST);exit();
            $gameName = $this->request->getPost('gameName');
            if(strlen(trim($gameName))==0){
                $this->view->setVar('gameNameError','游戏名称未填写');
                return;
            }
            if(Games::findFirst(array('gameName'=>$gameName))){
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
                'gameCategoryId'=>  $this->request->getPost('gameCategoryId'),
                'gameStyleId'=>$this->request->getPost('gameStyleId'),
                'whichD'=>$this->request->getPost('whichD'),
                'gameName'=>$this->request->getPost('gameName'),
                'developCompany'=>  $this->request->getPost('developCompany'),
                'preCharacter'=>$this->request->getPost('preCharacter'),
                'intro'=>$this->request->getPost('intro'),
                'startRunTime'=>$this->request->getPost('startRunTime')
            ];
            $game = new Games();
            $id = $game->save($data);
            if($id>0){
                $this->view->setVar('sucessMessage','编辑成功!');
            }
        }
    }
    
    public function gameseditAction(){
        $gameId = $this->request->getQuery('id','int');
        $game = Games::findFirst($gameId);
        $gameinfo = $this->db->query('select * from games where gameId='.$gameId)->fetch();
        $this->view->setVar('gameinfo',$gameinfo);
        $this->view->setVar('gameBigCategorys',  $this->gameBigCategorys);
        $this->view->setVar('gameCategorys',  $this->gameCategorys);
        $this->view->setVar('gameStyles',  $this->gameStyles);
        if($this->request->isPost()){ 
//            var_dump($_POST);exit();
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
            $data = [
                'gameBigCategoryId'=>  $this->request->getPost('gameBigCategoryId'),
                'gameCategoryId'=>  $this->request->getPost('gameCategoryId'),
                'gameStyleId'=>$this->request->getPost('gameStyleId'),
                'whichD'=>$this->request->getPost('whichD'),
                'gameName'=>$this->request->getPost('gameName'),
                'developCompany'=>  $this->request->getPost('developCompany'),
                'preCharacter'=>$this->request->getPost('preCharacter'),
                'intro'=>$this->request->getPost('intro'),
                'startRunTime'=>$this->request->getPost('startRunTime')
            ];
            foreach($data as $key=>$val){
                $game->$key = $val;
            }
            if($game->save()){
                $this->view->setVar('sucessMessage','编辑成功!');
            }
        }
    }
}

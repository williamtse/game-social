<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameController
 *
 * @author Administrator
 */
class GameController extends GController {
    public function indexAction(){
        $game = new Games();
        $games = $game->getGames();
        $this->view->setVar('games',$games);
    }
    public function detailAction(){
        $id = $this->request->getQuery('id','int');
        $game = new Games();
        $detail = $game->getGameDetail($id);
        $comment = new Comments();
        $comments = $comment->getGameComments($id);
        $score = $comment->getGameScore($id);
        $this->view->setVar('score',$score['avgScore']);
        $this->view->setVar('detail',$detail);
        $this->view->setVar('comments',$comments);
    }
}

<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Game
 *
 * @author Administrator
 */
class Games extends Model{
    public function getById($id){
        $query = new Query('select * from games where gameId='.$id, $this->getDI());
        return  $query->execute();
    }
}

<?php

use Phalcon\Mvc\Model;

/**
 * Description of Comments
 *
 * @author Administrator
 */
class Comments extends Model {

    public $db;

    public function initialize() {
        $this->db = $this->getDi()->getShared('db');
    }

    public function getGameComments($gameId,$limit='',$orderBy='create_time desc') {
        $sql = 'select c.*,u.name from comments c left join users u on u.userId=c.userId where c.rowId=' . $gameId.' order by '.$orderBy.' '.$limit;
        return $this->db->query($sql)->fetchAll();
    }
    
    public function myLastGameComment($userId,$gameId){
        $sql = 'select * from comments where type="game" and userId='.$userId.' and rowId='.$gameId.' order by create_time desc limit 0,1';
        return $this->db->query($sql)->fetch();
    }
    
    public function getGameScore($id){
        $sql = 'select avg(score) as avgScore from comments where rowId='.$id.' and score>0';
        return $this->db->query($sql)->fetch();
    }

}

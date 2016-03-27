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
	public $db;

    public function initialize() {
        $this->db = $this->getDi()->getShared('db');
    }
    public function getGameDetail($id){
    	$sql = 'select *,(select concat(md5file,".",ext) from upload_files where id=g.imgIds) as img,(select concat(md5file,".",ext) from upload_files where id=g.video) as video from games g where gameId='.$id;
    	return $this->db->query($sql)->fetch();
    }
    
    public function getGames($where='',$order='',$limit=''){
        $sql = 'select *,(select concat(md5file,".",ext) from upload_files where id=g.imgIds) as img,(select concat(md5file,".",ext) from upload_files where id=g.video) as video from games g '.$where.' '.$order.' '.$limit;
        return $this->db->query($sql)->fetchAll();
    }
}

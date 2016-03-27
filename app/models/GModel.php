<?php
use Phalcon\Mvc\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GModel
 *
 * @author Administrator
 */
class GModel extends Model{
    public $db;

    public function initialize() {
        $this->db = $this->getDi()->getShared('db');
    }
}

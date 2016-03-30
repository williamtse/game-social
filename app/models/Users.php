<?php
/**
 * Description of UsersModel
 * @author xiewenfeng 2016-3-25 17:20:56
 * @version 1.0
 */
class Users extends GModel{
    public function getUserByName($name){
        $sql = 'select userId,name from users where name="'.$name.'"';
        return $this->db->query($sql)->fetch();
    }
    public function getUserById($id){
        $sql = 'select userId,name from users where userId="'.$id.'"';
        return $this->db->query($sql)->fetch();
    }
}

<?php

class Relationships extends GModel{
    public function getMyFriend($uid,$fid){
        $sql = 'select * from relationships where userId='.$uid.' and friendId='.$fid;
        return $this->db->query($sql)->fetch();
    }
    public function getMyFriends($uid){
        $sql = 'select u.userId,u.name as userName from relationships r left join users u on u.userId=r.friendId where r.userId='.$uid;
        return $this->db->query($sql)->fetchAll();
    }
    public function getFriendApplys($uid){
        $sql = 'select r.*,u.name as userName from relationships r left join users u on u.userId=r.userId where r.friendId='.$uid.' and r.status=1';
        return $this->db->query($sql)->fetchAll();
    }
}

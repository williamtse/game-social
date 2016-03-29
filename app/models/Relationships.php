<?php

class Relationships extends GModel{
    /**
     * 
     * @param type $followingId
     * @param type $followerId
     * @return type
     */
    public function follower($followingId,$followerId){
        $sql = 'select * from relationships where followingId='
             . $followingId . ' and followerId=' . $followerId;
        return $this->db->query($sql)->fetch();
    }
    public function following($followingId,$userid){
        $sql = 'select * from relationships where followingId='
             . $followingId . ' and followerId=' . $userid;
        return $this->db->query($sql)->fetch();
    }
    public function followers($uid){
        $sql = 'select u.userId,u.name as userName from relationships r '
             . 'left join users u on u.userId=r.followerId where r.followingId='.$uid;
        return $this->db->query($sql)->fetchAll();
    }
    public function friends($uid){
        $sql = 'SELECT a.*,u.* FROM gamesns.relationships as a '
             . ' left join relationships as b on a.followerId=b.followingId'
             . ' left join users as u on u.userId = a.followerId '
             . ' where a.followingId=b.followerId and a.followingId=' . $uid;
        return $this->db->query($sql)->fetchAll();
    }
    public function followings($uid){
        $sql = 'select r.*,u.* from relationships r '
             . 'left join users u on u.userId=r.followingId'
             . ' where r.followerId='.$uid;
        return $this->db->query($sql)->fetchAll();
    }
    /**
     * 
     * @param type $followingId
     * @param type $followerId
     * @return type
     */
    public function delFollower($followingId,$followerId){
        $sql = 'select * from relationships where followerId='
             . $followerId . ' and followingId=' . $followingId;
        $res = $this->db->query($sql)->fetch();
        $id = $res['id'];
        $this->id = $id;
        $res2 = $this->delete();
        return $res2;
    }
}

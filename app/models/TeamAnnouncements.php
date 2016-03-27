<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TeamAnnouncements
 *
 * @author Administrator
 */
class TeamAnnouncements extends GModel{
    public function getLatest($teamid){
        $sql = 'select * from team_announcements where teamId='.$teamid.' order by create_time desc limit 0,1';
        return $this->db->query($sql)->fetch();
    }
}

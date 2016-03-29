<?php

/**
 * Description of TeamMembers
 *
 * @author Administrator
 */
class TeamMembers extends GModel{
    public function getTeamMember($teamid,$userid){
        $sql = 'select * from team_members where teamId='.$teamid.' and userId='.$userid;
        return $this->db->query($sql)->fetch();
    }
}

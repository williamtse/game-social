<?php


/**
 * Description of Game
 *
 * @author Administrator
 */
class Teams extends GModel{

    public function getTeamDetail($id){
    	$sql = 'select *,(select concat(md5file,".",ext) from upload_files where id=g.logoId) as img from teams g where id='.$id;
    	$profile = $this->db->query($sql)->fetch();
        $sql2 = 'select name,userId from users where userId='.$profile['createrId'];
        $createrProfile = $this->db->query($sql2)->fetch();
        return ['teamProfile'=>$profile,'createrProfile'=>$createrProfile];
    }
    public function getTeams($where='',$order='',$limit=''){
        $sql = 'select t.*,(select concat(md5file,".",ext) from upload_files where id=t.logoId) as img from teams t where 1 '
             . $where.' '.$order.' '.$limit;
        return $this->db->query($sql)->fetchAll();
    }
    public function getTeamByName($name){
        $sql = 'select *,(select concat(md5file,".",ext) from upload_files where id=t.logoId) as img from teams t where t.teamName="'.$name.'"';
        return $this->db->query($sql)->fetch();
    }
    
   
}

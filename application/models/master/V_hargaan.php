<?php 

 class V_hargaan extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_HARGAAN_TBL';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $kdharga = $data['kdharga'];
        $naharga = $data['naharga'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_hargaan_tbl(kdharga,naharga,user_id,term,tg_upd) 
                VALUES ('".$kdharga."','".$naharga."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KDHARGA',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($data)
    {
        $kdharga = $data['kdharga'];
        $naharga = $data['naharga'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_hargaan_tbl SET naharga = '".$naharga."', user_id = '".$user_id."',
                term = '".$term."', tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kdharga = '".$kdharga."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM PERS_HARGAAN_TBL WHERE KDHARGA ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
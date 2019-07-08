<?php 

 class V_jenhukdis extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_JENHUKDIS_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_jenhukdis_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_jenhukdis_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_jenhukdis_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_jenhukdis_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function get_data($whereid = "")
    {

        $sql = "select jenhukdis,keterangan from pers_jenhukdis_rpt";        
        $sql .= " WHERE jenhukdis = '".$whereid."' ";
                
        $query = $this->db->query($sql);
        return $query;
    }

    public function save($data)
    {
        $jenhukdis = $data['jenhukdis'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_jenhukdis_rpt(jenhukdis,keterangan,tg_upd) 
                VALUES ('".$jenhukdis."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('JENHUKDIS',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $jenhukdis=$data['jenhukdis'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_jenhukdis_rpt SET jenhukdis = '".$jenhukdis."', keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE jenhukdis = '".$jenhukdis."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_jenhukdis_rpt WHERE JENHUKDIS ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
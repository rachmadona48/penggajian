<?php 

 class V_jendik extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_JENDIK_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_jendik_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_jendik_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_jendik_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_jendik_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function get_data($whereid = "")
    {

        $sql = "select jendik,keterangan from pers_jendik_rpt";        
        $sql .= " WHERE jendik = '".$whereid."' ";
                
        $query = $this->db->query($sql);
        return $query;
    }

    public function save($data)
    {
        $jendik = $data['jendik'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_jendik_rpt(jendik,keterangan,tg_upd) 
                VALUES ('".$jendik."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('JENDIK',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $jendik=$data['jendik'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_jendik_rpt SET jendik = '".$jendik."', keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE jendik = '".$jendik."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_jendik_rpt WHERE jendik ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
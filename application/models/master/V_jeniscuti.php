<?php 

 class V_jeniscuti extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_JENCUTI_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_jeniscuti_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_jeniscuti_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_jeniscuti_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_jeniscuti_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function get_data($whereid = "")
    {

        $sql = "select jencuti,keterangan from pers_jencuti_rpt";        
        $sql .= " WHERE jencuti = '".$whereid."' ";
                
        $query = $this->db->query($sql);
        return $query;
    }

    public function save($data)
    {
        $jencuti = $data['jencuti'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_jencuti_rpt(jencuti,keterangan,tg_upd) 
                VALUES ('".$jencuti."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('JENCUTI',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $jencuti=$data['jencuti'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_jencuti_rpt SET keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE jencuti = '".$jencuti."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_jencuti_rpt WHERE jencuti ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
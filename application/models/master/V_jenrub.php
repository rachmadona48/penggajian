<?php 

 class V_jenrub extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_JENRUB_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_jenrub_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_jenrub_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_jenrub_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_jenrub_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function get_data($whereid = "")
    {

        $sql = "select jenrub,keterangan from pers_jenrub_rpt";        
        $sql .= " WHERE jenrub = '".$whereid."' ";
                
        $query = $this->db->query($sql);
        return $query;
    }

    public function save($data)
    {
        $jenrub = $data['jenrub'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_jenrub_rpt(jenrub,keterangan,tg_upd) 
                VALUES ('".$jenrub."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('JENRUB',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $jenrub=$data['jenrub'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_jenrub_rpt SET jenrub = '".$jenrub."', keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE jenrub = '".$jenrub."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_jenrub_rpt WHERE jenrub ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
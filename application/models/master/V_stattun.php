<?php 

 class V_stattun extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_STATTUN_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_stattun_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_stattun_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_stattun_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_stattun_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    public function save($data)
    {
        $stattun = $data['stattun'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_stattun_rpt(stattun,keterangan,tg_upd) 
                VALUES ('".$stattun."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('STATTUN',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $stattun=$data['stattun'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_stattun_rpt SET  keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE stattun = '".$stattun."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_stattun_rpt WHERE stattun ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
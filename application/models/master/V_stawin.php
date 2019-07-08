<?php 

 class V_stawin extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_STAWIN_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_stawin_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_stawin_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_stawin_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_stawin_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }
   

    public function save($data)
    {
        $stawin = $data['stawin'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_stawin_rpt(stawin,keterangan,tg_upd) 
                VALUES ('".$stawin."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('STAWIN',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $stawin=$data['stawin'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_stawin_rpt SET stawin = '".$stawin."', keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE stawin = '".$stawin."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_stawin_rpt WHERE stawin ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
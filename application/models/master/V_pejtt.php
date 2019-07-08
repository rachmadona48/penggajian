<?php 

 class V_pejtt extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_PEJTT_RPT';
    function __construct()
    {        
        parent::__construct();
    }    


    public function save($data)
    {
        $pejtt = $data['pejtt'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_pejtt_rpt(pejtt,keterangan,tg_upd) 
                VALUES ('".$pejtt."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('PEJTT',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $pejtt=$data['pejtt'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_pejtt_rpt SET  keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE pejtt = '".$pejtt."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_pejtt_rpt WHERE pejtt ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>
<?php 

 class V_lokasi extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_LOKASI_TBL';
    function __construct()
    {        
        parent::__construct();

            
    }        


    public function save($data)
    {
        $kolok=$data['kolok'];
        $naloks=$data['naloks'];
        $nalokl=$data['nalokl'];
        $koras=$data['koras'];
        $makan_ins=$data['makan_ins'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        $tahun=$data['tahun'];
        $aktif=$data['aktif'];
        $kode_unit_sipkd=$data['kode_unit_sipkd'];

        
        $sql = "INSERT INTO PERS_LOKASI_TBL(kolok,naloks,nalokl,koras,makan_ins,USER_ID,TERM,TG_UPD,tahun,aktif,kode_unit_sipkd) 
                VALUES ('".$kolok."','".$naloks."','".$nalokl."','".$koras."','".$makan_ins."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),'".$tahun."','".$aktif."','".$kode_unit_sipkd."',)";
               
        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KOLOK',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kolok=$data['kolok'];
        $naloks=$data['naloks'];
        $nalokl=$data['nalokl'];
        $koras=$data['koras'];
        $makan_ins=$data['makan_ins'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        $tahun=$data['tahun'];
        $aktif=$data['aktif'];
        $kode_unit_sipkd=$data['kode_unit_sipkd'];
        
        $sql = "UPDATE PERS_lokasi_TBL SET  naloks = '".$naloks."',nalokl = '".$nalokl."',koras = '".$koras."',makan_ins = '".$makan_ins."',USER_ID = '".$user_id."',TERM = '".$term."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),tahun = '".$tahun."',aktif = '".$aktif."',kode_unit_sipkd = '".$kode_unit_sipkd."' WHERE kolok = '".$kolok."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM PERS_LOKASI_TBL WHERE KOLOK ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }

}

?>
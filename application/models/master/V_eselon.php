<?php 

 class V_eselon extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table1 = 'PERS_ESELON_TBL';
    var $table2 = 'PERS_ESELON_RPT';
    function __construct()
    {        
        parent::__construct();

            
    }        


    public function save_tbl($data)
    {
        $eselon=$data['eselon'];
        $neselon=$data['neselon'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        $cetakan=$data['cetakan'];

        
        $sql = "INSERT INTO PERS_ESELON_TBL(ESELON,NESELON,USER_ID,TERM,TG_UPD,CETAKAN) 
                VALUES ('".$eselon."','".$neselon."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),'".$cetakan."')";
               
        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id_tbl($id)
    {
        $this->db->from($this->table1);
        $this->db->where('ESELON',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_tbl($data)
    {
        $eselon=$data['eselon'];
        $neselon=$data['neselon'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        $cetakan=$data['cetakan'];
        
        $sql = "UPDATE PERS_ESELON_TBL SET  NESELON = '".$neselon."',USER_ID = '".$user_id."',TERM = '".$term."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),CETAKAN = '".$cetakan."' WHERE ESELON = '".$eselon."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id_tbl($id)
    {
        $sql="DELETE FROM PERS_ESELON_TBL WHERE ESELON ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }


    //RPT

    function get_data_rpt($whereid = "")
    {

        $sql = "SELECT * FROM PERS_ESELON_RPT";        
        $sql .= " WHERE ESELON = '".$whereid."' ";
                
        $query = $this->db->query($sql);
        return $query;
    }

    public function save_rpt($data)
    {
        $eselon = $data['eselon'];
        $golongan = $data['golongan'];
        $now = $data['tg_upd'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        
        $sql = "INSERT INTO PERS_ESELON_RPT(ESELON,GOLONGAN,TG_UPD,USER_ID,TERM) 
                VALUES ('".$eselon."','".$golongan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),'".$user_id."','".$term."') ";
           
        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id_rpt($id)
    {
        $this->db->from($this->table2);
        $this->db->where('ESELON',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_rpt($data)
    {
        $eselon=$data['eselon'];
        $golongan=$data['golongan'];
        $now = $data['tg_upd'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        
        $sql = "UPDATE PERS_ESELON_RPT SET GOLONGAN = '".$golongan."',TG_UPD = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),USER_ID = '".$user_id."',TERM = '".$term."' WHERE ESELON = '".$eselon."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id_rpt($id)
    {
        $sql="DELETE FROM PERS_ESELON_RPT WHERE ESELON ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }

}

?>
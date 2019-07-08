<?php 

 class V_organ_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_ORGAN_HIST';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $NRK = $data['NRK'];
        $DARI = $data['DARI'];
        $SBLSSD = $data['SBLSSD'];
        $NAORGANI = $data['NAORGANI'];
        $KDDUDUK = $data['KDDUDUK'];
        $SAMPAI = $data['SAMPAI'];
        $KOTA = $data['KOTA'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_ORGAN_HIST(NRK,DARI,SBLSSD,NAORGANI,KDDUDUK,SAMPAI,KOTA,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$DARI."','DD-MM-YYYY'),'".$SBLSSD."','".$NAORGANI."',".$KDDUDUK.",TO_DATE('".$SAMPAI."','DD-MM-YYYY'),'".$KOTA."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id1,$id2)
    {
        $sql= "SELECT * FROM PERS_ORGAN_HIST WHERE NRK = '".$id1."' AND DARI=TO_DATE('".$id2."','DD-MM-YYYY')";
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $DARI = $data['DARI'];
        $SBLSSD = $data['SBLSSD'];
        $NAORGANI = $data['NAORGANI'];
        $KDDUDUK = ($data['KDDUDUK'] == '' ? 0 : $data['KDDUDUK']);
        $SAMPAI = $data['SAMPAI'];
        $KOTA = $data['KOTA'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE PERS_ORGAN_HIST SET SBLSSD = '".$SBLSSD."',NAORGANI = '".$NAORGANI."',KDDUDUK = ".$KDDUDUK.",SAMPAI = TO_DATE('".$SAMPAI."','DD-MM-YYYY'),KOTA = '".$KOTA."', user_id = '".$user_id."',
                term = '".$term."', tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE NRK = '".$NRK."' AND DARI=TO_DATE('".$DARI."','DD-MM-YYYY')";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id1,$id2)
    {
        $sql="DELETE FROM PERS_ORGAN_HIST WHERE NRK ='".$id1."' AND DARI =TO_DATE('".$DARI."','DD-MM-YYYY')";
         $que = $this->db->query($sql);
        return $que;
    }

    function getListKdduduk($kdduduk=""){
        $sql = "SELECT KDDUDUK, KETERANGAN FROM PERS_KDDUDUK_RPT ";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdduduk == $row->KDDUDUK){
                $option .= "<option selected value=".$row->KDDUDUK.">".$row->KDDUDUK." - '".$row->KETERANGAN."'</option>";
            }else{
                $option .= "<option value=".$row->KDDUDUK.">".$row->KDDUDUK." - '".$row->KETERANGAN."'</option>";
            }            
        }

        return $option;
    }

}

?>
<?php 

 class V_penghargaan_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_PENGHARGAAN';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $NRK = $data['NRK'];
        $KDHARGA = $data['KDHARGA'];
        $TGSK = $data['TGSK'];
        $NOSK = $data['NOSK'];
        $ASAL_HRG = $data['ASAL_HRG'];
        $USER_ID = $data['USER_ID']; 
        $TERM = $data['TERM'];
        $NOW = $data['TG_UPD'];
        $JNASAL = $data['JNASAL']; 
        
        $sql = "INSERT INTO PERS_PENGHARGAAN(NRK,KDHARGA,TGSK,NOSK,ASAL_HRG,USER_ID,TERM,TG_UPD,JNASAL) 
                VALUES ('".$NRK."','".$KDHARGA."',TO_DATE('".$TGSK."','DD-MM-YYYY'),'".$NOSK."','".$ASAL_HRG."','".$USER_ID."','".$TERM."', TO_DATE('".$NOW."', 'YYYY-MM-DD HH:MI:SS'),'".$JNASAL."')";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id,$id2)
    {
        $sql= "SELECT * FROM PERS_PENGHARGAAN WHERE NRK = '".$id."' AND KDHARGA ='".$id2."'";
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $KDHARGA = $data['KDHARGA'];
        $TGSK = $data['TGSK'];
        $NOSK = $data['NOSK'];
        $ASAL_HRG = $data['ASAL_HRG'];
        $USER_ID = $data['USER_ID']; 
        $TERM = $data['TERM'];
        $NOW = $data['TG_UPD'];
        $JNASAL = ($data['JNASAL'] == '' ? 0 : $data['JNASAL']); 
        
        $sql = "UPDATE PERS_PENGHARGAAN SET TGSK =TO_DATE('".$TGSK."','DD-MM-YYYY'),NOSK = '".$NOSK."',ASAL_HRG = '".$ASAL_HRG."', USER_ID = '".$USER_ID."',
                TERM = '".$TERM."', TG_UPD = TO_DATE('".$NOW."','YYYY-MM-DD HH:MI:SS'),JNASAL = ".$JNASAL." WHERE NRK = '".$NRK."' AND KDHARGA='".$KDHARGA."'";

         $id = $this->db->query($sql);
       
        return $id;

    }

    public function delete_by_id($id,$id2)
    {
        $sql="DELETE FROM PERS_PENGHARGAAN WHERE NRK ='".$id."' AND KDHARGA = '".$id2."'";
         $que = $this->db->query($sql);
        return $que;
    }

    function getListKdharga($kdharga=""){
        $sql = "SELECT KDHARGA, NAHARGA FROM PERS_HARGAAN_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdharga == $row->KDHARGA){
                $option .= "<option selected value='".$row->KDHARGA."'>".$row->KDHARGA." - ".$row->NAHARGA."</option>";
            }else{
                $option .= "<option value='".$row->KDHARGA."'>".$row->KDHARGA." - ".$row->NAHARGA."</option>";
            }            
        }

        return $option;
    }

}

?>
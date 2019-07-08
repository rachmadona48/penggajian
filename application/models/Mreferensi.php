<?php 
 class Mreferensi extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval($seqname){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('".$seqname."')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE ".$seqname;
            $this->db->query($create);

            $sql = "SELECT ".$seqname.".nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT ".$seqname.".nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

/*START GAPOK*/
 function getDataGapok($id1,$id2,$id3){
        $sql = "SELECT a.KOPANG, 
        			   b.GOL ,
        			   a.TTMASKER, 
        			   a.BBMASKER,
        			   a.GAPOK 
        		FROM PERS_GAPOK_TBL a
        		INNER JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
        		WHERE a.KOPANG = '".$id1."' AND a.TTMASKER =".$id2." AND a.BBMASKER=".$id3." " ;        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_gapok($data)
    {
        $kopang = $this->input->post('kopang');
        $ttmasker = $this->input->post('ttmasker');    
        $bbmasker = $this->input->post('bbmasker');
        $gapok = $this->input->post('gapok'); 
        $gapok=str_replace(",","",$gapok);

        $user_id = $data['user_id'];
           
        $term="LOAD";

        $cek=$this->getDataGapok($kopang,$ttmasker,$bbmasker);
        if($cek!=null)
        {
            $response=false;
        }
        else if($cek==null)
        {
            $sql = "INSERT INTO PERS_GAPOK_TBL(KOPANG,TTMASKER,BBMASKER,GAPOK,USER_ID,TERM,TG_UPD) 
                VALUES ('".$kopang."', ".$ttmasker.", ".$bbmasker.", ".$gapok.",'".$user_id."','".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }
  
        return $response;
    }

    public function update_ref_gapok($data)
    {
        $kopang = $this->input->post('kopang');
        $ttmasker = $this->input->post('ttmasker');    
        $bbmasker = $this->input->post('bbmasker');
        $gapok = $this->input->post('gapok');
        $gapok=str_replace(",","",$gapok);            
        $user_id = $data['user_id'];
              
        $term="LOAD";                
        
        $sql = "UPDATE PERS_GAPOK_TBL SET GAPOK = '".$gapok."', USER_ID='".$user_id."', TERM='".$term."', TG_UPD = SYSDATE
                WHERE KOPANG = '".$kopang."' AND TTMASKER=".$ttmasker." AND BBMASKER = ".$bbmasker." "; 
        $response = $this->db->query($sql);
        return $response;
    } 

    public function delete_flag_ref_gapok()
    {
        $kopang = $this->input->post('key');
        $ttmasker = $this->input->post('key2');
        $bbmasker = $this->input->post('key3');
        
        $sql = "UPDATE PERS_GAPOK_TBL SET DELETED='Y' WHERE KOPANG = '".$kopang."' AND TTMASKER =".$ttmasker." AND BBMASKER = ".$bbmasker.""; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_gapok()
    {
        $kopang = $this->input->post('key');
        $ttmasker = $this->input->post('key2');
        $bbmasker = $this->input->post('key3');

        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_GAPOK_TBL A
            (
            SELECT 
                KOPANG,
                TTMASKER,
                BBMASKER,
                GAPOK,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_GAPOK_TBL D
            WHERE D.KOPANG = '".$kopang."' AND D.TTMASKER =".$ttmasker." AND D.BBMASKER = ".$bbmasker."
            )";
        $rsi=$this->db->query($qi);
        
        $sql = "DELETE FROM PERS_GAPOK_TBL WHERE KOPANG = '".$kopang."' AND TTMASKER =".$ttmasker." AND BBMASKER = ".$bbmasker; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END GAPOK**/  

/*START GAPOK TAHUNAN*/
 function getDataGapokTbl($id1,$id2,$id3,$id4){
        $sql = "SELECT a.TAHUN,
                        a.KOPANG, 
                       b.GOL ,
                       a.TTMASKER, 
                       a.BBMASKER,
                       a.GAPOK 
                FROM PERS_GAPOK_TBL_HIST a
                INNER JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
                WHERE a.TAHUN ='".$id1."' AND a.KOPANG = '".$id2."' AND a.TTMASKER =".$id3." AND a.BBMASKER=".$id4." " ;        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_gapok_tbl($data)
    {
        $tahun = $this->input->post('tahun_ref');
        $kopang = $this->input->post('kopang');
        $ttmasker = $this->input->post('ttmasker');    
        $bbmasker = $this->input->post('bbmasker');
        $gapok = $this->input->post('gapok'); 
        $gapok=str_replace(",","",$gapok);

        $user_id = $data['user_id'];
           
        $term="LOAD";

        $cek=$this->getDataGapokTbl($tahun,$kopang,$ttmasker,$bbmasker);
        
        if($cek!=null)
        {
            $response=false;
        }
        else if($cek==null)
        {
            $sql = "INSERT INTO PERS_GAPOK_TBL_HIST(TAHUN,KOPANG,TTMASKER,BBMASKER,GAPOK,USER_ID,TERM,TG_UPD) 
                VALUES ('".$tahun."','".$kopang."', ".$ttmasker.", ".$bbmasker.", ".$gapok.",'".$user_id."','".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);


            $sql2 = "UPDATE PERS_GAPOK_TBL SET GAPOK = '".$gapok."', USER_ID='".$user_id."', TERM='".$term."', TG_UPD = SYSDATE
                WHERE KOPANG = '".$kopang."' AND TTMASKER=".$ttmasker." AND BBMASKER = ".$bbmasker." "; 
             $response2 = $this->db->query($sql2);
        }
  
        return $response;
    }

    public function update_ref_gapok_tbl($data)
    {
        $tahun = $this->input->post('tahun_ref');
        $kopang = $this->input->post('kopang');
        $ttmasker = $this->input->post('ttmasker');    
        $bbmasker = $this->input->post('bbmasker');
        $gapok = $this->input->post('gapok');
        $gapok=str_replace(",","",$gapok);            
        $user_id = $data['user_id'];
              
        $term="LOAD";                
        
        $sql = "UPDATE PERS_GAPOK_TBL_HIST SET GAPOK = '".$gapok."', USER_ID='".$user_id."', TERM='".$term."', TG_UPD = SYSDATE
                WHERE TAHUN = '".$tahun."' AND KOPANG = '".$kopang."' AND TTMASKER=".$ttmasker." AND BBMASKER = ".$bbmasker." "; 
                
        $response = $this->db->query($sql);

        $sql2 = "UPDATE PERS_GAPOK_TBL SET GAPOK = '".$gapok."', USER_ID='".$user_id."', TERM='".$term."', TG_UPD = SYSDATE
                WHERE KOPANG = '".$kopang."' AND TTMASKER=".$ttmasker." AND BBMASKER = ".$bbmasker." "; 

        $response2 = $this->db->query($sql2);
        return $response;
    } 

    public function delete_flag_ref_gapok_tbl()
    {
        $tahun = $this->input->post('key');
        $kopang = $this->input->post('key2');
        $ttmasker = $this->input->post('key3');
        $bbmasker = $this->input->post('key4');
        
        $sql = "UPDATE PERS_GAPOK_TBL_HIST SET DELETED='Y' WHERE TAHUN='".$tahun."' AND KOPANG = '".$kopang."' AND TTMASKER =".$ttmasker." AND BBMASKER = ".$bbmasker.""; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_gapok_tbl()
    {
        $tahun = $this->input->post('key');
        $kopang = $this->input->post('key2');
        $ttmasker = $this->input->post('key3');
        $bbmasker = $this->input->post('key4');
        
        $qi="INSERT INTO DEL_PERS_GAPOK_TBL_HIST A
            (
            SELECT
                TAHUN, 
                KOPANG,
                TTMASKER,
                BBMASKER,
                GAPOK,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_GAPOK_TBL_HIST D
            WHERE D.TAHUN='".$tahun."' AND D.KOPANG = '".$kopang."' AND D.TTMASKER =".$ttmasker." AND D.BBMASKER = ".$bbmasker."
            )";
        $rsi=$this->db->query($qi);
        
  
        $qj="INSERT INTO DEL_PERS_GAPOK_TBL A
            (
            SELECT 
                KOPANG,
                TTMASKER,
                BBMASKER,
                GAPOK,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_GAPOK_TBL D
            WHERE D.KOPANG = '".$kopang."' AND D.TTMASKER =".$ttmasker." AND D.BBMASKER = ".$bbmasker."
            )";
        $rsj=$this->db->query($qj);
        
        

        
        $sql = "DELETE FROM PERS_GAPOK_TBL_HIST WHERE TAHUN='".$tahun."' AND KOPANG = '".$kopang."' AND TTMASKER =".$ttmasker." AND BBMASKER = ".$bbmasker.""; 
       
        $response = $this->db->query($sql);

        $sql2 = "DELETE FROM PERS_GAPOK_TBL WHERE KOPANG = '".$kopang."' AND TTMASKER =".$ttmasker." AND BBMASKER = ".$bbmasker; 
       
        $response = $this->db->query($sql2);
        return $response;
    }
/**END GAPOK TAHUNAN**/  

/*START HUBKEL*/
/*function getNextHubkel(){
        $sql = "SELECT MAX(HUBKEL)+1 hubkel FROM PERS_HUBKEL_TBL";
        $query = $this->db->query($sql)->row();            

        return $query->HUBKEL;
    }*/    

    function getDataHubkel($id){
        $sql = "SELECT HUBKEL, NAHUBKEL FROM PERS_HUBKEL_TBL WHERE HUBKEL = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_hubkel($data)
    {
        $hubkel = $this->input->post('hubkel');    
        $nahubkel = $this->input->post('nahubkel');            
        $user_id = $data['user_id'];
                 
        $term="LOAD";               

        $cek = $this->getDataHubkel($hubkel);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_HUBKEL_TBL(HUBKEL,NAHUBKEL,USER_ID,TERM,TG_UPD) 
                VALUES ('".$hubkel."', UPPER('".$nahubkel."'),'".$user_id."','".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }  
        
        return $response;
    }

    public function update_ref_hubkel($data)
    {
        $hubkel = $this->input->post('key');
        $nahubkel = $this->input->post('nahubkel');
        $user_id = $data['user_id'];
             
        $term="LOAD";                
        
        $sql = "UPDATE PERS_HUBKEL_TBL SET NAHUBKEL = UPPER('".$nahubkel."'), USER_ID='".$user_id."', TERM = '".$term."',TG_UPD = SYSDATE
                WHERE HUBKEL = '".$hubkel."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_hubkel()
    {
        $hubkel = $this->input->post('key');
        
        $sql = "UPDATE PERS_HUBKEL_TBL SET DELETED='Y' WHERE HUBKEL = '".$hubkel."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_hubkel()
    {
        $hubkel = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_HUBKEL_TBL A
            (
            SELECT 
                HUBKEL,
                NAHUBKEL,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_HUBKEL_TBL D
            WHERE D.HUBKEL = '".$hubkel."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_HUBKEL_TBL WHERE HUBKEL = '".$hubkel."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Hubkel**/    

/*START HUKADM*/
function getNextJenhukadm(){
        $sql = "SELECT MAX(JENHUKADM)+1 jenhukadm FROM PERS_JENHUKADM_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENHUKADM;
    }    

    function getDataJenhukadm($id){
        $sql = "SELECT JENHUKADM, KETERANGAN FROM PERS_JENHUKADM_RPT WHERE JENHUKADM = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jenhukadm($data)
    {
        $jenhukadm = $this->getNextJenhukadm();    
        $keterangan = $this->input->post('keterangan');           
                                 
        
        $sql = "INSERT INTO PERS_JENHUKADM_RPT(JENHUKADM,KETERANGAN,TG_UPD) 
                VALUES ('".$jenhukadm."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jenhukadm($data)
    {
        $jenhukadm = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                            
        
        $sql = "UPDATE PERS_JENHUKADM_RPT SET KETERANGAN = UPPER('".$keterangan."'),TG_UPD = SYSDATE
                WHERE JENHUKADM = '".$jenhukadm."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jenhukadm()
    {
        $jenhukadm = $this->input->post('key');
        
        $sql = "UPDATE PERS_JENHUKADM_RPT SET DELETED='Y' WHERE JENHUKADM = '".$jenhukadm."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jenhukadm()
    {
        $jenhukadm = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENHUKADM_RPT A
            (
            SELECT 
                JENHUKADM,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENHUKADM_RPT D
            WHERE D.JENHUKADM = '".$jenhukadm."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENHUKADM_RPT WHERE JENHUKADM = '".$jenhukadm."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END HUKADM**/ 

/*START HUKDIS*/
function getNextJenhukdis(){
        $sql = "SELECT MAX(JENHUKDIS)+1 jenhukdis FROM PERS_JENHUKDIS_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENHUKDIS;
    }    

    function getDataJenhukdis($id){
        $sql = "SELECT JENHUKDIS, KETERANGAN,KET_LENGKAP,JENIS_HUKUMAN FROM PERS_JENHUKDIS_RPT WHERE JENHUKDIS= '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jenhukdis($data)
    {
        $jenhukdis = $this->getNextJenhukdis();    
        $keterangan = $this->input->post('keterangan');           
        $ket_lengkap = $this->input->post('ket_lengkap');
        $jenhuk = $this->input->post('jenhuk');
                               
        
        $sql = "INSERT INTO PERS_JENHUKDIS_RPT(JENHUKDIS,KETERANGAN,KET_LENGKAP,JENIS_HUKUMAN,TG_UPD) 
                VALUES ('".$jenhukdis."', UPPER('".$keterangan."'),UPPER('".$ket_lengkap."'),UPPER('".$jenhuk."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jenhukdis($data)
    {
        $jenhukdis = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
        $ket_lengkap = $this->input->post('ket_lengkap');
        $jenhuk = $this->input->post('jenhuk');
                            
        
        $sql = "UPDATE PERS_JENHUKDIS_RPT SET KETERANGAN = UPPER('".$keterangan."'),KET_LENGKAP = UPPER('".$ket_lengkap."'),JENIS_HUKUMAN=UPPER('".$jenhuk."'), TG_UPD = SYSDATE WHERE JENHUKDIS = '".$jenhukdis."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jenhukdis()
    {
        $jenhukdis = $this->input->post('key');
        
        $sql = "UPDATE PERS_JENHUKDIS_RPT SET DELETED='Y' WHERE JENHUKDIS = '".$jenhukdis."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jenhukdis()
    {
        $jenhukdis = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENHUKDIS_RPT A
            (
            SELECT 
                JENHUKDIS,
                KETERANGAN,
                TG_UPD,
                KET_LENGKAP,
                JENIS_HUKUMAN,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENHUKDIS_RPT D
            WHERE D.JENHUKDIS = '".$jenhukdis."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENHUKDIS_RPT WHERE JENHUKDIS = '".$jenhukdis."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END HUKDIS**/

/*START  PEJTT*/
function getNextPejtt(){
        $sql = "SELECT MAX(PEJTT)+1 pejtt FROM PERS_PEJTT_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->PEJTT;
    }    

    function getDataPejtt($id){
        $sql = "SELECT PEJTT, KETERANGAN FROM PERS_PEJTT_RPT WHERE PEJTT= '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_pejtt($data)
    {
        $pejtt = $this->getNextPejtt();    
        $keterangan = strtoupper($this->input->post('keterangan'));           
                                    
        
        $sql = "INSERT INTO PERS_PEJTT_RPT(PEJTT,KETERANGAN,TG_UPD) 
                VALUES ('".$pejtt."', '".$keterangan."',SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_pejtt($data)
    {
        $pejtt = $this->input->post('key');
        $keterangan = strtoupper($this->input->post('keterangan'));
                            
        
        $sql = "UPDATE PERS_PEJTT_RPT SET KETERANGAN = '".$keterangan."',TG_UPD = SYSDATE
                WHERE PEJTT = '".$pejtt."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_pejtt()
    {
        $pejtt = $this->input->post('key');
        
        $sql = "UPDATE PERS_PEJTT_RPT SET DELETED='Y' WHERE PEJTT = '".$pejtt."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_pejtt()
    {
        $pejtt = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PEJTT_RPT A
            (
            SELECT 
                PEJTT,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PEJTT_RPT D
            WHERE D.PEJTT = '".$pejtt."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PEJTT_RPT WHERE PEJTT = '".$pejtt."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END PEJTT**/


/*START INDUK*/
 function getDataInduk($id){
        $sql = "SELECT INDUK, NAMA_DEPT FROM PERS_INDUK_TBL WHERE INDUK= '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_induk($data)
    {
        $induk = $this->input->post('induk');    
        $nama_dept = $this->input->post('nama_dept');           
        $user_id = $data['user_id'];
            
        $term="LOAD";       

        $cek = $this->getDataInduk($induk);

        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_INDUK_TBL(INDUK,NAMA_DEPT,USER_ID,TERM,TG_UPD) 
                VALUES ('".$induk."', UPPER('".$nama_dept."'),'".$user_id."','".$term."',SYSDATE)"; 
            $response = $this->db->query($sql);
        }                       
        return $response;
    }

    public function update_ref_induk($data)
    {
        $induk = $this->input->post('key');
        $nama_dept = $this->input->post('nama_dept');
        $user_id = $data['user_id'];
               
        $term="LOAD";                        
        
        $sql = "UPDATE PERS_INDUK_TBL SET NAMA_DEPT = UPPER('".$nama_dept."'),USER_ID='".$user_id."',TERM='".$term."',TG_UPD = SYSDATE
                WHERE INDUK = '".$induk."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_induk()
    {
        $induk = $this->input->post('key');
        
        $sql = "UPDATE PERS_INDUK_TBL SET DELETED='Y' WHERE INDUK = '".$induk."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_induk()
    {
        $induk = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_INDUK_TBL A
            (
            SELECT 
                INDUK,
                NAMA_DEPT,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_INDUK_TBL D
            WHERE D.INDUK = '".$induk."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_INDUK_TBL WHERE INDUK = '".$induk."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END INDUK**/

/*START JENCUTI*/
function getNextJencuti(){
        $sql = "SELECT MAX(JENCUTI)+1 jencuti FROM PERS_JENCUTI_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENCUTI;
    }    

    function getDataJencuti($id){
        $sql = "SELECT JENCUTI, KETERANGAN FROM PERS_JENCUTI_RPT WHERE JENCUTI= '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jencuti($data)
    {
        $jencuti = $this->getNextJencuti();    
        $keterangan = $this->input->post('keterangan');           
                                   
        
        $sql = "INSERT INTO PERS_JENCUTI_RPT(JENCUTI,KETERANGAN,TG_UPD) 
                VALUES ('".$jencuti."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jencuti($data)
    {
        $jencuti = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                        
        
        $sql = "UPDATE PERS_JENCUTI_RPT SET KETERANGAN = UPPER('".$keterangan."'),TG_UPD = SYSDATE
                WHERE JENCUTI = '".$jencuti."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jencuti()
    {
        $jencuti= $this->input->post('key');
        
        $sql = "UPDATE PERS_JENCUTI_RPT SET DELETED='Y' WHERE JENCUTI = '".$jencuti."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jencuti()
    {
        $jencuti= $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENCUTI_RPT A
            (
            SELECT 
                JENCUTI,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENCUTI_RPT D
            WHERE D.JENCUTI = '".$jencuti."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENCUTI_RPT WHERE JENCUTI = '".$jencuti."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END JENCUTI**/

/*START JENFAS*/
function getNextJenfas(){
        $sql = "SELECT MAX(JENFAS)+1 jenfas FROM PERS_JENFAS_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENFAS;
    }    

    function getDataJenfas($id){
        $sql = "SELECT JENFAS, KETERANGAN FROM PERS_JENFAS_RPT WHERE JENFAS= '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jenfas($data)
    {
        $jenfas = $this->getNextJenfas();    
        $keterangan = $this->input->post('keterangan');           
                              
        
        $sql = "INSERT INTO PERS_JENFAS_RPT(JENFAS,KETERANGAN,TG_UPD) 
                VALUES ('".$jenfas."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jenfas($data)
    {
        $jenfas = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                            
        
        $sql = "UPDATE PERS_JENFAS_RPT SET KETERANGAN = UPPER('".$keterangan."'),TG_UPD = SYSDATE
                WHERE JENFAS = '".$jenfas."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jenfas()
    {
        $jenfas= $this->input->post('key');
        
        $sql = "UPDATE PERS_JENFAS_RPT SET DELETED='Y' WHERE JENFAS = '".$jenfas."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jenfas()
    {
        $jenfas= $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENFAS_RPT A
            (
            SELECT 
                JENFAS,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENFAS_RPT D
            WHERE D.JENFAS = '".$jenfas."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENFAS_RPT WHERE JENFAS = '".$jenfas."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END JENFAS**/

/*START KDDUDUK*/
    function getNextKdduduk(){
        $sql = "SELECT MAX(KDDUDUK)+1 kdduduk FROM PERS_KDDUDUK_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KDDUDUK;
    }    

    function getDataKdduduk($id){
        $sql = "SELECT KDDUDUK, KETERANGAN FROM PERS_KDDUDUK_RPT WHERE KDDUDUK= '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kdduduk($data)
    {
        $kdduduk = $this->getNextKdduduk();    
        $keterangan = $this->input->post('keterangan');           
                             
        
        $sql = "INSERT INTO PERS_KDDUDUK_RPT(KDDUDUK,KETERANGAN,TG_UPD) 
                VALUES ('".$kdduduk."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kdduduk($data)
    {
        $kdduduk = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                                 
        
        $sql = "UPDATE PERS_KDDUDUK_RPT SET KETERANGAN = UPPER('".$keterangan."'),TG_UPD = SYSDATE
                WHERE KDDUDUK = '".$kdduduk."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kdduduk()
    {
        $kdduduk= $this->input->post('key');
        
        $sql = "UPDATE PERS_KDDUDUK_RPT SET DELETED='Y' WHERE KDDUDUK = '".$kdduduk."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kdduduk()
    {
        $kdduduk= $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDDUDUK_RPT A
            (
            SELECT 
                KDDUDUK,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDDUDUK_RPT D
            WHERE D.KDDUDUK = '".$kdduduk."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KDDUDUK_RPT WHERE KDDUDUK = '".$kdduduk."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END KDDUDUK**/

/*START KECAMATAN*/

    function getDataKecamatan($id1,$id2){
        $sql = "SELECT KOWIL, KOCAM,NACAM FROM PERS_KOCAM_TBL WHERE KOWIL=".$id2." AND KOCAM= '".$id1."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kecamatan($data)
    {
        $kowil = $this->input->post('kowil');
        $kocam = $this->input->post('kocam');  
        $nacam = $this->input->post('nacam');           
        $user_id = $data['user_id'];
           
        $term="LOAD";                            
        
        $cek=$this->getDataKecamatan($kocam,$kowil);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_KOCAM_TBL(KOWIL,KOCAM,NACAM,USER_ID,TERM,TG_UPD) 
                VALUES (".$kowil.",'".$kocam."',UPPER('".$nacam."'),'".$user_id."','".$term."',SYSDATE)"; 
            $response = $this->db->query($sql);
        }

        
        return $response;
    }

    public function update_ref_kecamatan($data)
    {
        $kowil = $this->input->post('kowil');
        $kocam = $this->input->post('kocam');
        $nacam = $this->input->post('nacam');
        $user_id = $data['user_id'];
          
        $term="LOAD";                        
        
        $sql = "UPDATE PERS_KOCAM_TBL SET NACAM = UPPER('".$nacam."'),TG_UPD = SYSDATE
                WHERE KOWIL= ".$kowil." AND KOCAM = '".$kocam."'"; 

        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kecamatan()
    {
        $kowil= $this->input->post('key2');
        $kocam= $this->input->post('key');
        
        $sql = "UPDATE PERS_KOCAM_TBL SET DELETED='Y' WHERE KOWIL = ".$kowil." AND KOCAM ='".$kocam."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kecamatan()
    {
        $kowil= $this->input->post('key2');
        $kocam= $this->input->post('key');
        
        $sql = "DELETE FROM PERS_KOCAM_TBL WHERE KOWIL = ".$kowil." AND KOCAM ='".$kocam."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END KECAMATAN**/

/*START KELURAHAN*/

    PUBLIC function getDataKelurahan($id1,$id2,$id3){
        $sql = "SELECT
            PERS_KOWIL_TBL.NAWIL,
            PERS_KOKEL_TBL.KOWIL,
            PERS_KOKEL_TBL.KOCAM,
            PERS_KOCAM_TBL.NACAM,
            PERS_KOKEL_TBL.KOKEL,
            PERS_KOKEL_TBL.NAKEL
        FROM
            PERS_KOKEL_TBL
        LEFT JOIN PERS_KOWIL_TBL ON PERS_KOKEL_TBL.KOWIL = PERS_KOWIL_TBL.KOWIL 
        LEFT JOIN PERS_KOCAM_TBL ON PERS_KOKEL_TBL.KOCAM = PERS_KOCAM_TBL.KOCAM AND PERS_KOCAM_TBL.KOWIL=PERS_KOKEL_TBL.KOWIL 
        WHERE
        PERS_KOKEL_TBL.KOWIL = ".$id2."
        AND PERS_KOKEL_TBL.KOCAM = '".$id3."'
        AND PERS_KOKEL_TBL.KOKEL = '".$id1."'"; 

        // echo $sql;exit;

        $query = $this->db->query($sql)->row();       
        
        return $query;
    }   

    // public function getDataKelurahan($id1,$id2,$id3,$id4){
    //     $sql = "SELECT KEL.KELURAHAN AS KD_KEL,KEL.NAMA,KEC.KECAMATAN AS KD_KEC,KEC.NAMA AS NM_KEC,KAB.KABUPATEN_KOTA AS KD_KAB,KAB.NAMA AS NM_KAB,PROV.PROPINSI AS KD_PROV,PROV.NAMA AS NM_PROV
    //             FROM LOKASI KEL
    //             LEFT JOIN
    //             (
    //                 SELECT PROPINSI,KABUPATEN_KOTA,KECAMATAN,KELURAHAN,NAMA FROM
    //                 LOKASI 
    //                 WHERE KELURAHAN = 0
    //             )KEC ON KEL.KECAMATAN = KEC.KECAMATAN AND KEL.KABUPATEN_KOTA = KEC.KABUPATEN_KOTA AND KEL.PROPINSI = KEC.PROPINSI
    //             LEFT JOIN
    //             (
    //                 SELECT PROPINSI,KABUPATEN_KOTA,KECAMATAN,KELURAHAN,NAMA FROM
    //                 LOKASI 
    //                 WHERE KELURAHAN = 0
    //                 AND KECAMATAN = 0
    //             )KAB ON KEL.KABUPATEN_KOTA = KAB.KABUPATEN_KOTA AND KEL.PROPINSI = KAB.PROPINSI
    //             LEFT JOIN
    //             (
    //                 SELECT PROPINSI,KABUPATEN_KOTA,KECAMATAN,KELURAHAN,NAMA FROM
    //                 LOKASI 
    //                 WHERE KELURAHAN = 0
    //                 AND KECAMATAN = 0
    //                 AND KABUPATEN_KOTA = 0
    //             )PROV ON KEL.PROPINSI = PROV.PROPINSI
    //             WHERE KEL.KELURAHAN = '".$id1."'
    //             AND KEL.KECAMATAN = '".$id2."'
    //             AND KEL.KABUPATEN_KOTA = '".$id3."'
    //             AND KEL.PROPINSI = '".$id4."' "; 
        
    //     // echo $sql;exit;

    //     $query = $this->db->query($sql)->row();       
        
    //     return $query;
    // }   

    public function getDataKelurahan2($id1,$id2,$id3,$id4){
        $sql = "SELECT
                    KODE,KELURAHAN,KECAMATAN,KABUPATEN_KOTA,PROPINSI,NAMA
                FROM
                    LOKASI 
                WHERE
                    KELURAHAN = '".$id1."'
                AND KECAMATAN = '".$id2."'
                AND KABUPATEN_KOTA = '".$id3."'
                AND PROPINSI = '".$id4."' "; 
        
        // echo $sql;exit;

        $query = $this->db->query($sql)->row();       
        
        return $query;
    }  
    
    public function simpan_ref_kelurahan($data)
    {
        $prov = $this->input->post('prov');
        $kowil = $this->input->post('kowil');
        $cekKowil = substr($kowil, 3,1);
        if($cekKowil==0){
          $kowil1 = substr($kowil, 4,1);  
        }else{
           $kowil1 = substr($kowil, 3,2);  
        }
        
        $kocam = $this->input->post('kocam');
        $cekKocam = substr($kocam, 6,1);
        if($cekKocam == 0){
            $kocam1 = substr($kocam, 7,1);
        }else{
            $kocam1 = substr($kocam, 6,2);
        }
       
        $kokel = $this->input->post('kokel');  
        $nakel = $this->input->post('nakel');   
        $kode = ($kocam.'.'.$kokel);
        // var_dump($prov);
        // var_dump($kowil);
        // var_dump($kocam);
        // var_dump($cekKowil);
        // var_dump($kowil1);
        // var_dump($kocam1);
        // exit;        
        $user_id = $data['user_id'];

        $id = "SELECT MAX(\"ID\")+1 AS ID
                FROM LOKASI ";
        $idx = $this->db->query($id)->row();
        $idnew = $idx->ID;
        // echo $idx->ID;exit;

        $sql = "INSERT INTO LOKASI(ID,KODE,NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN,KELURAHAN,AKTIF) 
                 VALUES ('".$idnew."','".$kode."',UPPER('".$nakel."'),'".$prov."','".$kowil1."','".$kocam1."','".$kokel."','N')"; 
        // echo $sql;exit;
        $response = $this->db->query($sql);
             
        // $term="LOAD";               

        // $cek=$this->getDataKelurahan($kokel,$kowil,$kocam);
        // var_dump($cek);exit;

        // if($cek!=null)
        // {
        //     $response=false;
        // }             
        // else
        // {
        //     $sql = "INSERT INTO PERS_KOKEL_TBL(KOWIL,KOCAM,KOKEL,NAKEL,USER_ID,TERM,TG_UPD) 
        //         VALUES (".$kowil.",'".$kocam."','".$kokel."',UPPER('".$nakel."'),'".$user_id."','".$term."',SYSDATE)"; 
        //     $response = $this->db->query($sql);
        // }
        
        
        return $response;
    }

    public function update_ref_kelurahan($data)
    {   

        $id = $this->input->post('id');
        $prov = $this->input->post('prov');
        $kowil = $this->input->post('kowil');
        $cekKowil = strlen($kowil);
        // echo $cekKowil;exit;
        if($cekKowil==1){
          $kowil1 = ('0'.$kowil); 
        }elseif($cekKowil==5){
            $kowil1 = substr($kowil, 3,2);
        }else{
           $kowil1 = $kowil;  
        }
        
        $kocam = $this->input->post('kocam');
        $cekKocam = strlen($kocam);
        if($cekKocam == 1){
            $kocam1 = ('0'.$kocam);
        }elseif($cekKocam==8){
            $kocam1 = substr($kocam, 6,2);
        }else{
            $kocam1 = $kocam;
        }
       
        $kokel = $this->input->post('kokel');  
        $nakel = $this->input->post('nakel');   
        $kode = ($kocam.'.'.$kokel);

        $user_id = $data['user_id'];
             
        $term="LOAD";                        
        
        $sql = "UPDATE LOKASI SET NAMA = UPPER('".$nakel."'),KODE='".$prov.".".$kowil1.".".$kocam1.".".$kokel."',
                PROPINSI='".$prov."',KABUPATEN_KOTA = '".$kowil1."',KECAMATAN = '".$kocam1."',KELURAHAN = '".$kokel."'
                WHERE ID= '".$id."' " ; 
              
        // echo $sql;exit;
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kelurahan()
    {
        $id= $this->input->post('key');
        
        $sql = "UPDATE LOKASI SET DELETED='Y' WHERE \"ID\" = '".$id."' "; 
       // echo $sql;exit;
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kelurahan()
    {
        $id= $this->input->post('key');
        
        $sql = "DELETE FROM LOKASI WHERE \"ID\" = '".$id."' "; 
       // echo $sql;exit;
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kelurahan2()
    {
        $kowil= $this->input->post('key2');
        $kocam= $this->input->post('key3');
         $kokel= $this->input->post('key');
        
        $sql = "DELETE FROM PERS_KOKEL_TBL WHERE KOWIL = ".$kowil." AND KOCAM ='".$kocam."' AND KOKEL ='".$kokel."'"; 
       echo $sql;
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kelurahan2()
    {
        $kowil= $this->input->post('key2');
        $kocam= $this->input->post('key3');
         $kokel= $this->input->post('key');
        
        $sql = "DELETE FROM PERS_KOKEL_TBL WHERE KOWIL = ".$kowil." AND KOCAM ='".$kocam."' AND KOKEL ='".$kokel."'"; 
       echo $sql;
        $response = $this->db->query($sql);
        return $response;
    }
/**END KELURAHAN**/

/*START JABATAN*/

    function getDataJabatan($id1,$id2){
        $sql = "SELECT KOLOK, KOJAB,NAJABS,NAJABL,KDSORT,ESELON,KOLOK_SEKTORAL, POINT_207,TAHUN,JOB_CLASS1,JOB_CLASS2
        ,TUNJAB,TRANSPORT,POINT,TAHAP1,TAHAP2,PERINGKAT,AKTIF,PERINGKAT_409,POINT_409,TKD_409
        FROM PERS_KOJAB_TBL WHERE KOLOK=".$id1." AND KOJAB = '".$id2."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jabatan($data)
    {
        $kolok = $this->input->post('kolok');
        $kojab = $this->input->post('kojab');
        $kdsort = $this->input->post('kdsort');   
        $najabs = $this->input->post('najabs');
        $najabl = $this->input->post('najabl');
        $eselon = $this->input->post('eselon');           
        $user_id = $data['user_id'];
              
        $term="LOAD";         
        $job_class1 = $this->input->post('job_class1');

        if($job_class1 == null)
        {
            $job_class1=0;
        }
        $job_class2 = $this->input->post('job_class2');
        
        $tunjab = $this->input->post('tunjab');
        if($tunjab==null)
        {
            $tunjab=0;
        }
        $kolok_sektoral = $this->input->post('kolok_sektoral');
        $peringkat = $this->input->post('peringkat');
        $transport = $this->input->post('transport');
        if($transport==null)
        {
            $transport=0;
        }
        $point = $this->input->post('point');  
        if($point==null)
        {
            $point=0;
        }
        $point_207 = $this->input->post('point_207');
        if($point_207==null)
        {
            $point_207=0;
        }
        $tahap1 = $this->input->post('tahap1');
        if($tahap1==null)
        {
            $tahap1=0;
        }
        $tahap2 = $this->input->post('tahap2');
        if($tahap2==null)
        {
            $tahap2=0;
        }                 
        $aktif = $this->input->post('aktif');
        $tahun = $this->input->post('tahun');
        if($tahun==null)
        {
            $tahun=2017;
        }
        $peringkat_409 = $this->input->post('peringkat_409');
        $point_409 = $this->input->post('point_409');
        if($point_409==null)
        {
            $point_409=0;
        }
        $tkd_409 = $this->input->post('tkd_409');
        if($tkd_409==null)
        {
            $tkd_409=0;
        }                                  


        $cek=$this->getDataJabatan($kolok,$kojab);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_KOJAB_TBL(KOLOK,KOJAB,KDSORT,NAJABS,NAJABL,ESELON,USER_ID,TERM,TG_UPD,JOB_CLASS1,JOB_CLASS2,KOLOK_SEKTORAL,POINT_207,TAHUN,AKTIF,TUNJAB,SEMENTARA,KDTRANS,TRANSPORT,POINT,TAHAP1,TAHAP2,PERINGKAT,PERINGKAT_409,POINT_409,TKD_409) 
                VALUES ('".$kolok."','".$kojab."','".$kdsort."',UPPER('".$najabs."'),UPPER('".$najabl."'),'".$eselon."','".$user_id."','".$term."',SYSDATE,".$job_class1.",'".$job_class2."',UPPER('".$kolok_sektoral."'),".$point_207.",'".$tahun."','$aktif',".$tunjab.",0,'',".$transport.",".$point.",".$tahap1.",".$tahap2.",UPPER('".$peringkat."'),UPPER('".$peringkat_409."'),".$point_409.",".$tkd_409.")";
            
            $response = $this->db->query($sql);
        }
        return $response;
    }

    public function update_ref_jabatan($data)
    {
        $kolok = $this->input->post('kolok');
        $kojab = $this->input->post('kojab');
        $kdsort = $this->input->post('kdsort');  
        $najabs = $this->input->post('najabs');
        $najabl = $this->input->post('najabl');
        $eselon = $this->input->post('eselon');           
        $user_id = $data['user_id'];
             
        $term="LOAD";         
        $job_class1 = $this->input->post('job_class1');

        if($job_class1 == null || $job_class1 == "")
        {
            $job_class1=0;
        }
        $job_class2 = $this->input->post('job_class2');
        $tunjab = $this->input->post('tunjab');
        if($tunjab==null)
        {
            $tunjab=0;
        }
        $kolok_sektoral = $this->input->post('kolok_sektoral');
        $peringkat = $this->input->post('peringkat');
        $transport = $this->input->post('transport');
        if($transport==null)
        {
            $transport=0;
        }
        $point = $this->input->post('point');  
        if($point==null)
        {
            $point=0;
        }
        $point_207 = $this->input->post('point_207');
        if($point_207==null)
        {
            $point_207=0;
        }
        $tahap1 = $this->input->post('tahap1');
        if($tahap1==null)
        {
            $tahap1=0;
        }
        $tahap2 = $this->input->post('tahap2');
        if($tahap2==null)
        {
            $tahap2=0;
        }
         $aktif = $this->input->post('aktif');                 
        $tahun = $this->input->post('tahun');
        if($tahun==null)
        {
            $tahun=2017;
        }                        
        $peringkat_409 = $this->input->post('peringkat_409');
        $point_409 = $this->input->post('point_409');
        if($point_409==null)
        {
            $point_409=0;
        }
        $tkd_409 = $this->input->post('tkd_409');
        if($tkd_409==null)
        {
            $tkd_409=0;
        }   
        $sql = "UPDATE PERS_KOJAB_TBL SET KDSORT = '".$kdsort."',NAJABS = UPPER('".$najabs."'),NAJABL = UPPER('".$najabl."'),ESELON = '".$eselon."',USER_ID = '".$user_id."',
                TERM = '".$term."',TG_UPD = SYSDATE,JOB_CLASS1 = ".$job_class1.",JOB_CLASS2 = '".$job_class2."',KOLOK_SEKTORAL = UPPER('".$kolok_sektoral."'),
                point_207 = ".$point_207.",TAHUN = ".$tahun.", AKTIF='$aktif',TUNJAB = ".$tunjab.",SEMENTARA='',KDTRANS='',TRANSPORT = ".$transport.",point = ".$point.",TAHAP1 = '".$tahap1."',
                TAHAP2 = ".$tahap2.",PERINGKAT = UPPER('".$peringkat."'),PERINGKAT_409 = UPPER('".$peringkat_409."'), POINT_409 = ".$point_409.", TKD_409 = ".$tkd_409."
                WHERE KOLOK= '".$kolok."' AND KOJAB = '".$kojab."'";
               
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jabatan()
    {
        $kolok= $this->input->post('key');
        $kojab= $this->input->post('key2');
        
        $sql = "UPDATE PERS_KOJAB_TBL SET DELETED='Y' WHERE KOLOK = ".$kolok." AND KOJAB ='".$kojab."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jabatan()
    {
        $kolok= $this->input->post('key');
        $kojab= $this->input->post('key2');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KOJAB_TBL A
            (
            SELECT 
                KOLOK,
                KOJAB,
                KDSORT,
                NAJABS,
                NAJABL,
                ESELON,
                USER_ID,
                TERM,
                TG_UPD,
                JOB_CLASS1,
                JOB_CLASS2,
                KOLOK_SEKTORAL,
                POINT_207,
                TAHUN,
                AKTIF,
                TUNJAB,
                SEMENTARA,
                KDTRANS,
                TRANSPORT,
                POINT,
                TAHAP1,
                TAHAP2,
                PERINGKAT,
                PERINGKAT_108,
                POINT_108,
                TKD_108,
                PERINGKAT_409,
                POINT_409,
                TKD_409,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KOJAB_TBL D
            WHERE D.KOLOK = ".$kolok." AND D.KOJAB ='".$kojab."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KOJAB_TBL WHERE KOLOK = ".$kolok." AND KOJAB ='".$kojab."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END JABATAN**/

/*START JABATANF*/

    function getDataJabatanf($id){
        $sql = "SELECT KOJAB,NAJABS,NAJABL,KDSORT,TUNFUNG,JOB_CLASS1,JOB_CLASS2,POINT
        ,TUNJAB,POINT_207,PERINGKAT,TAHAP1,TAHAP2 
        FROM PERS_KOJABF_TBL WHERE KOJAB = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jabatanf($data)
    {
        $kojab = $this->input->post('kojab');
        $kdsort = '0';  
        
        $najabs = $this->input->post('najabs');
        $najabl = $this->input->post('najabl');
        $tunfung = $this->input->post('tunfung');           
        $user_id = $data['user_id'];
               
        $term="LOAD";         
        $job_class1 = $this->input->post('job_class1');
        if($job_class1 == null)
        {
            $job_class1=0;
        }
        $job_class2 = $this->input->post('job_class2');
        $tunjab = $this->input->post('tunjab');
        if($tunjab == null)
        {
            $tunjab=0;
        }
        $peringkat = $this->input->post('peringkat');
        $point = $this->input->post('point');  
        if($point == null)
        {
            $point=0;
        }
        $point_207 = $this->input->post('point_207');
        if($point_207 == null)
        {
            $point_207=0;
        }
        $tahap1 = $this->input->post('tahap1');
        if($tahap1 == null)
        {
            $tahap1=0;
        }
        $tahap2 = $this->input->post('tahap2');                 
        if($tahap2 == null)
        {
            $tahap2=0;
        }

        $cek = $this->getDataJabatanf($kojab);
        if($cek!=null)
        {
            $response=false;
        }
        else if($cek==null)
        {
            $sql = "INSERT INTO PERS_KOJABF_TBL(KOJAB,KDSORT,NAJABS,NAJABL,TUNFUNG,USER_ID,TERM,TG_UPD,JOB_CLASS1,JOB_CLASS2,POINT_207,TUNJAB,PERINGKAT,POINT,TAHAP1,TAHAP2) 
                VALUES ('".$kojab."','".$kdsort."',UPPER('".$najabs."'),UPPER('".$najabl."'),'".$tunfung."','".$user_id."','".$term."',SYSDATE,".$job_class1.",
                    '".$job_class2."',".$point_207.",".$tunjab.",UPPER('".$peringkat."'),".$point.",".$tahap1.",".$tahap2.")"; 
            $response = $this->db->query($sql);
        }

        return $response;
    }

    public function update_ref_jabatanf($data)
    {
        $kojab = $this->input->post('kojab');
        $kdsort = '';
        
        $najabs = $this->input->post('najabs');
        $najabl = $this->input->post('najabl');
        $tunfung = $this->input->post('tunfung');           
        $user_id = $data['user_id'];
              
        $term="LOAD";         
        $job_class1 = $this->input->post('job_class1');
        if($job_class1 == null)
        {
            $job_class1=0;
        }
        $job_class2 = $this->input->post('job_class2');
        $tunjab = $this->input->post('tunjab');
        if($tunjab == null)
        {
            $tunjab=0;
        }
        $peringkat = $this->input->post('peringkat');
        $point = $this->input->post('point');  
        if($point == null)
        {
            $point=0;
        }
        $point_207 = $this->input->post('point_207');
        if($point_207 == null)
        {
            $point_207=0;
        }
        $tahap1 = $this->input->post('tahap1');
        if($tahap1 == null)
        {
            $tahap1=0;
        }
        $tahap2 = $this->input->post('tahap2');                 
        if($tahap2 == null)
        {
            $tahap2=0;
        }                          
        
        $sql = "UPDATE PERS_KOJABF_TBL SET KDSORT = '".$kdsort."',NAJABS = UPPER('".$najabs."'),NAJABL = UPPER('".$najabl."'),TUNFUNG = '".$tunfung."',USER_ID = '".$user_id."',
                TERM = '".$term."',TG_UPD = SYSDATE,JOB_CLASS1 = ".$job_class1.",JOB_CLASS2 = '".$job_class2."',
                point_207 = ".$point_207.",TUNJAB = ".$tunjab.",point = ".$point.",TAHAP1 = '".$tahap1."',TAHAP2 = ".$tahap2.",PERINGKAT = UPPER('".$peringkat."')
                WHERE KOJAB = '".$kojab."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jabatanf()
    {
        $kojab= $this->input->post('key');
        
        $sql = "UPDATE PERS_KOJABF_TBL SET DELETED='Y' WHERE KOJAB ='".$kojab."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jabatanf()
    {
        $kojab= $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KOJABF_TBL A
            (
            SELECT 
                KOJAB,
                KDSORT,
                NAJABS,
                NAJABL,
                TUNFUNG,
                USER_ID,
                TERM,
                TG_UPD,
                JOB_CLASS1,
                JOB_CLASS2,
                POINT_207,
                TUNJAB,
                PERINGKAT,
                POINT,
                TAHAP1,
                TAHAP2,
                PERINGKAT_108,
                POINT_108,
                TKD_108,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KOJABF_TBL D
            WHERE D.KOJAB ='".$kojab."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KOJABF_TBL WHERE KOJAB ='".$kojab."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END JABATANF**/

/**START Lingkup**/
    function getNextKdlingkup(){
        $sql = "SELECT MAX(KDLINGKUP)+1 kdlingkup FROM PERS_KDLINGKUP_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KDLINGKUP;
    }    

    function getDataKdlingkup($id){
        $sql = "SELECT KDLINGKUP, KETERANGAN FROM PERS_KDLINGKUP_RPT WHERE KDLINGKUP = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kdlingkup($data)
    {
        $kdlingkup = $this->getNextKdlingkup();    
        $keterangan = $this->input->post('keterangan');            
      
        $sql = "INSERT INTO PERS_KDLINGKUP_RPT(KDLINGKUP,KETERANGAN, TG_UPD) 
                VALUES ('".$kdlingkup."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kdlingkup($data)
    {
        $kdlingkup = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                      
        
        $sql = "UPDATE PERS_KDLINGKUP_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KDLINGKUP = '".$kdlingkup."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kdlingkup()
    {
        $kdlingkup = $this->input->post('key');
        
        $sql = "UPDATE PERS_KDLINGKUP_RPT SET DELETED='Y' WHERE KDLINGKUP = '".$kdlingkup."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kdlingkup()
    {
        $kdlingkup = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDLINGKUP_RPT A
            (
            SELECT 
                KDLINGKUP,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDLINGKUP_RPT D
            WHERE D.KDLINGKUP = '".$kdlingkup."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KDLINGKUP_RPT WHERE KDLINGKUP = '".$kdlingkup."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Lingkup**/    

/**START Pegawai**/
    function getNextPegawai(){
        $sql = "SELECT MAX(JENPEG)+1 jenpeg FROM PERS_JENPEG_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENPEG;
    }    

    function getDataPegawai($id){
        $sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT WHERE JENPEG = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_pegawai($data)
    {
        $jenpeg = $this->getNextPegawai();    
        $keterangan = $this->input->post('keterangan');            
               
        
        $sql = "INSERT INTO PERS_JENPEG_RPT(JENPEG,KETERANGAN, TG_UPD) 
                VALUES ('".$jenpeg."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_pegawai($data)
    {
        $jenpeg = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                  
        
        $sql = "UPDATE PERS_JENPEG_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE JENPEG = '".$jenpeg."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_pegawai()
    {
        $jenpeg = $this->input->post('key');
        
        $sql = "UPDATE PERS_JENPEG_RPT SET DELETED='Y' WHERE JENPEG = '".$jenpeg."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_pegawai()
    {
        $jenpeg = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENPEG_RPT A
            (
            SELECT 
                JENPEG,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENPEG_RPT D
            WHERE D.JENPEG = '".$jenpeg."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENPEG_RPT WHERE JENPEG = '".$jenpeg."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Pegawai**/        

/**START Jenis Pekerjaan**/
    function getNextKdkerja(){
        $sql = "SELECT MAX(KDKERJA)+1 kdkerja FROM PERS_KDKERJA_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KDKERJA;
    }    

    function getDataKdkerja($id){
        $sql = "SELECT KDKERJA, KETERANGAN FROM PERS_KDKERJA_RPT WHERE KDKERJA = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kdkerja($data)
    {
        $kdkerja = $this->getNextKdkerja();    
        $keterangan = $this->input->post('keterangan');            
                       
        
        $sql = "INSERT INTO PERS_KDKERJA_RPT(KDKERJA,KETERANGAN, TG_UPD) 
                VALUES ('".$kdkerja."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kdkerja($data)
    {
        $kdkerja = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                  
        
        $sql = "UPDATE PERS_KDKERJA_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KDKERJA = '".$kdkerja."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kdkerja()
    {
        $kdkerja = $this->input->post('key');
        
        $sql = "UPDATE PERS_KDKERJA_RPT SET DELETED='Y' WHERE KDKERJA = '".$kdkerja."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kdkerja()
    {
        $kdkerja = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDKERJA_RPT A
            (
            SELECT 
                KDKERJA,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDKERJA_RPT D
            WHERE D.KDKERJA = '".$kdkerja."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KDKERJA_RPT WHERE KDKERJA = '".$kdkerja."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Jenis Pekerjaan**/    

/**START Jenis Pendidikan**/
    function getNextJendik(){
        $sql = "SELECT MAX(JENDIK)+1 jendik FROM PERS_JENDIK_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENDIK;
    }    

    function getDataJendik($id){
        $sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jendik($data)
    {
        $jendik = $this->getNextJendik();    
        $keterangan = $this->input->post('keterangan');            
                   
        
        $sql = "INSERT INTO PERS_JENDIK_RPT(JENDIK,KETERANGAN, TG_UPD) 
                VALUES ('".$jendik."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jendik($data)
    {
        $jendik = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                    
        
        $sql = "UPDATE PERS_JENDIK_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE JENDIK = '".$jendik."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jendik()
    {
        $jendik = $this->input->post('key');
        
        $sql = "UPDATE PERS_JENDIK_RPT SET DELETED='Y' WHERE JENDIK = '".$jendik."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jendik()
    {
        $jendik = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENDIK_RPT A
            (
            SELECT 
                JENDIK,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENDIK_RPT D
            WHERE D.JENDIK = '".$jendik."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENDIK_RPT WHERE JENDIK = '".$jendik."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Jenis Pendidikan**/

/**START Jenis Peran Penulis**/
       

    function getDataPeran($id){
        $sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANT_RPT WHERE KDPERAN = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_peran($data)
    {
        $kdperan =$this->input->post('kdperan');     
        $keterangan = $this->input->post('keterangan');            
        

        $cek=$this->getDataPeran($kdperan);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_KDPERANT_RPT(KDPERAN,KETERANGAN,TG_UPD) 
                VALUES ('".$kdperan."', UPPER('".$keterangan."'), SYSDATE)"; 
            $response = $this->db->query($sql);
        }                 
        
        
        return $response;
    }

    public function update_ref_peran($data)
    {
        $kdperan = $this->input->post('kdperan');
        $keterangan = $this->input->post('keterangan');
                      
        
        $sql = "UPDATE PERS_KDPERANT_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KDPERAN = '".$kdperan."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_peran()
    {
        $kdperan = $this->input->post('key');
        
        $sql = "UPDATE PERS_KDPERANT_RPT SET DELETED='Y' WHERE KDPERAN = '".$kdperan."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_peran()
    {
        $kdperan = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDPERANT_RPT A
            (
            SELECT 
                KDPERAN,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDPERANT_RPT D
            WHERE D.KDPERAN = '".$kdperan."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KDPERANT_RPT WHERE KDPERAN = '".$kdperan."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Jenis Peran Penulis**/

 /**START Jenis Peran Seminar**/
       

    function getDataSeminar($id){
        $sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANS_RPT WHERE KDPERAN = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_seminar($data)
    {
        $kdperan =$this->input->post('kdperan');     
        $keterangan = $this->input->post('keterangan');            
           

        $cek=$this->getDataSeminar($kdperan);
        if($cek!=null)
        {
            $response=false;
        }              
        else
        {
            $sql = "INSERT INTO PERS_KDPERANS_RPT(KDPERAN,KETERANGAN,TG_UPD) 
                VALUES ('".$kdperan."', UPPER('".$keterangan."'), SYSDATE)"; 
            $response = $this->db->query($sql);
        }
        
        
        return $response;
    }

    public function update_ref_seminar($data)
    {
        $kdperan = $this->input->post('kdperan');
        $keterangan = $this->input->post('keterangan');
                
        
        $sql = "UPDATE PERS_KDPERANS_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KDPERAN = '".$kdperan."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_seminar()
    {
        $kdperan = $this->input->post('key');
        
        $sql = "UPDATE PERS_KDPERANS_RPT SET DELETED='Y' WHERE KDPERAN = '".$kdperan."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_seminar()
    {
        $kdperan = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDPERANS_RPT A
            (
            SELECT 
                KDPERAN,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDPERANS_RPT D
            WHERE D.KDPERAN = '".$kdperan."'
            )";
        $rsi=$this->db->query($qi);
        $sql = "DELETE FROM PERS_KDPERANS_RPT WHERE KDPERAN = '".$kdperan."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Jenis Peran Seminar**/   

/**START Jenis Perubahan**/
    function getNextJenrub(){
        $sql = "SELECT MAX(JENRUB)+1 jenrub FROM PERS_JENRUB_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENRUB;
    }    

    function getDataJenrub($id){
        $sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT WHERE JENRUB = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jenrub($data)
    {
        $jenrub = $this->getNextJenrub();    
        $keterangan = $this->input->post('keterangan');            
                   
        
        $sql = "INSERT INTO PERS_JENRUB_RPT(JENRUB,KETERANGAN, TG_UPD) 
                VALUES ('".$jenrub."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jenrub($data)
    {
        $jenrub = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                    
        
        $sql = "UPDATE PERS_JENRUB_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE JENRUB = '".$jenrub."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jenrub()
    {
        $jenrub = $this->input->post('key');
        
        $sql = "UPDATE PERS_JENRUB_RPT SET DELETED='Y' WHERE JENRUB = '".$jenrub."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jenrub()
    {
        $jenrub = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENRUB_RPT A
            (
            SELECT 
                JENRUB,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENRUB_RPT D
            WHERE D.JENRUB = '".$jenrub."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENRUB_RPT WHERE JENRUB = '".$jenrub."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END Jenis Perubahan**/

/**START Jenis SEMINAR**/
    function getNextKdSemi(){
        $sql = "SELECT MAX(KDSEMI)+1 kdsemi FROM PERS_KDSEMI_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KDSEMI;
    }    

    function getDataKdsemi($id){
        $sql = "SELECT KDSEMI, KETERANGAN FROM PERS_KDSEMI_RPT WHERE KDSEMI = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kdsemi($data)
    {
        $kdsemi = $this->getNextKdSemi();    
        $keterangan = $this->input->post('keterangan');            
                      
        
        $sql = "INSERT INTO PERS_KDSEMI_RPT(KDSEMI,KETERANGAN, TG_UPD) 
                VALUES ('".$kdsemi."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kdsemi($data)
    {
        $kdsemi = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                   
        
        $sql = "UPDATE PERS_KDSEMI_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KDSEMI = '".$kdsemi."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kdsemi()
    {
        $kdsemi = $this->input->post('key');
        
        $sql = "UPDATE PERS_KDSEMI_RPT SET DELETED='Y' WHERE KDSEMI = '".$kdsemi."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kdsemi()
    {
        $kdsemi = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDSEMI_RPT A
            (
            SELECT 
                KDSEMI,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDSEMI_RPT D
            WHERE D.KDSEMI = '".$kdsemi."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KDSEMI_RPT WHERE KDSEMI = '".$kdsemi."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END SEMINAR**/

/**START JENIS SIFAT**/
    function getNextKdsifat(){
        $sql = "SELECT MAX(KDSIFAT)+1 kdsifat FROM PERS_KDSIFAT_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KDSIFAT;
    }    

    function getDataKdsifat($id){
        $sql = "SELECT KDSIFAT, KETERANGAN FROM PERS_KDSIFAT_RPT WHERE KDSIFAT = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kdsifat($data)
    {
        $kdsifat = $this->getNextKdsifat();    
        $keterangan = $this->input->post('keterangan');            
                     
        
        $sql = "INSERT INTO PERS_KDSIFAT_RPT(KDSIFAT,KETERANGAN, TG_UPD) 
                VALUES ('".$kdsifat."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kdsifat($data)
    {
        $kdsifat = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                  
        
        $sql = "UPDATE PERS_KDSIFAT_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KDSIFAT = '".$kdsifat."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kdsifat()
    {
        $kdsifat = $this->input->post('key');
        
        $sql = "UPDATE PERS_KDSIFAT_RPT SET DELETED='Y' WHERE KDSIFAT = '".$kdsifat."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kdsifat()
    {
        $kdsifat = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KDSIFAT_RPT A
            (
            SELECT 
                KDSIFAT,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KDSIFAT_RPT D
            WHERE D.KDSIFAT = '".$kdsifat."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KDSIFAT_RPT WHERE KDSIFAT = '".$kdsifat."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END KDSIFAT**/

/**START JENIS USAHA**/
    function getNextJenusaha(){
        $sql = "SELECT MAX(JENUSAHA)+1 jenusaha FROM PERS_JENUSAHA_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->JENUSAHA;
    }    

    function getDataJenusaha($id){
        $sql = "SELECT JENUSAHA, KETERANGAN FROM PERS_JENUSAHA_RPT WHERE JENUSAHA = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_jenusaha($data)
    {
        $jenusaha = $this->getNextJenusaha();    
        $keterangan = $this->input->post('keterangan');            
                        
        
        $sql = "INSERT INTO PERS_JENUSAHA_RPT(JENUSAHA,KETERANGAN, TG_UPD) 
                VALUES ('".$jenusaha."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_jenusaha($data)
    {
        $jenusaha = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                    
        
        $sql = "UPDATE PERS_JENUSAHA_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE JENUSAHA = '".$jenusaha."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_jenusaha()
    {
        $jenusaha = $this->input->post('key');
        
        $sql = "UPDATE PERS_JENUSAHA_RPT SET DELETED='Y' WHERE JENUSAHA = '".$jenusaha."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_jenusaha()
    {
        $jenusaha = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENUSAHA_RPT A
            (
            SELECT 
                JENUSAHA,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENUSAHA_RPT D
            WHERE D.JENUSAHA = '".$jenusaha."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENUSAHA_RPT WHERE JENUSAHA = '".$jenusaha."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END JENUSAHA**/


/** START KODE KELOMPOK PENDIDIKAN / KODIK **/
    
    function getDataKodik($id){
        $sql = "SELECT KODIK, KODIKF, KETERANGAN FROM PERS_KODIK_RPT WHERE KODIK = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kodik($data)
    {
        $kodik = $this->input->post('kodik');    
        $kodikf = $this->input->post('kodikf');
        $keterangan = $this->input->post('keterangan');
                   
        
        $sql = "INSERT INTO PERS_KODIK_RPT(KODIK, KODIKF, KETERANGAN, TG_UPD) 
                VALUES ('".$kodik."', '".$kodikf."', UPPER('".$keterangan."'),SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kodik($data)
    {
        $kodik = $this->input->post('kodik');    
        $kodikf = $this->input->post('kodikf');
        $keterangan = $this->input->post('keterangan');
        
        
        $sql = "UPDATE PERS_KODIK_RPT SET KODIKF = '".$kodikf."', KETERANGAN = UPPER('".$keterangan."'), TG_UPD =SYSDATE
                WHERE KODIK = '".$kodik."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kodik()
    {
        $kodik = $this->input->post('key');
        
        $sql = "UPDATE PERS_KODIK_RPT SET DELETED='Y' WHERE KODIK = '".$kodik."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kodik()
    {
        $kodik = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KODIK_RPT A
            (
            SELECT 
                KODIK,
                KODIKF,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KODIK_RPT D
            WHERE D.KODIK = '".$kodik."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KODIK_RPT WHERE KODIK = '".$kodik."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END KODE KELOMPOK PENDIDIKAN / KODIK**/

/** START LOKASI GAJI/SPMU **/
    
    function getDataSpmu($id){
        $sql = "SELECT KODE_SPM, NAMA, KLOGAD_INDUK, TAHUN, KDSORT FROM PERS_TABEL_SPMU WHERE KODE_SPM = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_spmu($data)
    {

        $kode_spm = $this->input->post('kode_spm');    
        $nama = $this->input->post('nama');
        $klogad_induk = $this->input->post('klogad_induk');
        $tahun = $this->input->post('tahun');
        if($tahun == null)
        {
            $tahun=0;
        }
        $kdsort = 0;
          

        $cek=$this->getDataSpmu($kode_spm);
        //var_dump($cek);
        if($cek!=null)
        {
            $response = false;
        }            
        else if($cek==null)
        {

            $sql = "INSERT INTO PERS_TABEL_SPMU(KODE_SPM, NAMA, KLOGAD_INDUK, TAHUN, KDSORT) 
                    VALUES ('".$kode_spm."', UPPER('".$nama."'), '".$klogad_induk."',".$tahun.",".$kdsort.")"; 
            
            $response = $this->db->query($sql);
        }
        //var_dump($response);
        return $response;
    }

    public function update_ref_spmu($data)
    {
        $kode_spm = $this->input->post('kode_spm');    
        $nama = $this->input->post('nama');
        $klogad_induk = $this->input->post('klogad_induk');
        $tahun = $this->input->post('tahun');
        if($tahun == null)
        {
            $tahun=0;
        }
        $kdsort = 0;
          
        
        $sql = "UPDATE PERS_TABEL_SPMU SET NAMA = UPPER('".$nama."'), KLOGAD_INDUK = '".$klogad_induk."', TAHUN = ".$tahun.",KDSORT = ".$kdsort."
                WHERE KODE_SPM = '".$kode_spm."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_spmu()
    {
        $kode_spm = $this->input->post('key');
        
        $sql = "UPDATE PERS_TABEL_SPMU SET DELETED='Y' WHERE KODE_SPM = '".$kode_spm."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_spmu()
    {
        $kode_spm = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_TABEL_SPMU A
            (
            SELECT 
                KODE_SPM,
                NAMA,
                KLOGAD_INDUK,
                TAHUN,
                KDSORT,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_TABEL_SPMU D
            WHERE D.KODE_SPM = '".$kode_spm."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_TABEL_SPMU WHERE KODE_SPM = '".$kode_spm."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END SPMU**/

/**START KOLOK**/
    
    function getDataKolok($id){
        $sql = "SELECT KOLOK, NALOKS,NALOKL, KORAS, MAKAN_INS, TAHUN, AKTIF,KODE_UNIT_SIPKD FROM PERS_LOKASI_TBL WHERE KOLOK = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kolok($data)
    {
        $kolok = $this->input->post('kolok');    
        $naloks = $this->input->post('naloks');
        $nalokl = $this->input->post('nalokl');
        $koras = $this->input->post('koras');
        $makan_ins = $this->input->post('makan_ins');
        $user_id = $data['user_id'];
       
        $term="LOAD";      
        $tahun = $this->input->post('tahun');
        $aktif = $this->input->post('aktif');
        $kode_unit_sipkd = $this->input->post('kode_unit_sipkd');      

        $cek=$this->getDataKolok($kolok);
        if($cek!=null)
        {
            $response=false;
        }        
        else
        {
            $sql = "INSERT INTO PERS_LOKASI_TBL(KOLOK, NALOKS, NALOKL, KORAS, MAKAN_INS, USER_ID,TERM,TG_UPD,TAHUN,AKTIF,KODE_UNIT_SIPKD) 
                VALUES ('".$kolok."', UPPER('".$naloks."'), UPPER('".$nalokl."'),'".$koras."','".$makan_ins."','".$user_id."','".$term."', SYSDATE,'".$tahun."','".$aktif."',UPPER('".$kode_unit_sipkd."'))"; 
            $response = $this->db->query($sql);
        }
        
        
        return $response;
    }

    public function update_ref_kolok($data)
    {
        $kolok = $this->input->post('kolok');    
        $naloks = $this->input->post('naloks');
        $nalokl = $this->input->post('nalokl');
        $koras = $this->input->post('koras');
        $makan_ins = $this->input->post('makan_ins');
        $user_id = $data['user_id'];
     
        $term="LOAD";      
        $tahun = $this->input->post('tahun');
        $aktif = $this->input->post('aktif');
        $kode_unit_sipkd = $this->input->post('kode_unit_sipkd');    
        
        $sql = "UPDATE PERS_LOKASI_TBL SET NALOKS = UPPER('".$naloks."'), NALOKL = UPPER('".$nalokl."'), KORAS = '".$koras."',MAKAN_INS = '".$makan_ins."',USER_ID = '".$user_id."',TERM = '".$term."',TG_UPD = SYSDATE, TAHUN = '".$tahun."',AKTIF = '".$aktif."', KODE_UNIT_SIPKD = UPPER('".$kode_unit_sipkd."')
                WHERE KOLOK = '".$kolok."' "; 
				
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kolok()
    {
        $kolok = $this->input->post('key');
        
        $sql = "UPDATE PERS_LOKASI_TBL SET DELETED='Y' WHERE KOLOK = '".$kolok."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kolok()
    {
        $kolok = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_LOKASI_TBL A
            (
            SELECT 
                KOLOK,
                NALOKS,
                NALOKL,
                KORAS,
                MAKAN_INS,
                USER_ID,
                TERM,
                TG_UPD,
                TAHUN,
                AKTIF,
                KODE_UNIT_SIPKD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_LOKASI_TBL D
            WHERE D.KOLOK = '".$kolok."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_LOKASI_TBL WHERE KOLOK = '".$kolok."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END KOLOK**/

/**START KLOGAD3**/
    
    function getDataKlogad($id){
        $sql = "SELECT KOLOK, NALOK,SPMU,AKTIF, TAHUN, KODE_UNIT_SIPKD FROM PERS_KLOGAD3 WHERE KOLOK = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_klogad($data)
    {
        $kolok = $this->input->post('kolok');    
        $nalok = $this->input->post('nalok');
        $spmu = $this->input->post('spmu');
        $aktif = $this->input->post('aktif');
        $tahun = $this->input->post('tahun');
        $kode_unit_sipkd = $this->input->post('kode_unit_sipkd');     

        $cek=$this->getDataKlogad($kolok);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_KLOGAD3(KOLOK, NALOK, SPMU, AKTIF, TAHUN, KODE_UNIT_SIPKD) 
                VALUES ('".$kolok."', UPPER('".$nalok."'), '".$spmu."', '".$aktif."','".$tahun."','".$kode_unit_sipkd."' )"; 
            $response = $this->db->query($sql);
        }        
        
        return $response;
    }

    public function update_ref_klogad($data)
    {
        $kolok = $this->input->post('kolok');    
        $nalok = $this->input->post('nalok');
        $spmu = $this->input->post('spmu');
        $aktif = $this->input->post('aktif');
        $tahun = $this->input->post('tahun');
        $kode_unit_sipkd = $this->input->post('kode_unit_sipkd');     
        
        $sql = "UPDATE PERS_KLOGAD3 SET NALOK = UPPER('".$nalok."'), SPMU = '".$spmu."', AKTIF = '".$aktif."', TAHUN = '".$tahun."', KODE_UNIT_SIPKD = '".$kode_unit_sipkd."'
                WHERE KOLOK = '".$kolok."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_klogad()
    {
        $kolok = $this->input->post('key');
        
        $sql = "UPDATE PERS_KLOGAD3 SET DELETED='Y' WHERE KOLOK = '".$kolok."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_klogad()
    {
        $kolok = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KLOGAD3 A
            (
            SELECT 
                KOLOK,
                NALOK,
                SPMU,
                AKTIF,
                TAHUN,
                KODE_UNIT_SIPKD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KLOGAD3 D
            WHERE D.KOLOK = '".$kolok."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KLOGAD3 WHERE KOLOK = '".$kolok."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END KLOGAD3**/    

/**START NEGARA**/
    
    function getDataNegara($id){
        $sql = "SELECT KONEG, NANEG FROM PERS_NEGARA_TBL WHERE KONEG = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_negara($data)
    {
        $koneg = $this->input->post('koneg');    
        $naneg = $this->input->post('naneg');           
        $user_id = $data['user_id'];
                
        $term="LOAD";

        $cek=$this->getDataNegara($koneg);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_NEGARA_TBL(KONEG, NANEG, USER_ID, TERM, TG_UPD) 
                VALUES ('".$koneg."', UPPER('".$naneg."'), '".$user_id."', '".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }            
        
        return $response;
    }

    public function update_ref_negara($data)
    {
        $koneg = $this->input->post('koneg');
        $naneg = $this->input->post('naneg');
        $user_id = $data['user_id'];
                  
        $term="LOAD";      
        
        $sql = "UPDATE PERS_NEGARA_TBL SET NANEG = UPPER('".$naneg."'), USER_ID = '".$user_id."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE KONEG = '".$koneg."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_negara()
    {
        $koneg = $this->input->post('key');
        
        $sql = "UPDATE PERS_NEGARA_TBL SET DELETED='Y' WHERE KONEG = '".$koneg."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_negara()
    {
        $koneg = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_NEGARA_TBL A
            (
            SELECT 
                KONEG,
                NANEG,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_NEGARA_TBL D
            WHERE D.KONEG = '".$koneg."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_NEGARA_TBL WHERE KONEG = '".$koneg."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END NEGARA**/

/**START PANGKAT**/
    
    function getDataPangkat($id){
        $sql = "SELECT KOPANG, GOL, NAPANG, KOPANG_PNS FROM PERS_PANGKAT_TBL WHERE KOPANG = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_pangkat($data)
    {
        $kopang = $this->input->post('kopang');    
        $gol = $this->input->post('gol');
        $napang = $this->input->post('napang');
        $kopang_pns = $this->input->post('kopang_pns');            
        $user_id = $data['user_id'];
                 
        $term="LOAD";   

        $cek=$this->getDataPangkat($kopang);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_PANGKAT_TBL(KOPANG, GOL, NAPANG, KOPANG_PNS, USER_ID, TERM, TG_UPD) 
                VALUES ('".$kopang."', '".$gol."',UPPER('".$napang."'),'".$kopang_pns."', '".$user_id."', '".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }   
          
        return $response;
    }

    public function update_ref_pangkat($data)
    {
        $kopang = $this->input->post('kopang');
        $gol = $this->input->post('gol');
        $napang = $this->input->post('napang');
        $kopang_pns = $this->input->post('kopang_pns'); 
        $user_id = $data['user_id'];
                  
        $term="LOAD";      
        
        $sql = "UPDATE PERS_PANGKAT_TBL SET GOL = '".$gol."',NAPANG = UPPER('".$napang."'),KOPANG_PNS = '".$kopang_pns."', USER_ID = '".$user_id."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE KOPANG = '".$kopang."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_pangkat()
    {
        $kopang = $this->input->post('key');
        
        $sql = "UPDATE PERS_PANGKAT_TBL SET DELETED='Y' WHERE KOPANG = '".$kopang."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_pangkat()
    {
        $kopang = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PANGKAT_TBL A
            (
            SELECT 
                KOPANG,
                GOL,
                NAPANG,
                USER_ID,
                KOPANG_PNS,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PANGKAT_TBL D
            WHERE D.KOPANG = '".$kopang."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PANGKAT_TBL WHERE KOPANG = '".$kopang."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END PANGKAT**/

/**START PENGHARGAAN**/
    
    function getDataHargaan($id){
        $sql = "SELECT KDHARGA, NAHARGA FROM PERS_HARGAAN_TBL WHERE KDHARGA = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_hargaan($data)
    {
        $kdharga = $this->input->post('kdharga');    
        $naharga = $this->input->post('naharga');            
        $user_id = $data['user_id'];
     
        $term="LOAD";      

        $cek=$this->getDataHargaan($kdharga);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
             $sql = "INSERT INTO PERS_HARGAAN_TBL(KDHARGA, NAHARGA, USER_ID, TERM, TG_UPD) 
                VALUES ('".$kdharga."', UPPER('".$naharga."'), '".$user_id."', '".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }
        
        return $response;
    }

    public function update_ref_hargaan($data)
    {
        $kdharga = $this->input->post('kdharga');
        $naharga = $this->input->post('naharga');
        $user_id = $data['user_id'];
               
        $term="LOAD";      
        
        $sql = "UPDATE PERS_HARGAAN_TBL SET NAHARGA = UPPER('".$naharga."'), USER_ID = '".$user_id."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE KDHARGA = '".$kdharga."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_hargaan()
    {
        $kdharga = $this->input->post('key');
        
        $sql = "UPDATE PERS_HARGAAN_TBL SET DELETED='Y' WHERE KDHARGA = '".$kdharga."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_hargaan()
    {
        $kdharga = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_HARGAAN_TBL A
            (
            SELECT 
                KDHARGA,
                NAHARGA,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_HARGAAN_TBL D
            WHERE D.KDHARGA = '".$kdharga."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_HARGAAN_TBL WHERE KDHARGA = '".$kdharga."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END PENGHARGAAN**/

/**START TEMA**/
    
    function getDataTema($id){
        $sql = "SELECT KDTEMA, NATEMA FROM PERS_TEMA_TBL WHERE KDTEMA = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_tema($data)
    {
        $kdtema = $this->input->post('kdtema');    
        $natema = $this->input->post('natema');            
        $user_id = $data['user_id'];
                
        $term="LOAD";      
        
        $cek=$this->getDataTema($kdtema);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_TEMA_TBL(KDTEMA, NATEMA, USER_ID, TERM, TG_UPD) 
                VALUES ('".$kdtema."', UPPER('".$natema."'), '".$user_id."', '".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }
        
        return $response;
    }

    public function update_ref_tema($data)
    {
        $kdtema = $this->input->post('kdtema');
        $natema = $this->input->post('natema');
        $user_id = $data['user_id'];
               
        $term="LOAD";      
        
        $sql = "UPDATE PERS_TEMA_TBL SET NATEMA = UPPER('".$natema."'), USER_ID = '".$user_id."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE KDTEMA = '".$kdtema."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_tema()
    {
        $kdtema = $this->input->post('key');
        
        $sql = "UPDATE PERS_TEMA_TBL SET DELETED='Y' WHERE KDTEMA = '".$kdtema."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_tema()
    {
        $kdtema = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_TEMA_TBL A
            (
            SELECT 
                KDTEMA,
                NATEMA,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_TEMA_TBL D
            WHERE D.KDTEMA = '".$kdtema."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_TEMA_TBL WHERE KDTEMA = '".$kdtema."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END TEMA**/

/**START PENDIDIKAN FORMAL**/

    function getNextKodikf(){
        $sql = "SELECT MAX(KODIKF)+1 kodikf FROM PERS_KODIKF_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KODIKF;
    }
    
    function getDataKodikf($id){
        $sql = "SELECT KODIKF, KETERANGAN FROM PERS_KODIKF_RPT WHERE KODIKF = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kodikf($data)
    {
        $kodikf = $this->getNextKodikf();    
        $keterangan = $this->input->post('keterangan');            
                
        
        $sql = "INSERT INTO PERS_KODIKF_RPT(KODIKF, KETERANGAN, TG_UPD) 
                VALUES ('".$kodikf."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kodikf($data)
    {
        $kodikf = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                  
        
        $sql = "UPDATE PERS_KODIKF_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KODIKF = '".$kodikf."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kodikf()
    {
        $kodikf = $this->input->post('key');
        
        $sql = "UPDATE PERS_KODIKF_RPT SET DELETED='Y' WHERE KODIKF = '".$kodikf."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kodikf()
    {
        $kodikf = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KODIKF_RPT A
            (
            SELECT 
                KODIKF,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KODIKF_RPT D
            WHERE D.KODIKF = '".$kodikf."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KODIKF_RPT WHERE KODIKF = '".$kodikf."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END PENDIDIKAN FORMAL**/

/**START PENDIDIKAN JENJANG**/

    function getNextKodikj(){
        $sql = "SELECT MAX(KODIKJ)+1 kodikj FROM PERS_KODIKJ_RPT";
        $query = $this->db->query($sql)->row();            

        return $query->KODIKJ;
    }
    
    function getDataKodikj($id){
        $sql = "SELECT KODIKJ, KETERANGAN FROM PERS_KODIKJ_RPT WHERE KODIKJ = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_kodikj($data)
    {
        $kodikj = $this->getNextKodikj();    
        $keterangan = $this->input->post('keterangan');            
                       
        
        $sql = "INSERT INTO PERS_KODIKJ_RPT(KODIKJ, KETERANGAN, TG_UPD) 
                VALUES ('".$kodikj."', UPPER('".$keterangan."'), SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_kodikj($data)
    {
        $kodikj = $this->input->post('key');
        $keterangan = $this->input->post('keterangan');
                   
        
        $sql = "UPDATE PERS_KODIKJ_RPT SET KETERANGAN = UPPER('".$keterangan."'), TG_UPD = SYSDATE
                WHERE KODIKJ = '".$kodikj."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_kodikj()
    {
        $kodikj = $this->input->post('key');
        
        $sql = "UPDATE PERS_KODIKJ_RPT SET DELETED='Y' WHERE KODIKJ = '".$kodikj."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_kodikj()
    {
        $kodikj = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KODIKJ_RPT A
            (
            SELECT 
                KODIKJ,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KODIKJ_RPT D
            WHERE D.KODIKJ = '".$kodikj."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KODIKJ_RPT WHERE KODIKJ = '".$kodikj."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END PENDIDIKAN JENJANG**/

/**START TINGKAT PENDIDIKAN**/

    
    function getDataPdidikan($id,$id2){
        $sql = "SELECT JENDIK,KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK='".$id2."'AND KODIK = '".$id."'";        
        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_pdidikan($data)
    {
        $jendik = $this->input->post('jendik'); 
        $kodik = $this->input->post('kodik');  
        $nadik = $this->input->post('nadik');            
        $user_id = $data['user_id'];
              
        $term="LOAD";     

        $cek=$this->getDataPdidikan($kodik,$jendik);
        if($cek!=null)
        {
            $response=false;
        }            
        else
        {
            $sql = "INSERT INTO PERS_PDIDIKAN_TBL(JENDIK, KODIK, NADIK, USER_ID,TERM, TG_UPD) 
                VALUES (".$jendik.", '".$kodik."', UPPER('".$nadik."'),'".$user_id."','".$term."', SYSDATE)"; 
        
             $response = $this->db->query($sql);
        }
        
        
        return $response;
    }

    public function update_ref_pdidikan($data)
    {
        $jendik = $this->input->post('jendik'); 
        $kodik = $this->input->post('kodik');  
        $nadik = $this->input->post('nadik');            
        $user_id = $data['user_id'];
            
        $term="LOAD";                
        
        $sql = "UPDATE PERS_PDIDIKAN_TBL SET NADIK = UPPER('".$nadik."'),USER_ID = '".$user_id."',TERM = '".$term."', TG_UPD = SYSDATE
                WHERE JENDIK='".$jendik."' AND KODIK = '".$kodik."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_pdidikan()
    {
        $jendik = $this->input->post('key2');
        $kodik = $this->input->post('key');
        
        $sql = "UPDATE PERS_PDIDIKAN_TBL SET DELETED='Y' WHERE JENDIK ='".$jendik."' AND KODIK = '".$kodik."'"; 
        //echo $sql;
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_pdidikan()
    {
    	$jendik = $this->input->post('key2');
        $kodik = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PDIDIKAN_TBL A
            (
            SELECT 
                JENDIK,
                KODIK,
                NADIK,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PDIDIKAN_TBL D
            WHERE D.JENDIK ='".$jendik."' AND D.KODIK = '".$kodik."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PDIDIKAN_TBL WHERE JENDIK ='".$jendik."' AND KODIK = '".$kodik."'"; 
        //echo $sql;
        $response = $this->db->query($sql);
        return $response;
    }
/**END TINGKAT PENDIDIKAN**/

/**START UNIVER**/
    
    function getDataUniver($id){
        $sql = "SELECT KDUNIVER, NAUNIVER FROM PERS_UNIVER_TBL WHERE KDUNIVER = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_univer($data)
    {
        $kduniver = $this->input->post('kduniver');    
        $nauniver = $this->input->post('nauniver');            
        $user_id = $data['user_id'];
                  
        $term="LOAD";      

        $cek=$this->getDataUniver($kduniver);
        if($cek!=null)
        {
            $response=false;
        }
        else
        {
            $sql = "INSERT INTO PERS_UNIVER_TBL(KDUNIVER, NAUNIVER, USER_ID, TERM, TG_UPD) 
                VALUES ('".$kduniver."', UPPER('".$nauniver."'), '".$user_id."', '".$term."', SYSDATE)"; 
            $response = $this->db->query($sql);
        }
        
        
        return $response;
    }

    public function update_ref_univer($data)
    {
        $kduniver = $this->input->post('kduniver');
        $nauniver = $this->input->post('nauniver');
        $user_id = $data['user_id'];
                
        $term="LOAD";      
        
        $sql = "UPDATE PERS_UNIVER_TBL SET NAUNIVER = UPPER('".$nauniver."'), USER_ID = '".$user_id."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE KDUNIVER = '".$kduniver."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_univer()
    {
        $kduniver = $this->input->post('key');
        
        $sql = "UPDATE PERS_UNIVER_TBL SET DELETED='Y' WHERE KDUNIVER = '".$kduniver."'"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_univer()
    {
        $kduniver = $this->input->post('key');
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_UNIVER_TBL A
            (
            SELECT 
                KDUNIVER,
                NAUNIVER,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_UNIVER_TBL D
            WHERE D.KDUNIVER = '".$kduniver."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_UNIVER_TBL WHERE KDUNIVER = '".$kduniver."'"; 
        $response = $this->db->query($sql);
        return $response;
    }
/**END UNIVERSITAS**/
    
/**START WILAYAH**/
    function getNextWilayah(){
        $sql = "SELECT MAX(KOWIL)+1 kowil FROM PERS_KOWIL_TBL";
        $query = $this->db->query($sql)->row();            

        return $query->KOWIL;
    }    

    function getDataWilayah($id){
        $sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL WHERE KOWIL = '".$id."'";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }    
    
    public function simpan_ref_wilayah($data)
    {
        $kowil = $this->getNextWilayah();    
        $nawil = $this->input->post('nawil');            
        $user_id = $data['user_id'];
                
        $term="LOAD";      
        
        $sql = "INSERT INTO PERS_KOWIL_TBL(KOWIL, NAWIL, USER_ID, TERM, TG_UPD) 
                VALUES ('".$kowil."', UPPER('".$nawil."'), '".$user_id."', '".$term."', SYSDATE)"; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function update_ref_wilayah($data)
    {
        $kowil = $this->input->post('key');
        $nawil = $this->input->post('nawil');
        $user_id = $data['user_id'];
         
        $term="LOAD";      
        
        $sql = "UPDATE PERS_KOWIL_TBL SET NAWIL = UPPER('".$nawil."'), USER_ID = '".$user_id."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE KOWIL = '".$kowil."' "; 
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_flag_ref_wilayah()
    {
        $kowil = $this->input->post('key');
        
        $sql = "UPDATE PERS_KOWIL_TBL SET DELETED='Y' WHERE kowil = '".$kowil."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }

    public function delete_ref_wilayah()
    {
        $kowil = $this->input->post('key');
        
        $sql = "DELETE FROM PERS_KOWIL_TBL WHERE kowil = '".$kowil."'"; 
       
        $response = $this->db->query($sql);
        return $response;
    }
/**END WILAYAH**/

     /*START AGAMA*/
     function getNextAgama(){
         $sql = "SELECT MAX(AGAMA)+1 AGAMA FROM PERS_AGAMA_RPT";
         $query = $this->db->query($sql)->row();

         return $query->AGAMA;
     }

     function getDataAgama($id){
         $sql = "SELECT AGAMA, KETERANGAN FROM PERS_AGAMA_RPT WHERE AGAMA= '".$id."'";

         $query = $this->db->query($sql)->row();

         return $query;
     }

     public function simpan_ref_agama($data)
     {
         $agama = $this->getNextAgama();
         $keterangan = $this->input->post('keterangan');
         

         $sql = "INSERT INTO PERS_AGAMA_RPT(AGAMA,KETERANGAN,TG_UPD)
                VALUES ('".$agama."', UPPER('".$keterangan."'),SYSDATE)";
         $response = $this->db->query($sql);
         return $response;
     }

     public function update_ref_agama($data)
     {
         $agama = $this->input->post('key');
         $keterangan = $this->input->post('keterangan');
         

         $sql = "UPDATE PERS_AGAMA_RPT SET KETERANGAN = UPPER('".$keterangan."'),TG_UPD = SYSDATE
                WHERE AGAMA = '".$agama."' ";
         $response = $this->db->query($sql);
         return $response;
     }

     public function delete_flag_ref_agama()
     {
         $agama= $this->input->post('key');

         $sql = "UPDATE PERS_AGAMA_RPT SET DELETED='Y' WHERE AGAMA = '".$agama."'";

         $response = $this->db->query($sql);
         return $response;
     }

     public function delete_ref_agama()
     {
         $agama= $this->input->post('key');

         $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_AGAMA_RPT A
            (
            SELECT 
                AGAMA,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_AGAMA_RPT D
            WHERE D.AGAMA = '".$agama."'
            )";
        $rsi=$this->db->query($qi);

         $sql = "DELETE FROM PERS_AGAMA_RPT WHERE AGAMA = '".$agama."'";

         $response = $this->db->query($sql);
         return $response;
     }
     /**END AGAMA**/

     //start Jenis SK //

     public function getDataSk($id)
     {
        $sql = "SELECT KETERANGAN FROM PERS_JENSK WHERE ID_JENSK= '".$id."'";

         $query = $this->db->query($sql)->row();

         return $query;
     }

     function getNextSK(){
         $sql = "SELECT MAX(ID_JENSK)+1 SK FROM PERS_JENSK";
         $query = $this->db->query($sql)->row();

         return $query->SK;
     }

     public function simpan_ref_sk($data)
     {
         $sk = $this->getNextSK();
         $keterangan = $this->input->post('keterangan');
         

         $sql = "INSERT INTO PERS_JENSK(ID_JENSK,KETERANGAN,TG_UPD)
                VALUES ('".$sk."', UPPER('".$keterangan."'),SYSDATE)";
         $response = $this->db->query($sql);
         return $response;
     }

     public function update_ref_sk($data)
     {
         $sk = $this->input->post('key');
         $keterangan = $this->input->post('keterangan');
         

         $sql = "UPDATE PERS_JENSK SET KETERANGAN = UPPER('".$keterangan."'),TG_UPD = SYSDATE
                WHERE ID_JENSK = '".$sk."' ";
         $response = $this->db->query($sql);
         return $response;
     }

     public function delete_flag_ref_sk()
     {
         $sk= $this->input->post('key');

         $sql = "UPDATE PERS_JENSK SET DELETED='Y' WHERE ID_JENSK = '".$sk."'";

         $response = $this->db->query($sql);
         return $response;
     }

     public function delete_ref_sk()
     {
         $sk= $this->input->post('key');

         $user_id = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JENSK A
            (
            SELECT 
                ID_JENSK,
                KETERANGAN,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JENSK D
            WHERE D.ID_JENSK = '".$sk."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JENSK WHERE ID_JENSK = '".$sk."'";

         $response = $this->db->query($sql);
         return $response;
     }

     // end Jenis SK//

     public function getMasterPangkat($kopang="")
     {
         $sql = "SELECT KOPANG, GOL, NAPANG
                FROM PERS_PANGKAT_TBL
                 WHERE KOPANG='$kopang'
                ORDER BY KOPANG ASC
                ";

         $rs = $this->db->query($sql)->result();

         return $rs;

     }

     public function dataKel()
    {
        $requestData = $this->input->post();    

        $columns = array( 
        // datatable column index  => database column name
            0 => 'RN',
            1 => 'KEL_NM',
            2 => 'KEL_NM', 
            3 => 'KEL_NM',
            4 => 'KEL_NM',
            5 => 'KEL_NM',
            6 => 'KEL_NM'

        );

        // getting total number records without any search
        $sql = "SELECT * FROM (
                    SELECT rownum as RN,KEL.KODE AS KEL_KODE,PROV.KODE,PROV.PROPINSI AS PROV_KD,KB.KABUPATEN_KOTA AS KOTA_KD,KC.KECAMATAN AS KEC_KD,KEL.KELURAHAN AS KEL_KD,KEL.\"ID\" AS KEL_ID,
                    PROV.NAMA AS NM_PROV,KB.NAMA AS NM_KAB,KC.NAMA AS NM_KEC,KEL.NAMA AS KEL_NM
                    FROM LOKASI PROV
                    LEFT JOIN
                    (
                        SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                        WHERE KABUPATEN_KOTA <> 0
                        AND KECAMATAN = 0
                    )KB ON PROV.PROPINSI = KB.PROPINSI
                    LEFT JOIN
                    (
                        SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                        WHERE KECAMATAN <> 0
                        AND KELURAHAN = 0
                    )KC ON PROV.PROPINSI = KC.PROPINSI AND KB.KABUPATEN_KOTA = KC.KABUPATEN_KOTA
                    LEFT JOIN
                    (
                        SELECT \"ID\",KODE,NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN,KELURAHAN FROM LOKASI
                        WHERE KELURAHAN <> 0
                    )KEL ON PROV.PROPINSI = KEL.PROPINSI AND KB.KABUPATEN_KOTA = KEL.KABUPATEN_KOTA AND KC.KECAMATAN = KEL.KECAMATAN
                    WHERE SUBSTR(PROV.KODE, 3, 11)='.00.00.0000'
                ) KEL";
        
        
        $query = $this->db->query($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM (
                    SELECT rownum as RN,KEL.KODE AS KEL_KODE,PROV.KODE,PROV.PROPINSI AS PROV_KD,KB.KABUPATEN_KOTA AS KOTA_KD,KC.KECAMATAN AS KEC_KD,KEL.KELURAHAN AS KEL_KD,KEL.\"ID\" AS KEL_ID,
                    PROV.NAMA AS NM_PROV,KB.NAMA AS NM_KAB,KC.NAMA AS NM_KEC,KEL.NAMA AS KEL_NM
                    FROM LOKASI PROV
                    LEFT JOIN
                    (
                        SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                        WHERE KABUPATEN_KOTA <> 0
                        AND KECAMATAN = 0
                    )KB ON PROV.PROPINSI = KB.PROPINSI
                    LEFT JOIN
                    (
                        SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                        WHERE KECAMATAN <> 0
                        AND KELURAHAN = 0
                    )KC ON PROV.PROPINSI = KC.PROPINSI AND KB.KABUPATEN_KOTA = KC.KABUPATEN_KOTA
                    LEFT JOIN
                    (
                        SELECT \"ID\",KODE,NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN,KELURAHAN FROM LOKASI
                        WHERE KELURAHAN <> 0
                    )KEL ON PROV.PROPINSI = KEL.PROPINSI AND KB.KABUPATEN_KOTA = KEL.KABUPATEN_KOTA AND KC.KECAMATAN = KEL.KECAMATAN
                    WHERE SUBSTR(PROV.KODE, 3, 11)='.00.00.0000'
                ) KEL WHERE 1 = 1  ";

        
        // getting records as per search parameters
        if( !empty($requestData['search']['value']) ){   //kode nptt
            $sql.=" AND lower(KEL_NM) LIKE lower('%".$requestData['search']['value']."%') ";
            // echo $sql;
        }
        
        
        
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();    
        
        $sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".($requestData['length']+$requestData['start'])." "; 
        $sql.=" ORDER BY \"".$columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
        
        // ECHO $sql;exit;
        // var_dump($sql);exit;
         // echo $sql;  
        $query= $this->db->query($sql);
        $n = $_POST['start'];
        $no = $n+1;
        $data = array();        

        foreach($query->result() as $row){
            $nestedData=array(); 
            $nestedData[] = $no;
            $nestedData[] = $row->KEL_KODE;
            $nestedData[] = $row->KEL_NM;
            $nestedData[] = $row->NM_KEC;
            $nestedData[] = $row->NM_KAB;
            $nestedData[] = $row->NM_PROV;
            // $nestedData[] = $row->KEL_ID;
            $nestedData[] = "
                            <td >
                                <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kelurahan\",\"edit\",\"".$row->KEL_KD."\",\"".$row->KEC_KD."\",\"".$row->KOTA_KD."\",\"".$row->PROV_KD."\",\"".$row->KEL_ID."\",\"".$row->KEL_KODE."\");'><i class='fa fa-pencil-square'></i></button> 
                                <button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"ref_kelurahan\",\"".$row->KEL_ID."\");'><i class='fa fa-trash'></i></button>
                            </td>
                            ";
            // $nestedData[] = "
            //                 <td >
            //                     <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kelurahan\",\"edit\",\"".$row->KOKEL."\",\"".$row->KOWIL."\",\"".$row->KOCAM."\");'><i class='fa fa-pencil-square'></i></button> 
            //                     <button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"ref_kelurahan\",\"".$row->KOKEL."\",\"".$row->KOWIL."\",\"".$row->KOCAM."\");'><i class='fa fa-trash'></i></button>
            //                 </td>
            //                 ";
            
            $data[] = $nestedData;
            $no++;
        }   

        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),   
                    "recordsTotal"    => intval( $totalData ),  
                    "recordsFiltered" => intval( $totalFiltered ), 
                    "data"            => $data   
                    );

        echo json_encode($json_data); 
    }

}

?>
<?php 

 class V_kojabf extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid)
    {

        $sql = "SELECT * FROM PERS_KOJABF_TBL";        
        $sql .= " WHERE KOJAB = '".$whereid."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $kojab = $data['kojab'];
            $kdsort = $data['kdsort'];
            $najabs = $data['najabs'];
            $najabl = $data['najabl'];
            $tunfung = $data['tunfung'];
            $job_class1 = $data['job_class1'];
            $job_class2 = $data['job_class2'];
            $point_207 = $data['point_207'];
            $tunjab = $data['tunjab'];
            $peringkat = $data['peringkat'];
            $point = $data['point'];
            $tahap1 = $data['tahap1'];
            $tahap2 = $data['tahap2'];
            $now=date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO pers_kojabf_tbl(kojab,kdsort,najabs,najabl,tunfung,user_id,term,tg_upd,job_class1,job_class2,point,tunjab) 
                VALUES ('".$kojab."','".$kdsort."','".$najabs."','".$najabl."',".$tunfung.",'".$user['id']."','".$term."',
                         TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'),".$job_class1.",'".$job_class2."',".$point_207.",".$tunjab.",'".$peringkat."',".$point.",".$tahap1.",".$tahap2.")"; 

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }

    function updateData($data){
        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $kojab = $data['kojab'];
            $kdsort = $data['kdsort'];
            $najabs = $data['najabs'];
            $najabl = $data['najabl'];
            $tunfung = ($data['tunfung'] == '' ? 0 : $data['tunfung']);
            $job_class1 = ($data['job_class1'] == '' ? 0 : $data['job_class1']);
            $job_class2 = $data['job_class2'];
            $point_207 = ($data['point_207'] == '' ? 0 : $data['point_207']);
            $tunjab = ($data['tunjab'] == '' ? 0 : $data['tunjab']);
            $peringkat = $data['peringkat'];
            $point = ($data['point'] == '' ? 0 : $data['point']);
            $tahap1 = ($data['tahap1'] == '' ? 0 : $data['tahap1']);
            $tahap2 = ($data['tahap2'] == '' ? 0 : $data['tahap2']);
            $term="LOAD"; 
            $now=date('Y-m-d h:i:s');   
        
        $sql = "UPDATE pers_kojabf_tbl SET kdsort = '".$kdsort."',najabs = '".$najabs."', najabl = '".$najabl."',tunfung = ".$tunfung.",user_id='".$user['id']."',
                term='".$term."', tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'), job_class1 = ".$job_class1.", job_class2 = '".$job_class2."',point_207 = ".$point_207.", tunjab = ".$tunjab.", peringkat = '".$peringkat."',point = ".$point.", tahap1 = ".$tahap1.",tahap2 = ".$tahap2." WHERE KOJAB ='".$kojab."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id){
        
        $sql = "DELETE FROM pers_kojabf_tbl WHERE KOJAB = '".$id."'";

        $id = $this->db->query($sql);
        return $id;
    }

    

}

?>
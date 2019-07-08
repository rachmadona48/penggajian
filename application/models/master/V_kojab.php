<?php 

 class V_kojab extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid, $whereid2)
    {

        $sql = "SELECT * FROM PERS_KOJAB_TBL";        
        $sql .= " WHERE KOLOK = '".$whereid."' AND KOJAB ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $kolok = $data['kolok'];
            $kojab = $data['kojab'];
            $kdsort = $data['kdsort'];
            $najabs = $data['najabs'];
            $najabl = $data['najabl'];
            $eselon = $data['eselon'];
            $job_class1 = $data['job_class1'];
            $job_class2 = $data['job_class2'];
            $kolok_sektoral = $data['kolok_sektoral'];
            $point = $data['point'];
            $tahun = $data['tahun'];
            $aktif = $data['aktif'];
            $tunjab = $data['tunjab'];
            $sementara = $data['sementara'];
            $kdtrans = $data['kdtrans'];
            $transport = $data['transport'];
            $term="LOAD";      
        
        $sql = "INSERT INTO pers_kojab_tbl(kolok,kojab,kdsort,najabs,najabl,eselon,user_id,term,
            tg_upd,job_class1,job_class2,kolok_sektoral,point,tahun,aktif,tunjab,sementara,kdtrans,transport) 
                VALUES ('".$kolok."','".$kojab."','".$kdsort."','".$najabs."','".$najabl."','".$eselon."','".$user['id']."','".$term."', now(),".$job_class1.",
                '".$job_class2."','".$kolok_sektoral."',".$point.",".$tahun.",".$aktif.",,".$tunjab.",".$sementara.",'".$kdtrans."',".$transport.")"; 

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

            $kolok = $data['kolok'];
            $kojab = $data['kojab'];
            $kdsort = $data['kdsort'];
            $najabs = $data['najabs'];
            $najabl = $data['najabl'];
            $eselon = $data['eselon'];
            $job_class1 = ($data['job_class1'] == '' ? 0 : $data['job_class1']);
            $job_class2 = $data['job_class2'];
            $kolok_sektoral = $data['kolok_sektoral'];
            $point = ($data['point'] == '' ? 0 : $data['point']);
            $tahun = ($data['tahun'] == '' ? 0 : $data['tahun']);
            $aktif = ($data['aktif'] == '' ? 0 : $data['aktif']);
            $tunjab = ($data['tunjab'] == '' ? 0 : $data['tunjab']);
            $sementara = ($data['sementara'] == '' ? 0 : $data['sementara']);
            $kdtrans = $data['kdtrans'];
            $transport = ($data['transport'] == '' ? 0 : $data['transport']);
            $term="LOAD";
            $now=date('Y-m-d h:i:s');    
        
        $sql = "UPDATE pers_kojab_tbl SET kdsort = '".$kdsort."',najabs = '".$najabs."', najabl = '".$najabl."',eselon = '".$eselon."',user_id='".$user['id']."',
                term='".$term."', tg_upd =TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'), job_class1 = ".$job_class1.", job_class2 = '".$job_class2."',kolok_sektoral = '".$kolok_sektoral."', 
                point = ".$point.",tahun = ".$tahun.", aktif = ".$aktif.", tunjab = ".$tunjab.", sementara = ".$sementara.", kdtrans = '".$kdtrans."', 
                transport = ".$transport." WHERE KOLOK = '".$kolok."' AND KOJAB ='".$kojab."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id,$id2){
        
        $sql = "DELETE FROM pers_kojab_tbl WHERE kolok = '".$id."' AND kojab = '".$id2."'";

        $id = $this->db->query($sql);
        return $id;
    }

    

}

?>
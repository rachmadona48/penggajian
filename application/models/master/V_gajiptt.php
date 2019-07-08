<?php 

 class V_gajiptt extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
            $this->load->library('session');
    }
    

    function get_data($whereid,$whereid2)
    {

        $sql = "select * from pers_gaji_ptt";        
        $sql .= " WHERE nptt ='".$whereid."'AND thbl ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

      if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];   
              
            $nptt = $data['nptt'];
            $thbl = $data['thbl'];
            $nama = $data['nama'];
            $kodepdidik = $data['kodepdidik'];
            $klogad = $data['klogad'];
            $keahlian = $data['keahlian'];
            $gaji = $data['gaji'];
            $tunjangan = $data['tunjangan'];
            $gajikotor = $data['gajikotor'];
            $pph = $data['pph'];
            $gajibersih = $data['gajibersih'];
            $tgllahir = $data['tgllahir'];
            $spmu = $data['spmu'];
        
        $sql = "INSERT INTO pers_gaji_ptt(nptt,thbl,nama, kodepdidik, klogad, keahlian
                gaji, tunjangan,gajikotor, pph, gajibersih,user_id,tgllahir,spmu,tg_upd) 
                VALUES ('".$nptt."','".$thbl."','".$nama."','".$kodepdidik."',
                '".$klogad."','".$keahlian."','".$gaji."','".$tunjangan."',
                '".$gajikotor."','".$pph."','".$gajibersih."', '".$user['id']."',
                '".$tgllahir."','".$spmu."', now()) ";

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
           
            $nptt = $data['nptt'];
            $thbl = $data['thbl'];
            $nama = $data['nama'];
            $kodepdidik = $data['kodepdidik'];
            $klogad = $data['klogad'];
            $keahlian = $data['keahlian'];
            $gaji = $data['gaji'];
            $tunjangan = $data['tunjangan'];
            $gajikotor = $data['gajikotor'];
            $pph = $data['pph'];
            $gajibersih = $data['gajibersih'];
            $tgllahir = $data['tgllahir'];
            $spmu = $data['spmu'];
        
        $sql = "UPDATE pers_gaji_ptt SET nama = '".$nama."',kodepdidik = '".$kodepdidik."', klogad = '".$klogad."',
        keahlian = '".$keahlian."',gaji = '".$gaji."', tunjangan = '".$tunjangan."', gajikotor = '".$gajikotor."',
        pph = '".$pph."',gajibersih = '".$gajibersih."',user_id = '".$user['id']."',tgllahir = '".$tgllahir."',
        spmu = '".$spmu."',tg_upd = now() WHERE nptt = '".$nptt."' AND thbl = '".$thbl."'";

        $id = $this->db->query($sql);
        return $id;
         }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id,$id2){
        
        $sql = "DELETE FROM pers_gaji_ptt WHERE nptt = '".$id."' AND thbl = '".$id2."'";

        $id = $this->db->query($sql);
        return $id;
    }

    

}

?>
<?php
 class V_listuser extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();

       
    }

    
    function getUserGroupID()
    {
        $q="SELECT \"user_group_id\",\"nama_group\" FROM \"master_user_group\" 
        --WHERE \"user_group_id\" in (1,2) 
        ORDER BY \"nama_group\"";

        $rs = $this->db->query($q)->result();

        return $rs;
    }

    function addUserAccount($data)
    {   
        
        $user_id = $data['user_id'];
        $user_name = $data['user_name'];
        $user_password = md5('123456');
        $user_group = $data['user_group'];
        $user_enable = $data['user_enable'];

        //cek user id sudah digunakan atau belum
        $sqlcek = "SELECT * FROM \"master_user\" WHERE \"user_id\" = '$user_id'";
        //eksekusi query
        $querycek = $this->db->query($sqlcek);
        // 1 jika ada , 0 jika tidak ada
        $num_querycek = $querycek->num_rows();
        
        if($num_querycek == 0)
        {
            $sqlinsert = "INSERT INTO \"master_user\" (\"user_id\",\"user_name\",\"user_password\",\"user_level\",\"user_enable\",\"user_group_id\") VALUES (LOWER('$user_id'),UPPER('$user_name'),'$user_password','9','$user_enable','$user_group')";
            
            $queryinsert  = $this->db->query($sqlinsert);

            if($queryinsert)
            {
                $resp = "1";
            }
            else
            {
                $resp = "0";
            }
        }
        else
        {
            $resp="2";
        }

        $result = array('resp'=>$resp,'id'=>$user_id);
        return $result;

    }

    function updateUserAccount($data)
    {   
        
        $user_id = $data['user_id'];
        $user_name = $data['user_name'];
        $user_password = md5('123456');
        $user_group = $data['user_group'];
        $user_enable = $data['user_enable'];

        //cek user id sudah digunakan atau belum
        $sqlcek = "SELECT * FROM \"master_user\" WHERE \"user_id\" = '$user_id'";
        //eksekusi query
        $querycek = $this->db->query($sqlcek);
        // 1 jika ada , 0 jika tidak ada
        $num_querycek = $querycek->num_rows();
        
        if($num_querycek == 1)
        {
            $sqlupdate = "UPDATE \"master_user\" SET \"user_name\" = UPPER('$user_name'), \"user_enable\" = '$user_enable', \"user_group_id\" = '$user_group' WHERE \"user_id\" = '$user_id'";
            

            
            $queryupdate  = $this->db->query($sqlupdate);

            if($user_group == '1')
            {
                $sqlpeg = "UPDATE PERS_PEGAWAI1 SET NAMA='$user_name' WHERE NRK ='$user_id'";

                $querypeg = $this->db->query($sqlpeg);
            }
            

            if($queryupdate)
            {
                $resp = "1";
            }
            else
            {
                $resp = "0";
            }
        }
        else
        {
            $resp="2";
        }

        $result = array('resp'=>$resp,'id'=>$user_id);
        return $result;

    }
   
    
    function getdataakun($userid)
    {
        //getdata
        $sqlcek = "SELECT \"user_id\",\"user_group_id\",\"user_enable\",\"user_name\" FROM \"master_user\" WHERE \"user_id\" = '$userid'";
        $querycek = $this->db->query($sqlcek);

        if($querycek)
        {
            $result = $querycek->row();
        }
        else
        {
            $result="";
        }
        return $result;

    }

     public function getMasterUserGroup($usergroup=""){
        $sql = "SELECT \"user_group_id\",\"nama_group\" FROM \"master_user_group\" 
        --WHERE \"user_group_id\" in (1,2)
        ";
        
        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($usergroup == $row->user_group_id)
            {
                $option .= "<option selected value='".$row->user_group_id."'>".$row->nama_group."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->user_group_id."'>".$row->nama_group."</option>";
            }
        }
        
        return $option;
    }

     


     function get_pass($nrk){
        $sql = "SELECT *
                FROM \"master_user\"
                WHERE \"user_id\" = '".$nrk."' ";
        return $this->db->query($sql)->row();
     }

     function ubah_password($nrk,$pass_new){
        $sql = "UPDATE \"master_user\" SET \"user_password\" = '".$pass_new."' WHERE \"user_id\" = '".$nrk."' ";
        return $this->db->query($sql);
     }



}

?>
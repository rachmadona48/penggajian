<?php 

 class M_admin extends CI_Model {  

    var $today = '';

    function __construct()
    {        
        parent::__construct();
        $this->today = date('Y-m-d');
    }   

    /*START SETTING MENU*/
    // function getnextvalMenuPostgre(){
    //     $sql = "SELECT nextval('menu_master_id_menu_seq')";
    //     $query = $this->db->query($sql)->row();
    //     return $query->nextval;
    // } 

    function getnextvalMenu(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('menu_master_id_menu_seq')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE menu_master_id_menu_seq";
            $this->db->query($create);

            $sql = "SELECT menu_master_id_menu_seq.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT menu_master_id_menu_seq.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function getnextvalMenuAccess(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('menu_access_id_seq')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE menu_access_id_seq";
            $this->db->query($create);

            $sql = "SELECT menu_master_id_menu_seq.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT menu_master_id_menu_seq.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function getAllMenuAktif()
    {
        $sql = "SELECT * FROM \"menu_master\" WHERE \"status_aktif\" = 'Y' ";
        $query = $this->db->query($sql);
        return $query;
    }

    function getMenu($id)
    {
        $sql = "SELECT * FROM \"menu_master\" WHERE \"id_menu\" = '".$id."' ";
        $query = $this->db->query($sql);
        return $query;
    }    

    function getMenuBaru()
    {        
        $sql = "SELECT * FROM \"menu_master\" WHERE (\"status_aktif\" IS NULL OR \"status_aktif\" = '')";
        $query = $this->db->query($sql);
        return $query->result();
    }    

    function insertMenu($data){
        $id_menu = $this->getnextvalMenu();

        $jenis_menu = $data['jenis_menu'];
        $nama_menu = $data['nama_menu'];
        $link_menu = $data['link_menu'];
        $alias_menu = $data['alias_menu'];
        $input_by = 'ADMIN';
        

        //echo $jenis_menu;
        $sql = "INSERT INTO \"menu_master\"(\"id_menu\",\"nama_menu\",\"link_menu\",\"input_date\", \"input_by\", \"alias\", \"jenis_menu\") 
                VALUES ('".$id_menu."','".$nama_menu."','".$link_menu."', TO_DATE('".$this->today."', 'YYYY-MM-DD HH:MI:SS'), '".$input_by."', '".$alias_menu."',".$jenis_menu.")";
        //echo $sql;
        $id = $this->db->query($sql);
        return $id_menu;
    }

    function updateMenu($data){
        $id_menu = $data['id_menu'];
        $jenis_menu = $data['jenis_menu'];
        $nama_menu = $data['nama_menu'];
        $link_menu = $data['link_menu'];
        $alias_menu = $data['alias_menu'];
        $update_by = 'ADMIN';
        
        $sql = "UPDATE \"menu_master\" SET \"nama_menu\" = '".$nama_menu."', \"link_menu\" = '".$link_menu."', \"jenis_menu\" = ".$jenis_menu.", \"alias\" = '".$alias_menu."', \"update_date\" = TO_DATE('".$this->today."', 'YYYY-MM-DD HH:MI:SS'), \"update_by\" = '".$update_by."' WHERE \"id_menu\" = '".$id_menu."'";
        
        $id = $this->db->query($sql);
        return $id_menu;
    }

    function updatStatusMenu($id_menu,$stat){
        $sql = "UPDATE \"menu_master\" SET  \"status_aktif\" = '".$stat."' WHERE \"id_menu\" = '".$id_menu."'";

        $id = $this->db->query($sql);
        return $id;
    }

    function deleteMenu($data){
        $id_menu = $data['id_menu'];        
        
        $sql = "DELETE FROM \"menu_master\" WHERE \"id_menu\" = '".$id_menu."'";

        $id = $this->db->query($sql);
        return $id;
    }
    /*END SETTING MENU*/

    /*START SETTING LIST MENU*/
    function getListMenu()
    {                
        $sql = "SELECT \"id_list\", \"nama_list\", \"aktif_list\", \"non_aktif_list\" FROM \"menu_list\" WHERE ROWNUM <= 1";        
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insertListMenu($data){        
        
        $aktif_list = $data['aktif_list'];
        $non_aktif_list = $data['non_aktif_list'];
        $input_by = 'ADMIN';
        
        $sql = "INSERT INTO \"menu_list\"(\"aktif_list\",\"non_aktif_list\",\"input_date\", \"input_by\") 
                VALUES ('".$aktif_list."','".$non_aktif_list."', TO_DATE('".$this->today."', 'YYYY-MM-DD HH:MI:SS'), '".$input_by."')";

        $id = $this->db->query($sql);
        return $id_menu;
    }

    function updateListMenu($data){

        //-======= Aktif Menu
        $aktif_list = $data['aktif_list'];
        $aktif_list = str_replace('{"id":1},', '', $aktif_list);
        $aktif_list = str_replace(',{"id":1}', '', $aktif_list);
        //-=======

        //-======= Non Aktif Menu
        $non_aktif_list = $data['non_aktif_list'];
        $non_aktif_list = str_replace('{"id":1},', '', $non_aktif_list);
        $non_aktif_list = str_replace(',{"id":1}', '', $non_aktif_list);
        $nonaktif = json_decode($non_aktif_list);

        $object = new stdClass();
        $array = array('id' => 1);        

        foreach ($array as $key => $value)
        {
            $object->$key = $value;
        }

        array_unshift($nonaktif, $object);
        $non_aktif_list = json_encode($nonaktif);
        //-=======

        //-======= Menu Baru
        $menu_baru = $data['menu_baru'];
        $menu_baru = str_replace('{"id":1},', '', $menu_baru);
        $menu_baru = str_replace(',{"id":1}', '', $menu_baru);
        //-=======

        $update_by = 'ADMIN';
        
        $sql = "UPDATE \"menu_list\" SET \"aktif_list\" = '".$aktif_list."', \"non_aktif_list\" = '".$non_aktif_list."', \"update_date\" = TO_DATE('".$this->today."', 'YYYY-MM-DD HH:MI:SS'), \"update_by\" = '".$update_by."' WHERE \"id_list\" = '1'";

        $itemAktifTemp = json_decode($aktif_list);
        if(count($itemAktifTemp) > 0){
            foreach ($itemAktifTemp as $key => $value) { //menu lvl 1
                $this->updatStatusMenu($value->id,'Y');

                if(isset($value->children)){           
                    foreach ($value->children as $key2 => $value2) { //menu lvl 2
                        $this->updatStatusMenu($value2->id,'Y');

                        if(isset($value2->children)){
                            foreach ($value2->children as $key3 => $value3) { //menu lvl 3
                                $this->updatStatusMenu($value3->id,'Y');

                            }                            
                        }                        
                    }                    
                }                
            }
        }

        $itemNonAktifTemp = json_decode($non_aktif_list);
        if(count($itemNonAktifTemp) > 0){
            foreach ($itemNonAktifTemp as $key => $value) { //menu lvl 1
                $this->updatStatusMenu($value->id,'N');

                if(isset($value->children)){           
                    foreach ($value->children as $key2 => $value2) { //menu lvl 2
                        $this->updatStatusMenu($value2->id,'N');

                        if(isset($value2->children)){
                            foreach ($value2->children as $key3 => $value3) { //menu lvl 3
                                $this->updatStatusMenu($value3->id,'N');

                            }                            
                        }                        
                    }                    
                }                
            }
        }

        $itemMenuBaru = json_decode($menu_baru);
        if(count($itemMenuBaru) > 0){
            foreach ($itemMenuBaru as $key => $value) { //menu lvl 1
                $this->updatStatusMenu($value->id,null);

                if(isset($value->children)){           
                    foreach ($value->children as $key2 => $value2) { //menu lvl 2
                        $this->updatStatusMenu($value2->id,null);

                        if(isset($value2->children)){
                            foreach ($value2->children as $key3 => $value3) { //menu lvl 3
                                $this->updatStatusMenu($value3->id,null);

                            }                            
                        }                        
                    }                    
                }                
            }
        }

        $this->updatStatusMenu(1,'N');

        $id = $this->db->query($sql);
        return $id;
    }
    /*END SETTING LIST MENU*/
    
    function getUserGroups()
    {
        $sql = "SELECT \"user_group_id\", UPPER(\"nama_group\") \"nama_group\" FROM \"master_user_group\" WHERE \"status_aktif\" = 'Y' ";
        
        $query = $this->db->query($sql);
        return $query->result();
    } 

    function getMenuAccess($usergroup)
    {        

        $sql = "SELECT a.\"id_menu\", a.\"nama_menu\", b.\"act_view\", b.\"act_insert\", b.\"act_update\", b.\"act_delete\"
                FROM \"menu_master\" a 
                LEFT OUTER JOIN \"menu_access_user\" b ON a.\"id_menu\" = b.\"menu_id\" AND b.\"user_group_id\" = '".$usergroup."'
                WHERE a.\"status_aktif\" = 'Y' ORDER BY a.\"id_menu\" ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insertMenuAccess($data){
        $usergroup = $data['user'];
        $idmenu = $this->input->post('idmenu');
        $view = $this->input->post('actview');
        $insert = $this->input->post('actinsert');
        $update = $this->input->post('actupdate');
        $delete = $this->input->post('actdelete');
        $input_by = 'ADMIN';

        $sqlDel = "DELETE FROM \"menu_access_user\" WHERE \"user_group_id\" = '".$usergroup."'";
        $queryDel = $this->db->query($sqlDel);

        if($queryDel){

            for ($i=0; $i < count($idmenu); $i++) { 
                $id = $this->getnextvalMenuAccess();

                $menu = isset($idmenu[$i]) ? $idmenu[$i] : '';
                $valVw = isset($view[$idmenu[$i]]) ? $view[$idmenu[$i]] : 'N';
                $valIns = isset($insert[$idmenu[$i]]) ? $insert[$idmenu[$i]] : 'N';
                $valUpd = isset($update[$idmenu[$i]]) ? $update[$idmenu[$i]] : 'N';
                $valDel = isset($delete[$idmenu[$i]]) ? $delete[$idmenu[$i]] : 'N';
                
                $sql = "INSERT INTO \"menu_access_user\"(\"menu_access_id\", \"menu_id\", \"user_group_id\", \"act_view\", \"act_insert\", \"act_update\", \"act_delete\", \"input_by\", \"input_date\") 
                        VALUES ('".$id."', '".$menu."', '".$usergroup."', '".$valVw."', '".$valIns."', '".$valUpd."', '".$valDel."', '".$input_by."', TO_DATE('".$this->today."', 'YYYY-MM-DD HH:MI:SS'))";

                $queryIns = $this->db->query($sql);               
            }            

        }else{
            $queryIns = false;
        }

        return $queryIns;

    }

    function cekPassword($nrk)
    {
        $sql=" SELECT \"user_id\", \"user_password\" FROM \"master_user\" WHERE \"user_id\" = '".$nrk."'";
        $query = $this->db->query($sql)->result();
       
        return $query;
    }

}

?>
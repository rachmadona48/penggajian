<?php 

 class Mhomes extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    private $ci;
    private $ekin;

    function __construct()
    {        
        parent::__construct();

         $this->ci =& get_instance();
        $this->ci->load->database(); 

        
    } 

    function getDataUser($id)
    {
        $sql="SELECT \"user_password\" FROM \"master_user\" WHERE \"user_id\"='".$id."'  ";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function getDataUsers($x)
    {
        $this->db->field_data('master_user');
    }

    function showMenu()
    {
        $sql= " SELECT \"id_menu\", \"nama_menu\",\"link_menu\"
                FROM \"menu_master\" 
                WHERE \"status_aktif\"='Y' AND \"jenis_menu\"=0 
                ORDER BY \"id_menu\" ASC";
        $query = $this->db->query($sql)->result();
       
        return $query;
    }      
    
}

?>
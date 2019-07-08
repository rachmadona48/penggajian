<?php

class Maintenance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('503.php');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('param_cari');
    }

    public function setMode()
    {
        $mode = $_POST['mode'];   

        $q = "UPDATE MAINTENANCE_MODE SET STATUS = '$mode'";
        $rs = $this->db->query($q);
        // Add user data in session
        $session_data = $this->session->userdata('logged_in');

        $session_data['maintenance_mode'] = $mode;

        $this->session->set_userdata("logged_in", $session_data);
        echo $mode;

    }

}
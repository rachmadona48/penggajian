<?php

class Maintenance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mlogin');

        $this->load->library('session');

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
            $this->user['user_password']     = $session_data['user_password'];

            
        }else{
         redirect(base_url().'login', 'refresh');
        }  
    }

    public function index()
    {
        $this->load->view('503.php');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('param_cari');
    }

    public function setMode()
    {
        /*$mode = $_POST['mode'];   

        $q = "UPDATE MAINTENANCE_MODE SET STATUS = '$mode'";
        $rs = $this->db->query($q);
        // Add user data in session
        $session_data = $this->session->userdata('logged_in');

        $session_data['maintenance_mode'] = $mode;

        $this->session->set_userdata("logged_in", $session_data);
        echo $mode;*/


        if($this->user['user_group'] == '2')
        {

            if($this->user['id'] == 'develop' || $this->user['id'] == 'bkd04' || $this->user['id'] == 'batch')
            {
                $post = $this->input->post();


                $m = $this->mlogin->updateMode($post);

                if($m!='-')
                {
                    $session_data = $this->session->userdata('logged_in');
                    $session_data['maintenance_mode'] = $m;
                    $this->session->set_userdata("logged_in", $session_data);    
                    echo json_encode($m);
                }
                else
                {
                    
                     redirect(base_url().'stop', 'refresh');
                }
            }
            else
            {
                
                redirect(base_url().'stop', 'refresh');
            }
            

             
        }
        else
        {
            
            redirect(base_url().'stop', 'refresh');
        }

    }

}
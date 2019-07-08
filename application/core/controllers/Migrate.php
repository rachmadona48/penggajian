<?php

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index()
    {
        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrasi 'sekarang' selesai".PHP_EOL;
        }
    }

    public function cari()
    {
        $files=$this->migration->find_migrations();

        print_r($files);
    }

    public function latest()
    {
        if ($this->migration->latest() === FALSE)
        {
            show_error($this->migration->error_string());
        } else {
            echo "Migrasi 'yg terbaru' selesai".PHP_EOL;
        }
    }

    public function ver($ver)
    {
//        $q = "DELETE FROM \"migrations\"";
//        $this->db->query($q);
//
//        $q = "INSERT INTO \"migrations\" VALUES ($ver)";
//        $this->db->query($q);

        if ($this->migration->version($ver) === FALSE)
        {
            show_error($this->migration->error_string());
        } else {
            echo "Migrasi 'versi' selesai".PHP_EOL;
        }

    }

}
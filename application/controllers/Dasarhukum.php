<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasarhukum extends MY_ControllerSOP {
    public function __construct(){
        parent::__construct();
        parent::loadEverything([
                [1, 2],
                [4, 3]
            ]);
    }

    public function index(){

    }
}
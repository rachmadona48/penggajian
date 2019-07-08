<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Drop_struc_simpegdev extends CI_Migration {

    public function up()
    {
//        $qs[] = "ALTER TABLE PERS_PEGAWAI1
//              DROP COLUMN (
//                KOLOK, KOJAB, TITELDEPAN, SPMU, KD, NOIJAZAH, FLAG
//                )";
        $qs[] = "ALTER TABLE PERS_PEGAWAI1
              DROP (
                NOKONTAK, NMKONTAK
                )";
        $qs[] = "ALTER TABLE PERS_PEGAWAI2
              DROP (
                NOKONTAK2, NMKONTAK2
                )";

        foreach($qs as $q){
            $this->db->query($q);
        }
    }

    public function down()
    {
        //Karena di oracle tidak berfungsi jadi dipindahkan ke versi selanjutnya untuk down()/rollback
    }

}
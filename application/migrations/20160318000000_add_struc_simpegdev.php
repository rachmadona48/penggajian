<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_struc_simpegdev extends CI_Migration {

    public function up()
    {
        //PERS_PEGAWAI1
        $qs[] = "ALTER TABLE PERS_PEGAWAI1
                  ADD (
                    KOLOK char(9),
                    KOJAB char(6),
                    TITELDEPAN varchar2(100),
                    SPMU char(4),
                    KD char(2),
                    NOIJAZAH varchar2(30),
                    FLAG char(1),
                    KKLOGAD char(1) NULL
                  )";

        $qs[] = "ALTER TABLE PERS_PEGAWAI1
                  MODIFY (
                    NAMA varchar2(100),
                    NIP char(9) NULL,
                    TITEL varchar2(100) NULL,
                    KLOGAD char(9) NULL,
                    TERM varchar2(16)
                  )";
        //END PERS_PEGAWAI1

        //PERS_PEGAWAI2
        $qs[] = "ALTER TABLE PERS_PEGAWAI2
                  ADD (
                    EMAIL varchar2(100),
                    NOHP varchar2(13),
                    NOTELP varchar2(25),
                    NOKK varchar2(30),
                    FORPUSAT2 varchar2(100) NULL,
                    FORDAERAH2 varchar2(16) NULL,
                    THFORDRH2 varchar2(16) NULL
                  )";

        $qs[] = "UPDATE 
                  PERS_PEGAWAI2 
                SET 
                  FORPUSAT2=FORPUSAT, 
                  FORDAERAH2=FORDAERAH,
                  THFORDRH2=THFORDRH ";

        $qs[] = "ALTER TABLE PERS_PEGAWAI2
                  MODIFY (                    
                    ALIRAN char(9) NULL,
                    THFORPUS char(9) NULL,                    
                    KARPEG varchar2(16) NULL,
                    TERM varchar2(16),
                    RT char(3) NOT NULL,
                    RW char(3) NOT NULL
                  )";
        $qs[] = "ALTER TABLE PERS_PEGAWAI2
                  DROP (   
                    FORPUSAT,
                    FORDAERAH,
                    THFORDRH
                  )";

        $qs[] = "ALTER TABLE PERS_PEGAWAI2
                  RENAME COLUMN FORPUSAT2 TO FORPUSAT";
        $qs[] = "ALTER TABLE PERS_PEGAWAI2
                  RENAME COLUMN FORDAERAH2 TO FORDAERAH";
        $qs[] = "ALTER TABLE PERS_PEGAWAI2
                  RENAME COLUMN THFORDRH2 TO THFORDRH";
        //END PERS_PEGAWAI2

        //PERS_PEGAWAI3
        $qs[] = "ALTER TABLE PERS_PEGAWAI3
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PEGAWAI3

        //PERS_INDUK_TBL
        $qs[] = "INSERT INTO PERS_INDUK_TBL VALUES ('00','-','PERS','LOAD',TO_DATE('1991-10-31 09:54:56','YYYY-MM-DD HH24:MI:SS'))";
        //PERS_INDUK_TBL

        //PERS_ESELON_TBL
        $qs[] = "ALTER TABLE PERS_ESELON_TBL
                  ADD (
                    NESELON2 char(2) NULL
                  )";

        $qs[] = "ALTER TABLE PERS_ESELON_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_ESELON_TBL

        //PERS_HUBKEL_TBL
        $qs[] = "ALTER TABLE PERS_HUBKEL_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_HUBKEL_TBL

        //PERS_INDUK_TBL
        $qs[] = "ALTER TABLE PERS_INDUK_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_INDUK_TBL

        //PERS_GAPOK_TBL
        $qs[] = "ALTER TABLE PERS_GAPOK_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_GAPOK_TBL

        //PERS_HARGAAN_TBL
        $qs[] = "ALTER TABLE PERS_HARGAAN_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_HARGAAN_TBL

        //PERS_JENHUKDIS_RPT
        $qs[] = "ALTER TABLE PERS_JENHUKDIS_RPT
                  ADD (
                    TMTMULAI_STOPTKD date NULL,
                    TMTAKHIR_STOPTKD date NULL,
                    JMLBLN_STOPTKD number(2) NULL,
                    KET varchar2(30) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_JENHUKDIS_RPT
                  MODIFY (
                    KETERANGAN varchar2(55) NOT NULL
                  )";  
         $qs[] = "UPDATE PERS_JENHUKDIS_RPT
                  SET KETERANGAN = 'DIBERHENTIKAN DG HORMAT TIDAK ATAS PERMINTAAN SENDIRI'
                  WHERE JENHUKDIS=11";               
        //END PERS_JENHUKDIS_RPT

        //PERS_JENRUB_RPT
        $qs[] = "ALTER TABLE PERS_JENRUB_RPT
                  ADD (
                    JENRUB number(2) NOT NULL
                  )";
        //END PERS_JENRUB_RPT

        //PERS_KOCAM_TBL
        $qs[] = "ALTER TABLE PERS_KOCAM_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KOCAM_TBL

        //PERS_KOJAB_TBL
        $qs[] = "ALTER TABLE PERS_KOJAB_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KOJAB_TBL

        //PERS_KOJABF_TBL
        $qs[] = "ALTER TABLE PERS_KOJABF_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KOJABF_TBL

        //PERS_KOKEL_TBL
        $qs[] = "ALTER TABLE PERS_KOKEL_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KOKEL_TBL

        //PERS_KOWIL_TBL
        $qs[] = "ALTER TABLE PERS_KOWIL_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KOWIL_TBL

        //PERS_LOKASI_TBL
        $qs[] = "ALTER TABLE PERS_LOKASI_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_LOKASI_TBL

        //PERS_NEGARA_TBL
        $qs[] = "ALTER TABLE PERS_NEGARA_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_NEGARA_TBL

        //PERS_PANGKAT_TBL
        $qs[] = "ALTER TABLE PERS_PANGKAT_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PANGKAT_TBL

        //PERS_PDIDIKAN_TBL
        $qs[] = "ALTER TABLE PERS_PDIDIKAN_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PDIDIKAN_TBL

        //PERS_TEMA_TBL
        $qs[] = "ALTER TABLE PERS_TEMA_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_TEMA_TBL

        //PERS_UNIVER_TBL
        $qs[] = "ALTER TABLE PERS_UNIVER_TBL
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_UNIVER_TBL

        //RUMPUN_PDK_TBL
        $qs[] = "CREATE TABLE RUMPUN_PDK_TBL
                (
                  KD_RUMPUN number(3) NOT NULL,
                  KET_RUMPUN varchar2(250) NOT NULL,
                  TG_UPD date NOT NULL
                );";
        //END RUMPUN_PDK_TBL

        //SUBRUMPUN_PDK_TBL
        $qs[] = "CREATE TABLE SUBRUMPUN_PDK_TBL
                (
                  KD_RUMPUN number(3) NOT NULL,
                  KD_SUBRUMPUN number(3) NOT NULL,
                  KET_SUBRUMPUN varchar2(250) NOT NULL,
                  TG_UPD date NOT NULL
                );";
        //END SUBRUMPUN_PDK_TBL

        //SUBSUBRUMPUN_PDK_TBL
        $qs[] = "CREATE TABLE SUBSUBRUMPUN_PDK_TBL
                (
                  KD_RUMPUN number(3) NOT NULL,
                  KD_SUBRUMPUN number(3) NOT NULL,
                  KD_SUBSUBRUMPUN number(3) NOT NULL,
                  KET_SUBSUBRUMPUN varchar2(250) NOT NULL,
                  TG_UPD date NOT NULL
                );";
        //END SUBSUBRUMPUN_PDK_TBL

        //PERS_ORGAN_HIST
        $qs[] = "ALTER TABLE PERS_ORGAN_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_ORGAN_HIST

        //PERS_ADMIN_HIST
        $qs[] = "ALTER TABLE PERS_ADMIN_HIST
                  ADD (
                    TMTMULAI_STOPTKP date NULL,
                    TMTAKHIR_STOPTKP date NULL,
                    JMLBLN_STOPTKP number(2) NULL,
                    KET varchar2(30) NULL,
                    TGAKHIR date NULL,
                    TGMULAI date NULL
                  )";

        $qs[] = "ALTER TABLE PERS_ADMIN_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_ADMIN_HIST

        //PERS_CUTI_HIST
        $qs[] = "ALTER TABLE PERS_CUTI_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_CUTI_HIST

        //PERS_DISIPLIN_HIST
        $qs[] = "ALTER TABLE PERS_DISIPLIN_HIST
                  ADD (
                    TMTMULAI_STOPTKP date NULL,
                    TMTAKHIR_STOPTKP date NULL,
                    JMLBLN_STOPTKP number(2) NULL,
                    KET varchar2(30) NULL,
                    STATUS_AKTIF varchar2(30)
                  )";
        $qs[] = "ALTER TABLE PERS_DISIPLIN_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_DISIPLIN_HIST

        //PERS_PANGKAT_HIST
        $qs[] = "ALTER TABLE PERS_PANGKAT_HIST
                  ADD (
                    KLOGAD char(9) NULL,
                    SPMU char(4) NULL,
                    TAHUN_REFGAJI char(4) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_PANGKAT_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PANGKAT_HIST

        //PERS_RB_GAPOK_HIST
        $qs[] = "ALTER TABLE PERS_RB_GAPOK_HIST
                  ADD (
                    KLOGAD char(9) NULL,
                    SPMU char(4) NULL,
                    TAHUN_REFGAJI char(4) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_PANGKAT_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_RB_GAPOK_HIST

        //PERS_JABATAN_HIST
        $qs[] = "ALTER TABLE PERS_JABATAN_HIST
                  ADD (
                    TMTPENSIUN date NULL,
                    SPMU char(4) NULL,
                    KLOGAD char(9) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_JABATAN_HIST
                  MODIFY (
                    TERM varchar2(16),
                    NOSK varchar2(25)
                  )";
        //END PERS_JABATAN_HIST

        //PERS_JABATANF_HIST
        $qs[] = "ALTER TABLE PERS_JABATANF_HIST
                  ADD (
                    TMTPENSIUN date NULL,
                    SPMU char(4) NULL,
                    KLOGAD char(9) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_JABATANF_HIST
                  MODIFY (
                    TERM varchar2(16),
                    NOSK varchar2(25),
                    KREDIT NUMBER(8,3)
                  )";
        //END PERS_JABATANF_HIST

        //PERS_JABATANF_HIST
        $qs[] = "ALTER TABLE PERS_JABATANF_HIST
                  ADD (
                    TMTPENSIUN date NULL,
                    SPMU char(4) NULL,
                    KLOGAD char(9) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_JABATANF_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_JABATANF_HIST

        //PERS_KELUARGA
        $qs[] = "ALTER TABLE PERS_KELUARGA
                  ADD (
                    NOAKTENIKAH varchar2(30) NULL,
                    NOAKTIFSEK varchar2(30) NULL,
                    TGAKTIFSEK date NULL,
                    NOSURATMATI varchar2(30) NULL,
                    TGSURATMATI date NULL,
                    NOAKTECERAI varchar2(30) NULL,
                    TGAKTECERAI date NULL,
                    STAT_APP number(1) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_KELUARGA
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KELUARGA

        //PERS_PENDIDIKAN
        $qs[] = "ALTER TABLE PERS_PENDIDIKAN
                  ADD (
                    TITELBELAKANG varchar2(50) NULL,
                    TITELDEPAN varchar2(50) NULL,
                    STAT_APP number(1) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_PENDIDIKAN
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PENDIDIKAN

        //PERS_PENGHARGAAN
        $qs[] = "ALTER TABLE PERS_PENGHARGAAN
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PENGHARGAAN

        //PERS_DP3
        $qs[] = "ALTER TABLE PERS_DP3
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_DP3

        //PERS_PEMBATASAN
        $qs[] = "ALTER TABLE PERS_PEMBATASAN
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_PEMBATASAN

        //PERS_SEMINAR_HIST
        $qs[] = "ALTER TABLE PERS_SEMINAR_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_SEMINAR_HIST

        //PERS_TULISAN_HIST
        $qs[] = "ALTER TABLE PERS_TULISAN_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_TULISAN_HIST

        //PERS_ALAMAT_HIST
        $qs[] = "ALTER TABLE PERS_ALAMAT_HIST
                  ADD (
                    ALAMAT_KTP varchar2(255) NULL,
                    STAT_APP number(1) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_ALAMAT_HIST
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_ALAMAT_HIST
        //PERS_KESRA
        $qs[] = "ALTER TABLE PERS_KESRA
                  ADD (
                    KLOGAD char(9) NULL,
                    SPMU char(4) NULL
                  )";
        $qs[] = "ALTER TABLE PERS_KESRA
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_KESRA

        //PERS_LITSUS
        $qs[] = "ALTER TABLE PERS_LITSUS
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_LITSUS

        //PERS_MKL_ASSES
        $qs[] = "ALTER TABLE PERS_MKL_ASSES
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_MKL_ASSES

        //PERS_TPA_ASSES
        $qs[] = "ALTER TABLE PERS_TPA_ASSES
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_TPA_ASSES

        //PERS_TP_ASSES
        $qs[] = "ALTER TABLE PERS_TP_ASSES
                  MODIFY (
                    TERM varchar2(16)
                  )";
        //END PERS_TP_ASSES

        //PERS_REF_ATASAN_BAWAHAN
        $qs[] = "ALTER TABLE PERS_REF_ATASAN_BAWAHAN
                  ADD (
                    KOLOK_ATASAN char(9) NULL,
                    KOJAB_ATASAN char(9) NULL,
                    KOLOK_BAWAHAN char(9) NOT NULL,
                    KOJAB_BAWAHAN char(9) NOT NULL
                  )";
        //END PERS_REF_ATASAN_BAWAHAN

        //PERS_STATUS_APPROVAL
        $qs[] = "ALTER TABLE PERS_STATUS_APPROVAL
                  ADD (
                    KD_STATUS number(1) NOT NULL,
                    KET_STATUS varchar2(10) NOT NULL
                  )";
        //END PERS_STATUS_APPROVAL

        //SEQUENCE
        $qs[] = "CREATE SEQUENCE MENU_MASTER_ID_MENU_SEQ
                  MINVALUE 1
                  MAXVALUE 999999999999999999999999999
                  INCREMENT BY 1
                  CACHE 20";
        //SEQUENCE


//        $qs[] = "ALTER TABLE PERS_PEGAWAI1
//                  ADD (
//                    NOKONTAK char(9),
//                    NMKONTAK char(6)
//                  )";
//
//        $qs[] = "ALTER TABLE PERS_PEGAWAI2
//                  ADD (
//                    NOKONTAK2 char(9),
//                    NMKONTAK2 char(6)
//                  )";

        foreach($qs as $q){
            $this->db->query($q);
        }

    }

    public function down()
    {
        $qs[] = "ALTER TABLE PERS_PEGAWAI1
              DROP (
                KOLOK, KOJAB, TITELDEPAN, SPMU, KD, NOIJAZAH, FLAG
                )";

        $qs[] = "ALTER TABLE PERS_PEGAWAI1
                  MODIFY (
                    NIP char(9) NOT NULL,
                    TITEL varchar2(100) NULL,
                    KLOGAD char(9) NOT NULL,
                    TERM char(4) NOT NULL
                  )";

//        $qs[] = "ALTER TABLE PERS_PEGAWAI1
//              DROP (
//                NOKONTAK, NMKONTAK
//                )";
//        $qs[] = "ALTER TABLE PERS_PEGAWAI2
//              DROP (
//                NOKONTAK2, NMKONTAK2
//                )";

        foreach($qs as $q){
            $this->db->query($q);
        }
    }
}
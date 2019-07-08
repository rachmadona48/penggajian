<?php 

 class Mlisting extends CI_Model {

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
        //$this->prod = $this->ci->load->database('ORP1', TRUE);
        //$this->db = $this->ci->load->database('29', TRUE);
    } 

    public function getTahunBerkalaDiskes($thbl="")
    {
        $sql="SELECT DISTINCT(THBL) THBL,TO_CHAR(TO_DATE(THBL,'YYYYMM'),'MONTH YYYY') AS BL_TH 
            FROM PERS_DUK_PANGKAT_HISTDUK WHERE SPMU IN('C030','C031') AND SUBSTR(THBL,0,2)='20' AND SUBSTR(THBL,5,2) IN('01','02','03','04','05','06','07','08','09','10','11','12') ORDER BY THBL DESC";
        // echo $sql;exit();
        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }

    public function getTahunBerkalaDisdik($thbl="")
    {
        $sql="SELECT DISTINCT(THBL) THBL FROM PERS_DUK_PANGKAT_HISTDUK WHERE SPMU IN('C040','C041') AND SUBSTR(THBL,0,2)='20' AND SUBSTR(THBL,5,2) IN('01','02','03','04','05','06','07','08','09','10','11','12') ORDER BY THBL DESC";

        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->THBL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->THBL."</option>";
            }
        }
        
        return $option;       
    }

    //untuk rekap gaji
    public function getTahunBerkalaHistduk($thbl="")
    {
        $sql="SELECT DISTINCT(THBL) THBL ,TO_CHAR(TO_DATE(THBL,'YYYYMM'),'MONTH YYYY') AS BL_TH
            FROM PERS_DUK_PANGKAT_HISTDUK WHERE SUBSTR(THBL,0,2)='20' AND SUBSTR(THBL,5,2) IN('01','02','03','04','05','06','07','08','09','10','11','12') ORDER BY THBL DESC";



        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }
    //untuk rekap gaji
    public function getSpmuFromHistduk($thbl,$user_id,$user_group)
    {
    	//echo 'mlisting gaji '.$user_id.' grp '.$user_group; exit();

    	if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HISTDUK A WHERE THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HISTDUK A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";
    	}

    	//echo $sql; exit();
        
        //$sql="SELECT BKL.SPMU,B.NAMA FROM 
         //       (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HISTDUK A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
         //   INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
         //   ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }


    //untuk tkd guru 108
    public function getTHBLProsesTKDGuru($thbl="")
    {
        /*$sql="SELECT DISTINCT (THBL) THBL FROM PROSES_TKD_GURU
                WHERE SUBSTR (THBL, 0, 2) = '20' AND SUBSTR (THBL, 5, 2) IN ('01','02','03','04','05','06','07','08','09','10','11','12','13','14')
                ORDER BY THBL DESC";*/
        $sql = "SELECT DISTINCT (THBL) THBL,TO_CHAR(TO_DATE(THBL,'YYYYMM'),'MONTH YYYY') AS BL_TH
                FROM PROSES_TKD_GURU
                WHERE THBL IN ('201605','201606','201607','201608','201609','201610','201611','201612')ORDER BY THBL DESC";

        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }

    //untuk tkdguru108 dan tkd22
    public function getSpmuFromTKDGuru($thbl,$user_id,$user_group)
    {
        if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_GURU A WHERE THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_GURU A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";
    	}

        // echo $sql;exit();
        //$sql="SELECT BKL.SPMU,B.NAMA FROM 
         //       (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_GURU A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
         //   INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
         //   ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }

    //untuk tkd guru 22
    public function getTHBLProsesTKDGuru22($thbl="")
    {
        
        $sql = "SELECT DISTINCT
                    (THBL) THBL,TO_CHAR(TO_DATE(THBL,'YYYYMM'),'MONTH YYYY') AS BL_TH
                FROM
                    PROSES_TKD_GURU
                WHERE
                    THBL >= '201703'
                AND SUBSTR (THBL, 5, 2) <= 12
                ORDER BY
                    THBL DESC";

        $query = $this->db ->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }

    //untuk tkd nonguru108
    public function getTHBLProsesTKDNonGuru108($thbl="")
    {
        
        $sql = "SELECT DISTINCT (THBL) THBL,TO_CHAR(TO_DATE(THBL,'YYYYMM'),'MONTH YYYY') AS BL_TH
                FROM PROSES_TKD_TAHAP2
                WHERE THBL >= '201603' AND  SUBSTR(THBL,5,2) IN ('01','02','03','04','05','06','07','08','09','10','11','12') 
                ORDER BY THBL DESC";
        // echo $sql;exit();
        $query = $this->db ->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }

    //untuk tkdnonguru108
    public function getSpmuFromTKDNonGuru108($thbl,$user_id,$user_group)
    {
        if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_TAHAP2 A WHERE THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

            $query = $this->db->query($sql);        

            $option  = "";
            // $option .= "<option selected value=''>-</option>"; 
            foreach($query->result() as $row){
                         
                    $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
                
            }

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_TAHAP2 A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

            $query = $this->db->query($sql);        

            $option  = "";
            $option .= "<option selected value=''>-</option>"; 
            foreach($query->result() as $row){
                         
                    $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
                
            }
    	}
        // echo $sql
        
        //$sql="SELECT BKL.SPMU,B.NAMA FROM 
            //    (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_TAHAP2 A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
           // INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
           // ";

        // $query = $this->db->query($sql);        

        // $option  = "";
        // $option .= "<option selected value=''>-</option>"; 
        // foreach($query->result() as $row){
                     
        //         $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        // }
        
        return $option;       
    }

    //untuk listing pph
    public function getTHBLListingPPH($thbl="")
    {
        
        $sql = "SELECT DISTINCT (THBL) THBL,
                TO_CHAR (
                    TO_DATE (THBL, 'YYYYMM'),
                    'MONTH YYYY'
                ) AS BL_TH 
                FROM PERS_DUK_PANGKAT_HIST_PPH 
                WHERE SUBSTR(THBL,5, 2) IN (
                    '01',
                    '02',
                    '03',
                    '04',
                    '05',
                    '06',
                    '07',
                    '08',
                    '09',
                    '10',
                    '11',
                    '12'
                )
                ORDER BY THBL DESC";

        $query = $this->db ->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }

    //untuk listing pph
    public function getSpmuFromListingPPH($thbl,$user_id,$user_group)
    {
        if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HIST_PPH A WHERE THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HIST_PPH A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";
    	}
    
        
        //$sql="SELECT BKL.SPMU,B.NAMA FROM 
           //     (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HIST_PPH A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
           // INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
           // ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }

    //untuk listing transport
    public function getTHBLListingTransport($thbl="")
    {
        
        $sql = "SELECT DISTINCT (THBL) THBL,
                TO_CHAR (
                    TO_DATE (THBL, 'YYYYMM'),
                    'MONTH YYYY'
                ) AS BL_TH
                FROM PERS_DUK_PANGKAT_TRANSPORT 
                WHERE SUBSTR(THBL,5,2) IN ('01','02','03','04','05','06','07','08','09','10','11','12') and UPLOAD IN('1')
                ORDER BY THBL DESC";

        $query = $this->db ->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }

	//untuk listing TKD plt (gabungan)
    public function getTHBLListingTTKDPLT($thbl="")
    {
        
        $sql = "SELECT DISTINCT
                    (thbl),
                    TO_CHAR (
                        TO_DATE (THBL, 'YYYYMM'),
                        'MONTH YYYY'
                    ) AS BL_TH
                FROM
                    proses_tkd_plt
                WHERE
                    upload IN ('1', '9')
                AND SUBSTR(THBL,5, 2) IN (
                    '01',
                    '02',
                    '03',
                    '04',
                    '05',
                    '06',
                    '07',
                    '08',
                    '09',
                    '10',
                    '11',
                    '12'
                )
                ORDER BY
                    thbl DESC";

        $query = $this->db ->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
        }
        
        return $option;       
    }
	
	//untuk tampilan THBL Gaji PTT (gabungan)
    public function getTHBLListinggajiptt($thbl="")
    {
        
        $sql = "
                SELECT DISTINCT
                    (thbl),
                    TO_CHAR (
                        TO_DATE (THBL, 'YYYYMM'),
                        'MONTH YYYY'
                    ) AS BL_TH
                FROM
                    pers_gaji_ptt
                WHERE
                    upload IN ('1', '9')
                AND SUBSTR(THBL,5, 2) IN (
                    '01',
                    '02',
                    '03',
                    '04',
                    '05',
                    '06',
                    '07',
                    '08',
                    '09',
                    '10',
                    '11',
                    '12'
                )
                ORDER BY
                    thbl DESC";

        $query = $this->db ->query($sql);      
        $option  = "";
        
        foreach($query->result() as $row){
			
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
			
			
        }
        return $option;       
    }
	
	//untuk listing Gaji PTT
	public function getSpmuFromgajiptt($thbl,$user_id,$user_group)
    {
	
        if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

      		
			$sql="SELECT BKL.SPMU,B.NAMA FROM (SELECT DISTINCT(SPMU) SPMU FROM  PERS_GAJI_PTT A WHERE  THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL 
					INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC 
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM (SELECT DISTINCT(SPMU) SPMU FROM PERS_GAJI_PTT A WHERE  THBL='".$thbl."' ORDER BY SPMU ASC) BKL 
					INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC 
            ";
    	}
    
        
        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }
	
	//untuk tampilan THBL TPP PTT (Listing)
    public function getTHBLListingtppptt($thbl="")
    {
        
        $sql = "SELECT DISTINCT
                    (thbl),
                    TO_CHAR (
                        TO_DATE (THBL, 'YYYYMM'),
                        'MONTH YYYY'
                    ) AS BL_TH
                FROM
                    pers_tpp_ptt
                WHERE
                    upload IN ('1', '9')
                AND SUBSTR(THBL,5, 2) IN (
                    '01',
                    '02',
                    '03',
                    '04',
                    '05',
                    '06',
                    '07',
                    '08',
                    '09',
                    '10',
                    '11',
                    '12'
                )
                ORDER BY
                    thbl DESC";

        $query = $this->db ->query($sql);      
        $option  = "";
        
        foreach($query->result() as $row){
			
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->BL_TH."</option>";
            }
			
		
        }
        return $option;       
    }
	
	//untuk tampilan THBL TPP PTT (Rekap)
	public function getSpmuFromtppptt($thbl,$user_id,$user_group)
    {
	
        if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

      		
			$sql="SELECT BKL.SPMU,B.NAMA FROM (SELECT DISTINCT(SPMU) SPMU FROM  PERS_TPP_PTT A WHERE  THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL 
					INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC 
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM (SELECT DISTINCT(SPMU) SPMU FROM PERS_TPP_PTT A WHERE  THBL='".$thbl."' ORDER BY SPMU ASC) BKL 
					INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC 
            ";
    	}
    
        
        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }
	
	//untuk Rekap TKD plt (gabungan)
    public function getTHBLRekapTKDPLT($thbl="")
    {
        
        $sql = "select distinct(thbl) from proses_tkd_plt where upload in ('1','9') order by thbl desc";

        $query = $this->db ->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->THBL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->THBL."</option>";
            }
        }
        
        return $option;       
    }
	
	
	
    //untuk listing transport
    public function getSpmuFromListingTransport($thbl,$user_id,$user_group)
    {
        if($user_group == 52){
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
    		//echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

    		// $sql="SELECT BKL.SPMU,B.NAMA FROM 
      //           (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HIST_PPH A WHERE THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL
      //       INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
      //       ";

            $sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HIST_PPH A WHERE THBL='".$thbl."' AND SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM 
                (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_TRANSPORT A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
            INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";
    	}
    
        
        //$sql="SELECT BKL.SPMU,B.NAMA FROM 
          //      (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_TRANSPORT A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
         //   INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
          //  ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }
	
	//untuk listing TKD plt
    public function getSpmuFromtkdplt($thbl,$user_id,$spmp,$user_group)
    {
	   // echo $user_group; exit();
        if($user_group == 52){
            // echo substr($user_id,-8);
    		// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
            $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";

    		// echo $cek_spmu; exit();
    		$query_cek = $this->db->query($cek_spmu)->row(); 

    		//echo $query_cek->KODE_SPM; exit();

      		
			$sql="SELECT BKL.SPMU,B.NAMA FROM (SELECT DISTINCT(SPMU) SPMU FROM  PROSES_TKD_PLT A WHERE SPMU = '".$query_cek->KODE_SPM."' ORDER BY SPMU ASC) BKL 
					INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC 
            ";

    	}else{
    		$sql="SELECT BKL.SPMU,B.NAMA FROM (SELECT DISTINCT(SPMU) SPMU FROM PROSES_TKD_PLT A  ORDER BY SPMU ASC) BKL 
					INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC 
            ";
    	}
    
        // echo $sql;exit();
        //$sql="SELECT BKL.SPMU,B.NAMA FROM 
          //      (SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_TRANSPORT A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
         //   INNER JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
          //  ";
        //echo $user_group.'LLL  '.$sql; exit();
		
        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }
	
	

    function queryBatchingGajiPerPegawai($nrk,$thbl)
    {
        $sql=   "SELECT
                (   CASE SUBSTR (A.THBL, 5, 2)
                    WHEN '01' THEN
                        'JANUARI'
                    WHEN '02' THEN
                        'FEBRUARI'
                    WHEN '03' THEN
                        'MARET'
                    WHEN '04' THEN
                        'APRIL'
                    WHEN '05' THEN
                        'MEI'
                    WHEN '06' THEN
                        'JUNI'
                    WHEN '07' THEN
                        'JULI'
                    WHEN '08' THEN
                        'AGUSTUS'
                    WHEN '09' THEN
                        'SEPTEMBER'
                    WHEN '10' THEN
                        'OKTOBER'
                    WHEN '11' THEN
                        'NOVEMBER'
                    WHEN '12' THEN
                        'DESEMBER'
                    END
                ) AS BULAN,A.THBL,
                SUBSTR (A.THBL, 1, 4) AS TAHUN,A.KLOGAD,C.NALOKL AS NAKLOGAD,A .SPMU AS SPMU,B.NAMA NAMASPM,A .NAMA AS NAMA_PEG,TO_CHAR (A.TALHIR, 'DD-MM-YYYY') AS TALHIR,A.NIP18,A.NRK,
                CASE WHEN STAPEG = 1 THEN 'CPNS' ELSE 'PNS' END AS STAPEG,
                A.KOJAB,E.GOL,E.NAPANG,
                CASE WHEN STAWIN IN (1, 2, 3, 4) THEN 1 ELSE 0 END AS STAWIN,
                JUAN, JIWA, GAPOK, NTISTRI, NTANAK, NTUNLAI, TUNJAB, TUNFUNG, NPBULAT, NTBERAS, NTPPHGAJI, NJUMKOT, NPBERAS, NTASPEN, NTHT, NASKES,
                NVL (NTASPEN, 0) + NVL (NTHT, 0) + NVL (NASKES, 0) AS IURANWJB,
                    NPPHGAJI, NPTLAIN, NJUMPOTGAJI, NJUMBERGAJI
                FROM
                    PERS_DUK_PANGKAT_HISTDUK A
                LEFT JOIN pers_tabel_spmu B ON A .SPMU = B.KODE_SPM
                LEFT JOIN pers_lokasi_tbl C ON A .KLOGAD = C.KOLOK
                LEFT JOIN PERS_ESELON_TBL D ON NVL (A .ESELON, '  ') = D .ESELON
                LEFT JOIN PERS_PANGKAT_TBL_NOW E ON A .GOL = E .KOPANG
                LEFT JOIN pers_lokasi_tbl F ON A .KOLOK = C.KOLOK
                WHERE
                    THBL = '".$thbl."' AND NRK = '".$nrk."'
                ORDER BY spmu, klogad ASC, stapeg DESC, D .CETAKAN, gol DESC, A .KODIKF, nrk ASC";

        $result = $this->db->query($sql)->row();
        return $result;
    }

    public function cek_kode_spmu($user_id){
    	// $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".$user_id."' ";
        $cek_spmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD = '".substr($user_id,-8)."' ";
        // echo $cek_spmu;exit();
		$query_cek = $this->db->query($cek_spmu)->row(); 
		return $query_cek;
    }
}

?>

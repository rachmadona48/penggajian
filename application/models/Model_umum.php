<?php
/**
* 
*/
class Model_umum extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function QuerySingleValue($tquery)
    {                
        $query = $this->db->query($tquery);
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)                      
            return $row;
        }
        else
            return  NULL;
    } 

	public function QueryMultiValue($tquery)
    {           
        $query = $this->db->query($tquery);
            
        if ($query->num_rows() > 0)     
                return $query->result();                
        else 
                return array(); 
    }

    
}

?>
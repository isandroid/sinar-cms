<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library_kelas {

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	# ============== INFORMASI ============== 

	public function info($parameter)
	{
		/*
		* $parameter :
		*    "sukses" 
		*    "info"
		*    "peringatan"
		*    "bahaya"
		*/
		
		if($parameter == "sukses")
		{
			return "alert alert-success";
		}
		
		elseif ($parameter == "info") 
		{
			return "alert alert-info";
		}

		elseif ($parameter == "peringatan") 
		{
			return "alert alert-warning";
		}

		elseif ($parameter == "bahaya") 
		{
			return "alert alert-danger";
		}
	}

}
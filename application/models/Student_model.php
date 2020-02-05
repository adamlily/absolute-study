<?php 





class Student_model extends CI_Model

{

	

	function __construct()

	{

		parent::__construct();

		$this->userTable = 'users';
		

	}

/**
	 * Function to get Student List 
	 */ 

public function getStudentList()
{ 
	
	$this->db->select("*");
	$this->db->from('users');
	$this->db->where('role_id',2 );
	$this->db->where('is_active',1 );
	$query = $this->db->get();
	$result = $query->result_array();
		// echo '<pre>';
		// print_r($result);
	return $result;
}



}
?>
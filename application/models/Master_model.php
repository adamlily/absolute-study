<?php 
/**
 * Class Name 	: Master
 * Author Name 	: Amit Chaurasiya
 * Date 		: 08/07/2019
 */
class Master_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->sectorTbl = 'sectors';
		$this->jobRoleTbl = 'job_roles';
		$this->sectionTbl = 'sections';
		$this->boardTbl = 'board';
		$this->classTbl = 'classes';
		$this->SubjectTbl = 'subjects';
		$this->UnitTbl = 'unit';
		$this->ChapterTbl = 'chapters';
		$this->QuestionsTbl = 'questions';
	}
	/*
     * get rows from the sectors table
     */
	function getSectorDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->sectorTbl);
        //fetch data by conditions
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(array_key_exists("id",$params)){
			$this->db->where('id',$params['id']);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
            //set start and limit
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}
			$query = $this->db->get();
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $query->num_rows();
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				$result = ($query->num_rows() > 0)?$query->row_array():FALSE;
			}else{
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
			}
		}
		
        //return fetched data
		return $result;
	}


	function  getBoardDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->boardTbl);
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;

	}

	function  getClassDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->classTbl);
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				
				$this->db->where($key,$value);
				
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		// echo '<pre>';print_r($result);exit;
		return $result;

	}


	function  getSubjectDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->SubjectTbl);
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				
				$this->db->where($key,$value);
				
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		// echo '<pre>';print_r($result);exit;
		return $result;

	}
	function  getUnitDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->UnitTbl);
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		// echo '<pre>';print_r($result);exit;
		return $result;

	}
	function  getChapterDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->ChapterTbl);
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				
				$this->db->where($key,$value);
				
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		// echo '<pre>';print_r($result);exit;
		return $result;

	}

	function  getQuestionDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->QuestionsTbl);
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				foreach ($value as $k => $val) {
					$this->db->where($k,$val);
				}
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		// echo '<pre>';print_r($result);exit;
		return $result;

	}
	/*
     * get rows from the job_roles table
     */
	function getJobRoleDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->jobRoleTbl);
        //fetch data by conditions
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(array_key_exists("id",$params)){
			$this->db->where('id',$params['id']);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
            //set start and limit
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}
			$query = $this->db->get();
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $query->num_rows();
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				$result = ($query->num_rows() > 0)?$query->row_array():FALSE;
			}else{
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
			}
		}
        //return fetched data
		return $result;
	}
	/*
     * get rows from the sections table
     */
	function getSectionDetails($params = array()){
		$this->db->select('*');
		$this->db->from($this->sectionTbl);
        //fetch data by conditions
		if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(array_key_exists("id",$params)){
			$this->db->where('id',$params['id']);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
            //set start and limit
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}
			$query = $this->db->get();
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $query->num_rows();
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				$result = ($query->num_rows() > 0)?$query->row_array():FALSE;
			}else{
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
			}
		}
        //return fetched data
		return $result;
	}
     /*
     * Function checks the duplicate data i.e. if entered data exists or not
     */
     public function checkDuplicateData($params = array()){
     	$this->db->select('*');
     	$this->db->from($params['table_name']);
     	if (array_key_exists('column_names', $params)) {
     		foreach ($params['column_names'] as $key => $column_name) {
     			$this->db->where($key, $column_name);
     		}
     	}
     	if (array_key_exists('conditions', $params)) {
     		foreach ($params['conditions'] as $key => $value) {
     			$this->db->where($key,$value);
     		}
     	}
     	$query = $this->db->get();
     	return $query->row_array();
     }
 }
 ?>
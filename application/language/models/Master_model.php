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

		$this->courseTbl = 'courses';

		$this->subjectTbl = 'subjects';

		$this->topicTbl = 'topics';

	}



	/*

     * get rows from the courses table

     */

	function getCourseDetails($params = array()){

		$this->db->select('*');

		$this->db->from($this->courseTbl);

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

     * get rows from the subjects table

     */

	function getSubjectDetails($params = array()){

		$this->db->select('*');

		$this->db->from($this->subjectTbl);

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

     * get rows from the topics table

     */

	function getTopicDetails($params = array()){

		$this->db->select('*');

		$this->db->from($this->topicTbl);

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

     public function checkDuplicateData($params = array())

     {

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
<?php 



/**

 * Class Name 	: Quiz_model

 * Author Name 	: Amit Chaurasiya

 * Date 		: 09/07/2019

 */

class Quiz_model extends CI_Model

{

	

	function __construct()

	{

		parent::__construct();

		$this->questionTable = 'questions';
		$this->quizTable = 'quizs';

	}


	/*

     * get rows from the courses table

     */

	function getQuestionsDetails($params = array()){

		$this->db->select('*');

		$this->db->from($this->questionTable);

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

     * Get rows from the quizs table

     */

	function getQuizDetails($params = array()){

		$this->db->select('*');

		$this->db->from($this->quizTable);

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

	/**
	 * Function to get quiz details and questions related to quiz 
	 * @param quiz_id
	 */ 
	public function getAttemptQuizList($params)
	{
		$this->db->select('quiz_allocated.quiz_id,quiz_allocated.quiz_name,quiz_allocated.is_active,quizs.course_name,quizs.subject_name');
		$this->db->from('quiz_allocated');
		$this->db->join('quizs', 'quizs.id = quiz_allocated.quiz_id', 'left');

		
		if (array_key_exists('conditions', $params)) {
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where('quiz_allocated.'.$key, $value);
			}
		}
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}
	/**
	 * Function to get quiz details and questions related to quiz 
	 * @param quiz_id
	 */ 
	public function getQuizDetailsByQuizId($quiz_id)
	{
		$this->db->select("q.*, qq.question, qq.question_number, qq.option_a, qq.option_b, qq.option_c, qq.option_d");
		$this->db->from('quizs q');
		$this->db->where('md5(q.id)', $quiz_id);
		$this->db->join('quiz_questions qq', 'qq.quiz_id = q.id', 'left');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	/**
	 * Function to get quiz question details 
	 * @param quiz_id, question_number
	 */ 
	public function getQuizQuestionsDetails($quiz_id, $question_number)
	{
		$this->db->select("*");
		$this->db->from('quiz_questions');
		$this->db->where('quiz_id', $quiz_id);
		$this->db->where('question_number', $question_number);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	/**
	 * Function to get quiz question details 
	 * @param quiz_id, question_number
	 */ 
	public function getSubmittedQuizList($user_id)
	{
		$this->db->select("quiz_submitted.*,users.name");
		$this->db->from('quiz_submitted');
		$this->db->where('quiz_id', $user_id);
		$this->db->join('users', 'users.id = quiz_submitted.submitted_by ', 'left');
		// $this->db->where('is_submitted', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	/**
	 * Function to get Quiz result 
	 * @param submitted_quiz_id, 
	 */ 
	public function getQuizResult($submitted_quiz_id)
	{
		$this->db->select("*");
		$this->db->from('quiz_submitted_answers');
		$this->db->where('md5(quiz_submitted_id)', $submitted_quiz_id);
		$query = $this->db->get();
		$result = $query->result_array();
		echo '<pre>';
		print_r($result);
		return $result;
	}

}




?>
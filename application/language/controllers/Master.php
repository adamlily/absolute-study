<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

/**

 * Class Name 	: Master 

 * Date 		: 08/07/2019

 * Author Name 	: Amit Chaurasiya

 */

class Master extends CI_Controller

{

	

	function __construct()

	{

		parent::__construct();

		if (!$this->session->userdata('isUserLoggedIn')) {

			return redirect('user-login');

		}

		$this->data['username'] = $this->session->userdata('userName');

		$this->data['user_id'] = $this->session->userdata('userId');

		$this->data['user_profile_image'] = $this->session->userdata('user_image');

		$this->data['role'] = $this->session->userdata('role');

		$this->data['role_id'] = $this->session->userdata('role_id');

		$this->load->model('master_model','master');

	}



	/*

	 * Function to view courses 

	 */

	public function courseList()

	{

		$con['conditions'] = array('is_active' => '1');

		$viewData['courseList'] = $this->master->getCourseDetails($con);

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/master/course-list', $viewData);

		$this->load->view('/layout/footer');

	}

	/*

	 * Function to add new course

	 */

	public function addNewCourse()

	{

		$response = array();

		// $submitData = $this->input->post('submitCourseForm');

		$course_name = $this->input->post('course_name');

		// if (isset($submitData)) {

		if (empty($course_name) || $course_name === "") {

			$response['flag'] = false;

			$response['message'] = "Please enter course name.";

		} else {

			$con = array(

				'table_name' => 'courses',

				'column_names' => array(

					'course_name' => $course_name

				),

				'conditions' => array(

					'is_expired' => '0' 

				)

			);

			$checkDuplicateData = $this->master->checkDuplicateData($con);

			if ($checkDuplicateData) {

				$response['flag'] = false;

				$response['message'] = "Entered course name already exists.";

			} else {

				$insertData = array();

				$insertData['course_name'] = trim($course_name);

				$insertData['created_at'] = date('Y-m-d H:i:s');

				$this->db->insert('courses', $insertData);

				$response['flag'] = true;

				$response['message'] = "Course name added successfully."; 

			}

		}

		// } else {

		// 	$response['flag'] = false;

		// 	$response['message'] = "Something went wrong. Please try again.";

		// }

		echo json_encode($response);

		exit;

	}

	/*

	 * Function to view courses 

	 */

	public function subjectList()

	{

		$con['conditions'] = array('is_active' => '1');

		$viewData['subjectList'] = $this->master->getSubjectDetails($con);

		$viewData['courseList'] = $this->master->getCourseDetails($con);

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/master/subject-list', $viewData);

		$this->load->view('/layout/footer');

	}

	public function addNewSubject()

	{

		$response = array();

		// $submitData = $this->input->post('submitCourseForm');

		$course_data 	= explode('-', $this->input->post('course_name'));

		$subject_name 	= $this->input->post('subject_name');

		// if (isset($submitData)) {

		if (empty($course_data[0]) || $course_data[0] === "") {

			$response['flag'] = false;

			$response['input'] = "course";

			$response['message'] = "Please select course name.";

		} else if (empty($subject_name) || $subject_name === "") {

			$response['flag'] = false;

			$response['input'] = "subject";

			$response['message'] = "Please enter subject name.";

		} else {

			$con = array(

				'table_name' => 'subjects',

				'column_names' => array(

					'subject_name' => $subject_name,

					'course_name' => $course_data[1]

				),

				'conditions' => array(

					'is_active' => '1' 

				)

			);

			$checkDuplicateData = $this->master->checkDuplicateData($con);

			if ($checkDuplicateData) {

				$response['flag'] = false;

				$response['input'] = "duplicate";

				$response['message'] = "Entered course and subject already exists.";

			} else {

				$insertData = array();

				$insertData['course_id'] = trim($course_data[0]);

				$insertData['course_name'] = trim($course_data[1]);

				$insertData['subject_name'] = trim($subject_name);

				$insertData['created_at'] = date('Y-m-d H:i:s');

				$this->db->insert('subjects', $insertData);

				$response['flag'] = true;

				$response['message'] = "Subject name added successfully."; 

			}

		}

		// } else {

		// 	$response['flag'] = false;

		// 	$response['message'] = "Something went wrong. Please try again.";

		// }

		echo json_encode($response);

		exit;

	}

	/*

	 * Function to view courses 

	 */

	public function topicList()

	{

		$con['conditions'] = array('is_active' => '1');

		$viewData['topicList'] = $this->master->getTopicDetails($con);

		$viewData['courseList'] = $this->master->getCourseDetails($con);

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/master/topic-list', $viewData);

		$this->load->view('/layout/footer');

	}

	public function addNewTopic()

	{

		$response = array();

		// $submitData = $this->input->post('submitCourseForm');

		$course_data 	= explode('-', $this->input->post('course_name'));

		$subject_data 	= explode('-', $this->input->post('subject_name'));

		$topic_name 	= $this->input->post('topic_name');

		// if (isset($submitData)) {

		if (empty($course_data[0]) || $course_data[0] === "") {

			$response['flag'] = false;

			$response['input'] = "course";

			$response['message'] = "Please select course name.";

		} else if (empty($subject_data[0]) || $subject_data[0] === "") {

			$response['flag'] = false;

			$response['input'] = "subject";

			$response['message'] = "Please enter subject name.";

		} else if (empty($topic_name) || $topic_name === "") {

			$response['flag'] = false;

			$response['input'] = "topic";

			$response['message'] = "Please enter topic name.";

		} else {

			$con = array(

				'table_name' => 'topics',

				'column_names' => array(

					'subject_name' => $subject_data[1],

					'course_name' => $course_data[1],

					'topic_name'  => $topic_name

				),

				'conditions' => array(

					'is_active' => '1' 

				)

			);

			$checkDuplicateData = $this->master->checkDuplicateData($con);

			if ($checkDuplicateData) {

				$response['flag'] = false;

				$response['input'] = "duplicate";

				$response['message'] = "Entered detials already exist.";

			} else {

				$insertData = array();

				$insertData['course_id'] 	= trim($course_data[0]);

				$insertData['course_name'] 	= trim($course_data[1]);

				$insertData['subject_id'] 	= trim($subject_data[0]);

				$insertData['subject_name'] = trim($subject_data[1]);

				$insertData['topic_name'] 	= trim($topic_name);

				$insertData['created_at'] 	= date('Y-m-d H:i:s');

				$this->db->insert('topics', $insertData);

				$response['flag'] = true;

				$response['message'] = "Topic added successfully."; 

			}

		}

		// } else {

		// 	$response['flag'] = false;

		// 	$response['message'] = "Something went wrong. Please try again.";

		// }

		echo json_encode($response);

		exit;

	}

}



?>
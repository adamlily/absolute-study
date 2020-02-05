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
		$this->load->helper('url');
	}
	/*
	 * Function to view courses 
	 */
	public function sectorList()
	{
		$con['conditions'] = array('is_active' => '1');
		$viewData['sectorList'] = $this->master->getSectorDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/sector-list', $viewData);
		$this->load->view('/layout/footer');
	}

	public function boardList()
	{
		$con['conditions'] = array('status' => '1');
		$viewData['BoardList'] = $this->master->getBoardDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/board-list', $viewData);
		$this->load->view('/layout/footer');
	}

	public function classList()
	{
		$con = $conn =array();
		$board_id= $this->input->get('board_name');
		if(isset($board_id)){
			$viewData['board_id'] = $board_id;	
			$con['conditions'] = array('1board_id' => $board_id,'status' => '1');
		}
		$con['conditions'] = array('status' => '1');
		$conn['conditions'] = array('status' => '1');
		$viewData['classList'] = $this->master->getClassDetails($con);
		$viewData['BoardList'] = $this->master->getBoardDetails($conn);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/class-list', $viewData);
		$this->load->view('/layout/footer');
	}

	public function subjectList()
	{
		$con = $conn =array();
		$class_id = $this->input->get('class_id');
		if(isset($class_id)){
			$viewData['class_id'] = $class_id;	
			$con['conditions'] = array('id' => $class_id,'status'=>'1');
		}else{
			$con['conditions'] = array('status' => '1');
		}
		$conn['conditions'] = array('status' => '1');
		$viewData['classList'] = $this->master->getClassDetails($con);
		$viewData['BoardList'] = $this->master->getBoardDetails($conn);
		$viewData['subjectList'] = $this->master->getSubjectDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/subject-list', $viewData);
		$this->load->view('/layout/footer');
	}

	public function UnitList()
	{
		$con = $conn =array();
		$conn['conditions'] = array('status' => '1');
		$viewData['classList'] = $this->master->getClassDetails($con);
		$viewData['BoardList'] = $this->master->getBoardDetails($conn);
		$viewData['subjectList'] = $this->master->getSubjectDetails($con);
		$viewData['unitList'] = $this->master->getUnitDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/unit-list', $viewData);
		$this->load->view('/layout/footer');
	}


	public function chapterList()
	{
		$con = $conn =array();
		$conn['conditions'] = array('status' => '1');
		$viewData['classList'] = $this->master->getClassDetails($con);
		$viewData['BoardList'] = $this->master->getBoardDetails($conn);
		$viewData['subjectList'] = $this->master->getSubjectDetails($con);
		$viewData['unitList'] = $this->master->getUnitDetails($con);
		$viewData['chapterList'] = $this->master->getChapterDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/chapter-list', $viewData);
		$this->load->view('/layout/footer');
	}

	/*
	 * Function to add new sector
	 */
	public function addNewSector()
	{
		$response = array();
		// $submitData = $this->input->post('submitCourseForm');
		$sector_name = $this->input->post('sector_name');
		// if (isset($submitData)) {
		if (empty($sector_name) || $sector_name === "") {
			$response['flag'] = false;
			$response['message'] = "Please enter course name.";
		} else {
			$con = array(
				'table_name' => 'sectors',
				'column_names' => array(
					'sector_name' => $sector_name
				),
				'conditions' => array(
					'is_expired' => '0' 
				)
			);
			$checkDuplicateData = $this->master->checkDuplicateData($con);
			if ($checkDuplicateData) {
				$response['flag'] = false;
				$response['message'] = "Entered Sector name already exists.";
			} else {
				$insertData = array();
				$insertData['sector_name'] = trim($sector_name);
				$insertData['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('sectors', $insertData);
				$response['flag'] = true;
				$response['message'] = "Sector name added successfully."; 
			}
		}
		// } else {
		// 	$response['flag'] = false;
		// 	$response['message'] = "Something went wrong. Please try again.";
		// }
		echo json_encode($response);
		exit;
	}


	public function addBoard()
	{
		$response = array();
		$board_name = $this->input->post('board_name');
		$board_id = $this->input->post('board_id');
		if (empty($board_name) || $board_name === "") {
			$response['flag'] = false;
			$response['message'] = "Please enter board name.";
		} else {
			if($board_id != ''){
				$con['conditions']['id']= $board_id;
				$con['conditions']['status']= '1';
				// $con['column_names']['board']= $board_name;
				$con['table_name']= 'board';
			}else{
				$con = array(
					'table_name' => 'board',
					'column_names' => array(
						'board' => $board_name
					),
					'conditions' => array(
						'status' => '1' ,
					)
				);
			}
			$checkDuplicateData = $this->master->checkDuplicateData($con);
			if ($checkDuplicateData) {
				$updateData = array();
				if($board_name != ""){
					$updateData['board'] = trim($board_name);
					$updateData['created_at'] = date('Y-m-d H:i:s');
					$this->db->where('id',$board_id);
					$this->db->update('board', $updateData);
					$response['flag'] = true;
					$response['message'] = "Board name Updated successfully."; 
				}else{
					$response['flag'] = true;
					$response['message'] = "Entered board Name already exits"; 
				}
			} else {
				$insertData = array();
				$insertData['board'] = trim($board_name);
				$insertData['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('board', $insertData);
				$response['flag'] = true;
				$response['message'] = "Board name added successfully."; 
			}
		}
		echo json_encode($response);
		exit;
	}

	public function addClassList()
	{
		$response = array();
		$board_name = $this->input->post('board_name');
		$class_name = $this->input->post('class_name');
		$class_id = $this->input->post('class_id');
		if (empty($board_name) || $board_name === "") {
			$response['flag'] = false;
			$response['message'] = "Please select board name.";
		}elseif(empty($class_name) || $class_name === ""){
			$response['flag'] = false;
			$response['message'] = "Please Enter Class name.";
		} else {
			if($class_id == ""){
				$con = array(
					'table_name' => 'Classes',
					'column_names' => array(
						'board_id' => $board_name,
						'class'=>  $class_name
					),
					'conditions' => array(
						'status' => '1' 
					)
				);
			}else{
				$con = array(
					'table_name' => 'Classes',
					'column_names' => array(
						'id' => $class_id
					),
					'conditions' => array(
						'status' => '1' 
					)
				);
			}
			$checkDuplicateData = $this->master->checkDuplicateData($con);
			// echo '<pre>';print_r($checkDuplicateData);exit;
			if ($checkDuplicateData) {
				$updateData = array();
				if($class_name != ""){
					$updateData['class'] = trim($class_name);
					$updateData['created_at'] = date('Y-m-d H:i:s');
					$this->db->where('id',$class_id);
					$this->db->where('board_id',$board_name);
					$this->db->update('classes', $updateData);
					$response['flag'] = true;
					$response['message'] = "Class name Updated successfully."; 
				}else{
					$response['flag'] = true;
					$response['message'] = "Entered class Name already exits"; 
				}
			} else {
				$insertData = array();
				$insertData['board_id'] = trim($board_name);
				$insertData['class'] = trim($class_name);
				$insertData['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('Classes', $insertData);
				$response['flag'] = true;
				$response['message'] = "Class name added successfully."; 
			}
		}
		// } else {
		// 	$response['flag'] = false;
		// 	$response['message'] = "Something went wrong. Please try again.";
		// }
		echo json_encode($response);
		exit;
	}

	public function addSubjectList()
	{
		$response = array();
		// $submitData = $this->input->post('submitCourseForm');
		$board_name = $this->input->post('board_name');
		$class_name = $this->input->post('class_name');
		$subject_name = $this->input->post('subject_name');
		// if (isset($submitData)) {
		if (empty($board_name) || $board_name === "" ||empty($class_name) || $class_name === ""||empty($subject_name) || $subject_name === "") {
			$response['flag'] = false;
			$response['message'] = "Please select board and Class and enter subject name.";
		} else {
			$con = array(
				'table_name' => 'Subjects',
				'column_names' => array(
					'board_id' => $board_name,
					'class_id'=>  $class_name,
				),
				'conditions' => array(
					'status' => '1' 
				)
			);
			$checkDuplicateData = $this->master->checkDuplicateData($con);
			if ($checkDuplicateData) {
				$response['flag'] = false;
				$response['message'] = "Entered Subject with Same Board and Class  already exists.";
			} else {
				foreach ($subject_name as $key => $value) {
					$insertData = array();
					$insertData['board_id'] = trim($board_name);
					$insertData['class_id'] = trim($class_name);
					$insertData['subject'] = trim($value);
					$insertData['created_at'] = date('Y-m-d H:i:s');
					// echo '<pre>';print_r($insertData);
					$this->db->insert('Subjects', $insertData);
				}
				$response['flag'] = true;
				$response['message'] = "Subjects name added successfully."; 
			}
		}
		// } else {
		// 	$response['flag'] = false;
		// 	$response['message'] = "Something went wrong. Please try again.";
		// }
		echo json_encode($response);
		exit;
	}

	public function addUnitList()
	{
		$response = array();
		// $submitData = $this->input->post('submitCourseForm');
		$board_name = $this->input->post('board_name');
		$class_name = $this->input->post('class_name');
		$subject_name = $this->input->post('subject_name');
		$unit = $this->input->post('unit');
		// if (isset($submitData)) {
		if (empty($board_name) || $board_name === ""){
			$response['flag'] = false;
			$response['message'] = "Please select board name.";
		}else if(empty($class_name) || $class_name === ""){
			$response['flag'] = false;
			$response['message'] = "Please select class name.";
		}else if(empty($subject_name) || $subject_name === "") {
			$response['flag'] = false;
			$response['message'] = "Please select subject name.";
		}else if(empty($unit) || $unit === "") {
			$response['flag'] = false;
			$response['message'] = "Please enter unit name.";
		} else {
			foreach ($unit as $key => $v) {
				$con = array(
					'table_name' => 'unit',
					'column_names' => array(
						'board_id' => $board_name,
						'class_id'=>  $class_name,
						'subject_id'=>  $class_name,
						'unit'=>$v
					),
					'conditions' => array(
						'status' => '1' 
					)
				);
				$checkDuplicateData = $this->master->checkDuplicateData($con);
				if ($checkDuplicateData) {
					$response['flag'] = false;
					$response['message'] = "Entered Subject with Same Board and Class  already exists.";
				} else {
					$insertData = array();
					$insertData['board_id'] = trim($board_name);
					$insertData['class_id'] = trim($class_name);
					$insertData['subject_id'] = trim($subject_name);
					$insertData['unit'] = trim($v);
					$insertData['created_at'] = date('Y-m-d H:i:s');
					// echo '<pre>';print_r($insertData);
					$this->db->insert('unit', $insertData);
					
				}
			}
			
			$response['flag'] = true;
			$response['message'] = "Chapters name added successfully."; 
		}

		// } else {
		// 	$response['flag'] = false;
		// 	$response['message'] = "Something went wrong. Please try again.";
		// }
		echo json_encode($response);
		exit;
	}

	public function delBoardList(){
		$response = array();
		$board_id= $this->input->post('id');
		if (empty($board_id) || $board_id === ""){
			$response['flag'] = false;
			$response['message'] = "Invalid Request";
		}else{
			$updateData = array();
			$updateData['status'] = 0;
			$updateData['created_at'] = date('Y-m-d H:i:s');
			// echo '<pre>';print_r($updateData);exit;
			$this->db->where('id',$board_id);
			$this->db->update('board', $updateData);
			$response['flag'] = true;
			$response['message'] = "Board name deleted successfully."; 	
		}
		echo json_encode($response);
		exit;
	}

	public function delClassList(){
		$response = array();
		$class_id= $this->input->post('class_id');
		if (empty($class_id) || $class_id == ""){
			$response['flag'] = false;
			$response['message'] = "Invalid Request";
		}else{
			$updateData = array();
			$updateData['status'] = 0;
			$updateData['created_at'] = date('Y-m-d H:i:s');
			// echo '<pre>';print_r($updateData);exit;
			$this->db->where('id',$class_id);
			$this->db->update('classes', $updateData);
			$response['flag'] = true;
			$response['message'] = "Class name deleted successfully."; 	
		}
		echo json_encode($response);
		exit;
	}
	/*
	 * Function to view job roles 
	 */
	public function jobRoleList()
	{
		$con['conditions'] = array('is_active' => '1');
		$viewData['jobRoleList'] = $this->master->getJobRoleDetails($con);
		$viewData['sectorList'] = $this->master->getSectorDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/job-role-list', $viewData);
		$this->load->view('/layout/footer');
	}
	public function addNewJobRole()
	{
		$response = array();
		// $submitData = $this->input->post('submitCourseForm');
		$sector_data 	= explode('-', $this->input->post('sector_name'));
		$job_role_name 	= $this->input->post('job_role_name');
		// if (isset($submitData)) {
		if (empty($sector_data[0]) || $sector_data[0] === "") {
			$response['flag'] = false;
			$response['input'] = "sector";
			$response['message'] = "Please select sector name.";
		} else if (empty($job_role_name) || $job_role_name === "") {
			$response['flag'] = false;
			$response['input'] = "job_role";
			$response['message'] = "Please enter job Role name.";
		} else {
			$con = array(
				'table_name' => 'job_roles',
				'column_names' => array(
					'job_role_name' => $job_role_name,
					'sector_name' => $sector_data[1]
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
				$insertData['sector_id'] = trim($sector_data[0]);
				$insertData['sector_name'] = trim($sector_data[1]);
				$insertData['job_role_name'] = trim($job_role_name);
				$insertData['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('job_roles', $insertData);
				$response['flag'] = true;
				$response['message'] = "Job Role name added successfully."; 
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
	 * Function to view sections 
	 */
	public function sectionList()
	{
		$con['conditions'] = array('is_active' => '1');
		$viewData['sectionList'] = $this->master->getSectionDetails($con);
		$viewData['sectorList'] = $this->master->getSectorDetails($con);
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header
		$this->load->view('/master/section-list', $viewData);
		$this->load->view('/layout/footer');
	}
	public function addNewSection()
	{
		$response = array();
		// $submitData = $this->input->post('submitCourseForm');
		$sector_data 	= explode('-', $this->input->post('sector_name'));
		$job_role_data 	= explode('-', $this->input->post('job_role_name'));
		$section_name 	= $this->input->post('section_name');
		// if (isset($submitData)) {
		if (empty($sector_data[0]) || $sector_data[0] === "") {
			$response['flag'] = false;
			$response['input'] = "sector";
			$response['message'] = "Please select sector name.";
		} else if (empty($job_role_data[0]) || $job_role_data[0] === "") {
			$response['flag'] = false;
			$response['input'] = "job_role";
			$response['message'] = "Please enter job role name.";
		} else if (empty($section_name) || $section_name === "") {
			$response['flag'] = false;
			$response['input'] = "sector";
			$response['message'] = "Please enter section name.";
		} else {
			$con = array(
				'table_name' => 'sections',
				'column_names' => array(
					'job_role_name' => $job_role_data[1],
					'sector_name' => $sector_data[1],
					'section_name'  => $section_name
				),
				'conditions' => array(
					'is_active' => '1' 
				)
			);
			$checkDuplicateData = $this->master->checkDuplicateData($con);
			if ($checkDuplicateData) {
				$response['flag'] = false;
				$response['input'] = "duplicate";
				$response['message'] = "Entered details already exist.";
			} else {
				$insertData = array();
				$insertData['sector_id'] 	= trim($sector_data[0]);
				$insertData['sector_name'] 	= trim($sector_data[1]);
				$insertData['job_role_id'] 	= trim($job_role_data[0]);
				$insertData['job_role_name'] = trim($job_role_data[1]);
				$insertData['section_name'] 	= trim($section_name);
				$insertData['created_at'] 	= date('Y-m-d H:i:s');
				$this->db->insert('sections', $insertData);
				$response['flag'] = true;
				$response['message'] = "Section added successfully."; 
			}
		}
		// } else {
		// 	$response['flag'] = false;
		// 	$response['message'] = "Something went wrong. Please try again.";
		// }
		echo json_encode($response);
		exit;
	}


	public function getClassDetails(){
		try {
			$response = array();
			$board = $this->input->get('board');
			if(!empty($board) && $board != ""){
				$con['conditions'] = array('board_id' => $board,'status'=> '1');
				$classList = $this->master->getClassDetails($con);
				$response['flag'] = true;
				$response['classDetails'] = $classList;
			}

		} catch(Exception $e) {
			$response['flag'] = false;
			$response['title'] = "Internal Server Error!";
			$response['message'] = $e->getMessage();
		}
		echo json_encode($response);
		exit;
	}

	public function getSubjectDetails(){
		try {
			$response = array();
			$class_id = $this->input->get('class_id');
			if(!empty($class_id) && $class_id != ""){
				$con['conditions'] = array('class_id' => $class_id,'status'=> '1');
				$SubjectList = $this->master->getSubjectDetails($con);
				$response['flag'] = true;
				$response['SubjectList'] = $SubjectList;
			}

		} catch(Exception $e) {
			$response['flag'] = false;
			$response['title'] = "Internal Server Error!";
			$response['message'] = $e->getMessage();
		}
		echo json_encode($response);
		exit;
	}
}
?>
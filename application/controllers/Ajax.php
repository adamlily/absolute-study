<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  
/**
 * Class Name 	: Ajax 
 * Date 		: 09/07/2019
 * Author Name 	: Amit Chaurasiya
 */
class Ajax extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('isUserLoggedIn')) {
			return redirect('user-login');
		}
		$this->load->model('master_model','master');
		$this->load->model('Quiz_model','quiz');
	}

	/**
	 * Function to get Job Role list associated with selected course 
	 * @param sector_id
	 */
	public function getJobRoleListBySectorId()
	{
		$response = array();
		$sectorData = $this->input->post('sector_id');
		$sector_id = explode('-', $sectorData);
		$con = array(
			'conditions' => array(
				'sector_id' => $sector_id[0],
				'is_active' => '1'
			)
		);
		$jobRoleList = $this->master->getJobRoleDetails($con);
		if ($jobRoleList) {
			$options = '<option value="">Select Job Role</option>';
			foreach ($jobRoleList as $job_role) {
				$options .= '<option value="'.$job_role['id'].'-'.$job_role['job_role_name'].'">'.$job_role['job_role_name'].'</option>';
			}
			$response['flag'] = true;
			$response['jobRoleOptions'] = $options;
		} else {
			$response['flag'] = false;
			$response['message'] = "Job Role not found. Please add Job Role.";
		}
		echo json_encode($response);
		exit;
	}
	/**
	 * Function to get subject list associated with selected course 
	 * @param sector_id, job_role_id
	 */
	public function getSectionListBySectorAndJobRoleId()
	{
		$response = array();
		$sector_id 	= $this->input->post('sector_id');
		$job_role_id 	= $this->input->post('job_role_id');
		$con = array(
			'conditions' => array(
				'sector_id' => $sector_id,
				'job_role_id' => $job_role_id,
				'is_active' => '1'
			)
		);
		$sectionList = $this->master->getSectionDetails($con);
		if ($sectionList) {
			$options = '<option value="">Select Section</option>';
			foreach ($sectionList as $section) {
				$options .= '<option value="'.$section['id'].'-'.$section['section_name'].'">'.$section['section_name'].'</option>';
			}
			$response['flag'] = true;
			$response['sectionOptions'] = $options;
		} else {
			$response['flag'] = false;
			$response['message'] = "Section not found. Please add Section.";
		}
		echo json_encode($response);
		exit;
	}
	/**
	 * Function to get details question options and answer key by question id 
	 * @param question_id
	 */
	public function getQuestionDetailsById()
	{
		$question_id 	= $this->input->post('question_id');
		$con = array(
			'conditions' => array(	
				'is_active' => '1'
			), 'id' => $question_id
		);
		$questionDetails = $this->quiz->getQuestionsDetails($con);
		if ($questionDetails) {
			if ($questionDetails['answer_key'] === '1') {
				$questionDetails['answer'] = "A";
			} else if ($questionDetails['answer_key'] === '2') {
				$questionDetails['answer'] = "B";
			} else if ($questionDetails['answer_key'] === '3') {
				$questionDetails['answer'] = "C";
			} else if ($questionDetails['answer_key'] === '4') {
				$questionDetails['answer'] = "D";
			}
		} else {
			$questionDetails['errorMessage'] = "Data Not Found.";
		}
		$viewData['questionDetails'] = $questionDetails;
		$this->load->view('/quiz/question-details', $viewData);
	}
}

?>
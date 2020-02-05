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
	 * Function to get subject list associated with selected course 
	 * @param course_id
	 */
	public function getSubjectListByCourseId()
	{
		$response = array();
		$courseData = $this->input->post('course_id');
		$course_id = explode('-', $courseData);
		$con = array(
			'conditions' => array(
				'course_id' => $course_id[0],
				'is_active' => '1'
			)
		);
		$subjectList = $this->master->getSubjectDetails($con);
		if ($subjectList) {
			$options = '<option value="">Select Subject</option>';
			foreach ($subjectList as $subject) {
				$options .= '<option value="'.$subject['id'].'-'.$subject['subject_name'].'">'.$subject['subject_name'].'</option>';
			}
			$response['flag'] = true;
			$response['subjectOptions'] = $options;
		} else {
			$response['flag'] = false;
			$response['message'] = "Subject not found. Please add subject.";
		}
		echo json_encode($response);
		exit;
	}
	/**
	 * Function to get subject list associated with selected course 
	 * @param course_id, subject_id
	 */
	public function getTopicListByCourseAndSubjectId()
	{
		$response = array();
		$course_id 	= $this->input->post('course_id');
		$subject_id 	= $this->input->post('subject_id');
		$con = array(
			'conditions' => array(
				'course_id' => $course_id,
				'subject_id' => $subject_id,
				'is_active' => '1'
			)
		);
		$topicList = $this->master->getTopicDetails($con);
		if ($topicList) {
			$options = '<option value="">Select Topic</option>';
			foreach ($topicList as $topic) {
				$options .= '<option value="'.$topic['id'].'-'.$topic['topic_name'].'">'.$topic['topic_name'].'</option>';
			}
			$response['flag'] = true;
			$response['topicOptions'] = $options;
		} else {
			$response['flag'] = false;
			$response['message'] = "Subject not found. Please add subject.";
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
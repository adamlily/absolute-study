<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

/**

 * Class Name 	: Quiz 

 * Date 		: 09/07/2019

 * Author Name 	: Amit Chaurasiya

 */

class Quiz extends CI_Controller

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

		$this->data['role'] 	= $this->session->userdata('role');

		$this->data['role_id'] 	= $this->session->userdata('role_id');

		$this->load->model('Quiz_model','quiz');

		$this->load->model('Master_model','master');

		$this->load->library('form_validation');
		
		$this->load->database();

	}



	/**

	 * Function to view courses 

	 */

	public function questionList()

	{

		$con['conditions'] = array('is_active' => '1');

		$viewData['questionList'] = $this->quiz->getQuestionsDetails($con);

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/quiz/question-list', $viewData);

		$this->load->view('/layout/footer');

	}


	/**
	* Function to Import Question
	*/
	public function importQuestionView()
	{
		$con['conditions'] = array('is_active' => '1');
		$viewData['courseList'] = $this->master->getCourseDetails($con);
		$this->load->view('/layout/header', $this->data); 	
		$this->load->view('/quiz/import-question',$viewData);
		$this->load->view('/layout/footer');
	}

	/**
	*Function to Import New Question
	*/
	
	public function importNewQuestion()
	{
		$params = $this->input->post();

		
		$this->form_validation->set_rules('course_name', 'Course Name', 'required');
		$this->form_validation->set_rules('subject_name', 'Subject Name', 'required');
		$this->form_validation->set_rules('topic_name', 'Topic Name', 'required');
		$this->form_validation->set_rules('uploadFile', '', 'callback_file_check');

		if ($this->form_validation->run() == FALSE) {
			$this->importQuestionView();

		}else{



			$path = 'uploads/';
			require_once APPPATH . "/third_party/PHPExcel/PHPExcel.php";
			$config['upload_path'] = $path;
			
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uploadFile')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = array('upload_data' => $this->upload->data());
			}

			if(empty($error)){

				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
				} else {
					$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$flag = true;
					$i=0;


					foreach ($allDataInSheet as $value) {
						if($flag){
							$flag =false;
							continue;
						}
						
						$insertData = array();
						$courseData = explode('-', $params['course_name']);
						$subjectData = explode('-', $params['subject_name']);
						$topicData = explode('-', $params['topic_name']);
						$insertData['course_id'] 		= trim($courseData[0]);
						$insertData['course_name'] 		= trim($courseData[1]);
						$insertData['subject_id'] 	= trim($subjectData[0]);
						$insertData['subject_name'] 	= trim($subjectData[1]);
						$insertData['topic_id'] 		= trim($topicData[0]);
						$insertData['topic_name'] 		= trim($topicData[1]);
						$insertData['question'] = $value['A'];
						$insertData['option_a'] = $value['B'];
						$insertData['option_b'] = $value['C'];
						$insertData['option_c'] = $value['D'];
						$insertData['option_d'] = $value['E'];
						$insertData['answer_key'] = $value['F'];
						$insertData['difficulty_level'] = $value['G'];
						$insertData['time_slot'] = $value['H'];
						$insertData['hint'] = $value['I'];
						$insertData['created_at']		= date('Y-m-d H:i:s');
						
						// echo "<pre>";
						// print_r($insertData);

						$this->db->insert('questions', $insertData);
						$i++;
					}   
					redirect('/admin/import-question-view');
					exit;            
					
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' .$e->getMessage());
				}
			}else{
				echo $error['error'];exit;
			}


		}

	}


	 /*
     * file value and type check during validation
     */
	 public function file_check($str){
	 	$allowed_mime_type_arr = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 	$mime = get_mime_by_extension($_FILES['uploadFile']['name']);
	 	if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name']!=""){
	 		if(in_array($mime, $allowed_mime_type_arr)){
	 			return true;
	 		}else{
	 			$this->form_validation->set_message('file_check', 'Please select only excel file.');
	 			return false;
	 		}
	 	}else{
	 		$this->form_validation->set_message('file_check', 'Please choose a file to upload.');
	 		return false;
	 	}
	 }

	/**

	 * Function to add new course

	 */

	public function addQuestionView()

	{

		$con['conditions'] = array('status' => '1');

		$viewData['classList'] = $this->master->getClassDetails($con);
		$viewData['BoardList'] = $this->master->getBoardDetails($con);
		$viewData['subjectList'] = $this->master->getSubjectDetails($con);
		$viewData['chapterList'] = $this->master->getChapterDetails($con); 
		// $this->master->getCourseDetails($con);
		// echo '<pre>';print_r($viewData);exit;
		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/quiz/add-question', $viewData);

		$this->load->view('/layout/footer');

	}

	 /**

	 * Function to add new course

	 */

	 public function addNewQuestion()

	 {

	 	$params = $this->input->post();

	 	$this->form_validation->set_rules('course_name', 'Course Name', 'required');

	 	$this->form_validation->set_rules('subject_name', 'Subject Name', 'required');

	 	$this->form_validation->set_rules('topic_name', 'Topic Name', 'required');

	 	$this->form_validation->set_rules('question', 'Question', 'required');

	 	$this->form_validation->set_rules('optionA', 'Option A', 'required');

	 	$this->form_validation->set_rules('optionB', 'Option B', 'required');

	 	$this->form_validation->set_rules('optionC', 'Option C', 'required');

	 	$this->form_validation->set_rules('optionD', 'Option D', 'required');

	 	$this->form_validation->set_rules('answerKey', 'Answer Key', 'required');

	 	$this->form_validation->set_rules('difficultyLevel', 'Difficulty Level', 'required');

	 	if ($this->form_validation->run() == FALSE) {

	 		$this->addQuestionView();

	 	} else {

	 		$insertData = array();

	 		$courseData = explode('-', $params['course_name']);

	 		$subjectData = explode('-', $params['subject_name']);

	 		$topicData = explode('-', $params['topic_name']);

	 		$insertData['course_id'] 		= trim($courseData[0]);

	 		$insertData['course_name'] 		= trim($courseData[1]);

	 		$insertData['subject_id'] 		= trim($subjectData[0]);

	 		$insertData['subject_name'] 	= trim($subjectData[1]);

	 		$insertData['topic_id'] 		= trim($topicData[0]);

	 		$insertData['topic_name'] 		= trim($topicData[1]);

	 		$insertData['question'] 		= trim($params['question']);

	 		$insertData['option_a'] 		= trim($params['optionA']);

	 		$insertData['option_b'] 		= trim($params['optionB']);

	 		$insertData['option_c'] 		= trim($params['optionC']);

	 		$insertData['option_d'] 		= trim($params['optionD']);

	 		$insertData['answer_key'] 		= trim($params['answerKey']);

	 		$insertData['difficulty_level'] = trim($params['difficultyLevel']);

	 		$insertData['time_slot'] 		= trim($params['timeSlot']);

	 		$insertData['hint'] 			= trim($params['answerHint']);

	 		$insertData['created_at']		= date('Y-m-d H:i:s');

	 		$this->db->insert('questions', $insertData);

	 		redirect('admin/add-question-view');

	 	}

	 }

	/**

	 * Function to view courses 

	 */

	public function quizList()

	{

		$con['conditions'] = array('is_active' => '1');

		$viewData['quizList'] = $this->quiz->getQuizDetails($con); 

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/quiz/quiz-list', $viewData); 

		$this->load->view('/layout/footer'); 

	}

	/**

	 * Function to load create new quiz form

	 */ 
	public function createNewQuiz()
	{
		$con['conditions'] = array('is_active' => '1');

		$viewData['courseList'] = $this->master->getCourseDetails($con);

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/quiz/create-new-quiz', $viewData);

		$this->load->view('/layout/footer');
	}

	/*

	 * Function to save new quiz

	 */

	public function saveNewQuiz()

	{

		$params = $this->input->post();

		$this->form_validation->set_rules('course_name', 'Course Name', 'required');

		$this->form_validation->set_rules('subject_name', 'Subject Name', 'required');

		// $this->form_validation->set_rules('topic_name', 'Topic Name', 'required');

		$this->form_validation->set_rules('quiz_name', 'Quiz Name', 'required');

		$this->form_validation->set_rules('number_of_questions', 'Number Of Question', 'required');

		$this->form_validation->set_rules('description', 'Description', 'required');

		$this->form_validation->set_rules('attempt_count', 'Attempt Count', 'required');

		$this->form_validation->set_rules('quiz_duration', 'Quiz Duration', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->createNewQuiz();

		} else {

			$insertData = array();

			$courseData = explode('-', $params['course_name']);

			$subjectData = explode('-', $params['subject_name']);

			// $topicData = explode('-', $params['topic_name']);

			$insertData['course_id'] 		= trim($courseData[0]);

			$insertData['course_name'] 		= trim($courseData[1]);

			$insertData['subject_id'] 		= trim($subjectData[0]);

			$insertData['subject_name'] 	= trim($subjectData[1]);

			// $insertData['topic_id'] 		= trim($topicData[0]);

			// $insertData['topic_name'] 		= trim($topicData[1]);

			$insertData['quiz_name'] 		= trim($params['quiz_name']);

			$insertData['number_of_questions'] 		= trim($params['number_of_questions']);

			$insertData['description'] 		= trim($params['description']);

			$insertData['attempt_count'] 		= trim($params['attempt_count']);

			$insertData['quiz_duration'] 		= trim($params['quiz_duration']);
			
			$insertData['created_at']		= date('Y-m-d H:i:s');

			$this->db->insert('quizs', $insertData);

			redirect('admin/create-new-quiz');

		}
	}

	/** 
	 * Function to show quiz list to attempt the quiz
	 */ 
	public function attemptQuiz()
	{
		$con['conditions'] 	= array(
			'is_active' => '1',
			'allocated_to_id' => $this->data['user_id'], 
			'is_submitted' => '0'
		);
		$viewData['quizList'] 	= $this->quiz->getAttemptQuizList($con);
		$this->load->view('/layout/header', $this->data);
		$this->load->view('/quiz/quiz-list-to-attempt', $viewData);
		$this->load->view('/layout/footer');
	}


	/** 
	 * Function to load quiz view to attempt the questions based on quiz
	 * @param quiz_id
	 */ 
	public function currentAttemptedQuiz($quiz_id = NULL)
	{
		$viewData['quiz_details'] = $this->quiz->getQuizDetailsByQuizId($quiz_id);
		$this->load->view('/layout/header', $this->data);
		$this->load->view('/quiz/attempt-quiz-question', $viewData);
		$this->load->view('/layout/footer');
	}
	/** 
	 * Function to save submitted quiz answers by student
	 * @param params
	 */ 
	public function saveSubmittedQuiz()
	{
		$params = $this->input->post();
		if ($this->input->post('submitQuiz')) {
			$insertData = array();
			$insertData['course_id'] 	= $params['course_id'];
			$insertData['course_name']	= $params['course_name'];
			$insertData['subject_id'] 	= $params['subject_id'];
			$insertData['subject_name']	= $params['subject_name'];
			$insertData['quiz_id'] 		= $params['quiz_id'];
			$insertData['quiz_name']	= $params['quiz_name'];
			$insertData['number_of_questions']	= count($params['question_number']);
			$insertData['submitted_at']			= date('Y-m-d H:i:s');
			$insertData['submitted_by']			= $this->data['user_id'];
			$this->db->insert('quiz_submitted', $insertData);
			$insert_id = $this->db->insert_id();
			$i = 0;
			foreach ($params['question_number'] as $question) {
				$question_details = $this->quiz->getQuizQuestionsDetails($params['quiz_id'], $question);
				$insertSubData = array();
				$insertSubData['quiz_submitted_id'] = $insert_id;
				$insertSubData['quiz_id'] 			= $params['quiz_id'];
				$insertSubData['question_number'] 	= $question;
				$insertSubData['question'] 			= $question_details['question'];
				$insertSubData['correct_option'] 	= $question_details['answer_key'];
				if (isset($params['question_option_'.($i+1)])) {
					$insertSubData['option_selected'] 	= $params['question_option_'.($i+1)];
					$insertSubData['is_attempted']		= '1';
					if ($insertSubData['option_selected'] === $question_details['answer_key']) {
						$insertSubData['question_result'] = "Correct";
					} else {
						$insertSubData['question_result'] = "Incorrect";
					}
				}
				$insertSubData['submitted_at']		= date('Y-m-d H:i:s');
				$insertSubData['submitted_by']		= $this->data['user_id'];
				$this->db->insert('quiz_submitted_answers', $insertSubData);
				$i++;
			};
			redirect('admin/submitted-quiz');
		}
	}

	/** 
	 * Function to load quiz view to attempt the questions based on quiz
	 * @param quiz_id
	 */ 
	public function submittedQuizList()
	{
		$viewData['submitted_quiz_list'] = $this->quiz->getSubmittedQuizList($this->data['user_id']);
		$this->load->view('/layout/header', $this->data);
		$this->load->view('/quiz/submitted-quiz-list', $viewData);
		$this->load->view('/layout/footer');
	}


	/**

	 * Function to view courses 

	 */

	public function studentAttemptQuiz()

	{

		$con['conditions'] = array('is_active' => '1');

		$viewData['quizList'] = $this->quiz->getQuizDetails($con);

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/quiz/student-quiz-list', $viewData);

		$this->load->view('/layout/footer');

	}

	/** 
	 * Function to show quiz result to attempt the questions based on quiz
	 * @param submitted_quiz_id
	 */ 
	public function quizResult($submitted_quiz_id)
	{
		$viewData['quiz_result'] = $this->quiz->getQuizResult($submitted_quiz_id);
		$this->load->view('/layout/header', $this->data);
		$this->load->view('/quiz/quiz-result', $viewData);
		$this->load->view('/layout/footer');

	}


	/**

	 * Function to Select Question 

	 */

	public function selectQuestion()

	{
		
		$con['conditions'] = array('is_active' => '1');

		$viewData['quizList'] = $this->quiz->getQuizDetails($con); 
		$viewData['questionList'] = $this->quiz->getQuestionsDetails($con);


		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/quiz/select-question', $viewData); 

		$this->load->view('/layout/footer'); 
	}

	public function selectQuestionList()
	{
		$params = $this->input->post();

		$i = 0;
		foreach ($params['quesion'] as $key => $value) {

			$quizData = explode('-', $params['select_quiz']);

			$questionData = explode('-', $params['question']);

			$insertData = array();

			$insertData['quiz_id'] = $quizData[0];
			$insertData['quiz_name'] = $quizData[1];
			$insertData['topic_id'] = $questionData[0];
			$insertData['topic_name'] = $questionData[1];

			$insertData['allocated_at'] = date('Y-m-d H:i:s');

			$this->db->insert('quiz_questions', $insertData);
			$i++;
		}

		redirect('admin/select-question');

	}

}

?>
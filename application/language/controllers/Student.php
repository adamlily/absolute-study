<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  
/**
 * Class Name 	: Student 
 * Date 		: 12/07/2019
 * Author Name 	: Amit Chaurasiya
 */
class Student extends CI_Controller
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
		$this->load->model('Student_model','student');
		$this->load->model('Quiz_model','quiz');
		$this->load->model('Master_model','master');
		$this->load->library('form_validation');
		
		$this->load->database();
		
	}
	/**
	 * Function to load import student data view form
	 */
	public function importStudentView()
	{
		$this->load->view('/layout/header', $this->data);	// Sidebar is with in header
		$this->load->view('/student/import-data');
		$this->load->view('/layout/footer');
	}
	public function studentSampleSheetDownload($file_name)
	{
		$this->load->helper('download');
		if ($file_name) {
			// echo $file_name;exit;
			$file = realpath("assets/sample_files/")."/".$file_name;
			if (file_exists($file)) {
				$data = file_get_contents($file);
				force_download($file_name, $data);
			} else {
				redirect("/admin/import-student-view");
			}
		}
	}
	/**
	 * Function to import student data from excel sheet in a pre-defice format 
	 */
	public function importStudentData()
	{
		if ($this->input->post('importSubmit')) {
			$path = 'uploadStudent/';
			require_once APPPATH . "/third_party/PHPExcel/PHPExcel.php";
			$config['upload_path'] = $path;
			
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('student_excel_sheet')) {
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
						$insertData['name'] = $value['A'];
						$insertData['username'] = $value['B'];
						$insertData['password'] = sha1(md5($value['C']));
						$insertData['plain_password'] = $value['D'];
						$insertData['user_profile_image_path'] = "/assets/images/user_profile/student.png";
						$insertData['role_id'] = 2;
						$insertData['role'] = "student";
						$insertData['created_by'] = 1;
						$insertData['created_at'] = date('Y-m-d H:i:s');
						$this->db->insert('users', $insertData);
						
						$i++;
					}               
					redirect('/admin/import-student-data');  
					
					if($result){
						echo "Imported successfully";
					}else{
						echo "ERROR !";
					}             
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' .$e->getMessage());
				}
			}else{
				echo $error['error'];exit;
			}
		}else{
			$this->load->view('/layout/header', $this->data);
			$this->load->view('/student/import-data');
			$this->load->view('/layout/footer');
		}
	}
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
    	$allowed_mime_type_arr = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    	$mime = get_mime_by_extension($_FILES['student_excel_sheet']['name']);
    	if(isset($_FILES['student_excel_sheet']['name']) && $_FILES['student_excel_sheet']['name']!=""){
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
    public function studentList()
    {
    	$viewData['studentList'] = $this->student->getStudentList(2);
    	$this->load->view('/layout/header', $this->data);
    	$this->load->view('/student/student-list',$viewData);
    	$this->load->view('/layout/footer');
    }
    public function allocateQuizToStudent()
    {

    	$con['conditions'] = array('is_active' => '1');
    	$viewData['quizList'] = $this->quiz->getQuizDetails($con); 
    	$viewData['studentList'] = $this->student->getStudentList($con);
    	$this->load->view('/layout/header', $this->data);
    	$this->load->view('/student/allocate-quiz',$viewData);
    	$this->load->view('/layout/footer');
    }

    public function quizAllocated()
    {
    	$params = $this->input->post();
    	// echo "<pre>";
    	// print_r($params);
    	// exit;

    	$i = 0;
    	foreach ($params['student_id'] as $key => $value) {
    		$quizArray = explode('-',$params['allocated_quiz']);
    		$studentArray = explode('-',$params['student_id'][$i]);
    		$insertData = array();
    		$insertData['quiz_id'] = $quizArray[0];
    		$insertData['quiz_name'] = $quizArray[1];
    		$insertData['allocated_to_id'] = $studentArray[0];
    		$insertData['allocated_to_name'] = $studentArray[1];
    		$insertData['allocated_by'] = $this->data['user_id'];
    		$insertData['allocated_at'] = date('Y-m-d H:i:s');
    		$this->db->insert('quiz_allocated', $insertData);
    		$i++;
    	}
    	
    	redirect('admin/allocate-quiz-to-student');
    }

}
?>
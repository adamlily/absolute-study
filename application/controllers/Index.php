<?php 



/**

 * Class Name 	: Index 

 * Date 		: 03/07/2019

 * Author Name 	: Amit Chaurasiya

 */

class Index extends CI_Controller

{

	

	function __construct()

	{

		parent::__construct();

		$this->load->model('user');

	}



	/**

	 * Function to login view to login

	 */

	public function index()

	{

		$this->load->view('/login/user-login-page');

	}


	/**

	 * Function to validate input data and allow user login to the system and redirect to dashboard

	 * @param username, password

	 */

	public function userLogin()

	{

		$checkSubmit = $this->input->post('submitUserLoginForm');

		$data = array();

		if($this->session->userdata('success_msg')){

			$data['success_msg'] = $this->session->userdata('success_msg');

			$this->session->unset_userdata('success_msg');

		}

		if($this->session->userdata('error_msg')){

			$data['error_msg'] = $this->session->userdata('error_msg');

			$this->session->unset_userdata('error_msg');

		}

		if (isset($checkSubmit)) {

			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>'); 

			$this->form_validation->set_rules('username', 'Username', 'required');

			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == true) {

				$con['returnType'] = 'single';

				$con['conditions'] = array(

					'username'=>$this->input->post('username'),

					'password' => sha1(md5($this->input->post('password'))),

					'is_active' => '1'

				);

				$checkLogin = $this->user->getRows($con);

				if($checkLogin){

					$this->session->set_userdata(array(

						'isUserLoggedIn' => TRUE,

						'userId' 	=> $checkLogin['id'],

						'userName' 	=> $checkLogin['name'],

						'user_image' => $checkLogin['user_profile_image_path'],
						
						'role_id'	=> $checkLogin['role_id'],

						'role'		=> $checkLogin['role']

					));	


					if ($checkLogin['role_id'] === '1' && $checkLogin['role'] === 'admin') {

						redirect('admin/dashboard');

					} else if ($checkLogin['role_id'] === '2' && $checkLogin['role'] === 'student') {

						redirect('student/dashboard');

					}


				}else{

					$data['error_msg'] = 'Invalid username or password';

				}

			}

		}

		 //load the view

		$this->load->view('login/user-login-page', $data);

	}



	/**

	 * Function to logout the user and unset or destroy the session data

	 * 

	 */

	public function logout()

	{

		if ($this->session->userdata('isUserLoggedIn')) {

			$this->session->sess_destroy();

			redirect('user-login');

		} else {

			redirect('user-login');

		}

	}

}



?>
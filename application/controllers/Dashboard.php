<?php 



/**

 * Class Name 	: Dashboard 

 * Date 		: 06/07/2019

 * Author Name 	: Amit Chaurasiya

 */

class Dashboard extends CI_Controller

{

	

	function __construct()

	{

		parent::__construct();

		if (!$this->session->userdata('isUserLoggedIn')) {

			return redirect('user-login');

		}

		$this->data['username'] = $this->session->userdata('userName');

		$this->data['user_id'] = $this->session->userdata('userId');

		$this->data['user_profile_image'] 	= $this->session->userdata('user_image');

		$this->data['role_id'] 				= $this->session->userdata('role_id');

		$this->data['role'] 				= $this->session->userdata('role');

	}



	/*

	 * Function to load admin dashboard

	 */

	public function index()

	{

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/dashboard/index', $this->data);

		$this->load->view('/layout/footer');

	}
	/*

	 * Function to load student dashboard

	 */

	public function studentDashboard()

	{

		$this->load->view('/layout/header', $this->data); 	// Side bar is loaded inside header

		$this->load->view('/dashboard/student-dashboard', $this->data);

		$this->load->view('/layout/footer');

	}

}



?>
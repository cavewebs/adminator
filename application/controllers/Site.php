<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {
	public function __construct() {
    parent::__construct();
    $this->load->model('dashboard_model');
   
  }
	
    public function home()
	{
		$this->load->view('layout/header');
		$this->load->view('home');
		$this->load->view('layout/footer');
	}

	public function login() {
		if($this->session->userdata('loggedin')){
       redirect(site_url('dashboard'));
					
	} else {
		$this->load->view('layout/header');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			if ($this->core_model->login()) {
				$query = $this->db->get_where('admin', array('email' => $email));
				$result = $query->row_array();

				$session_data = array('email' => $_POST['email'], 'loggedin' => TRUE, 'name' => $name);
				$this->session->set_userdata($session_data);

				if ($this->session->userdata('page_url'))
				{
			       redirect($this->session->userdata('page_url'));

				}
			else {

				redirect(site_url('dashboard'));}

			}
			else {
				$this->session->set_flashdata('error', 'Incorect Username or Password');

			}
		}

			$this->load->view('login');

		  	$this->load->view('layout/footer');
		}
	}




	

	public function logout() {

		$data = array('email', 'loggedin', 'name');
		$this->session->unset_userdata($data);

		redirect('login');
	}





}
?>
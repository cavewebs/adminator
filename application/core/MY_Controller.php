<?php
defined('BASEPATH') or die('Direct access is not allowed');

class MY_Controller extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->database();
    $this->site_name = 'Adminator';
	  $this->user = $this->session->email;
    $this->load->library('user_agent');
   
  }

  public function is_restricted() {
    if ($this->session->loggedin) {
      return true;
    } else {
            $this->session->set_userdata('page_url',  current_url());
      redirect(site_url('login'));
    }
  }

  public function is_authed() {
    if ($this->session->loggedin) {
       redirect(site_url('dashboard'));
    } else {
     return true;
    }
  }

  public function admin_restricted(){
  if ($this->session->admin_logged) {
    return true;
  } else {
    redirect(site_url('admin/index'));
  }
}


  public function header($title) {
    $data['site_name'] = $this->site_name;
        $data['langi'] = $this->agent->languages();

    $data['title'] = $title;
    return $this->load->view('layout/header', $data);
  }

  public function header0($title) {
    $data['site_name'] = $this->site_name;
    $data['title'] = $title;
    return $this->load->view('layout/header2', $data);
  }
  public function footer($data = NULL) {
    $data['site_name'] = $this->site_name;
    return $this->load->view('layout/footer', $data);
  }


  public function footer_view($data = NULL) {
    return $this->load->view('layout/view_footer');
  }

} 

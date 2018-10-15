<?php
defined('BASEPATH') or die('Direct access is not allowed');
date_default_timezone_set('Africa/Lagos');

class Dashboard extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('dashboard_model');
    $this->is_restricted();
  }

  public function index() {
		$data['users'] = $this->db->get_where('admin', array('email' => $this->_user))->row();
    $this->load->view('layout/header');
    $this->load->view('dashboard', $data);
    $this->load->view('layout/footer');
  }

  public function users() {
    $this->load->view('layout/header');
    $data['users'] = $this->dashboard_model->get_all_users();
    $this->load->view('all_users', $data);
    $this->load->view('layout/footer');
  }
    
  public function new()
  {
    $data['msg'] = '';
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('gender', 'Gender', 'required');

    if ($this->form_validation->run())
    {
     if($this->dashboard_model->add_user()){
      $data['msg'] =  "Success!! New User Added"; 
     } else {
      $data['msg'] =  "Error!! New User Could not be Added"; 
     }
    }
    // else
    // {
      
    // }
    $this->load->view('layout/header');
    $this->load->view('new', $data);
    $this->load->view('layout/footer');
  }

  //View Groups a User belongs to 
  public function view_user() {
    $data['user_id'] = intval($this->uri->segment(2));
    $user_id = $data['user_id'];
    $data['msg']='';
    $data['user'] = $this->dashboard_model->get_user($user_id);
    $data['groups'] = $this->db->get('groups')->result_array();
    $data['user_groups'] = $this->db->get_where('user_groups', array('uid'=>$user_id))->result_array();

    $this->load->view('layout/header');
    $this->load->view('view_user', $data);
    $this->load->view('layout/footer');
  }
  //delete user from group
  public function remove_user() {
    $del_id = intval($this->uri->segment(2));
    return $this->dashboard_model->remove_user($del_id);
  }

  //delete user from db
  public function delete_user() {
    $del_id = intval($this->uri->segment(3));
    return $this->dashboard_model->delete_user($del_id);
  }

  //delete grup from db
  public function delete_group() {
    $del_id = intval($this->uri->segment(3));
    return $this->dashboard_model->delete_group($del_id);
  }
  
  public function add_user() {
    $data = array(
    'uid' => intval($this->uri->segment(2)),
    'gid' => intval($this->uri->segment(3))
  );

  return $this->db->insert('user_groups', $data);
  }

  //Add user to a group
  public function add_to_group() {
    $data['user_id'] = intval($this->uri->segment(3));
    $user_id = $data['user_id'];
    $data['msg']='';
    $data['user'] = $this->dashboard_model->get_user($user_id);
    $data['groups'] = $this->db->get('groups')->result_array();
    $data['user_groups'] = $this->db->get_where('user_groups', array('uid'=>$user_id))->result_array();

    $this->load->view('layout/header');
    $this->load->view('add_to_group', $data);
    $this->load->view('layout/footer');
  }
    
  // GROUPS
    public function groups() {
    $this->load->view('layout/header');
    $data['groups'] = $this->dashboard_model->get_all_groups();
    $this->load->view('all_groups', $data);
    $this->load->view('layout/footer');
  }
    
  public function new_group()
  {
    $data['msg'] = '';
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('g_name', 'Group Name', 'required');
    $this->form_validation->set_rules('g_about', 'About the Group', 'required');

    if ($this->form_validation->run())
    {
    if($this->dashboard_model->add_group()){
      $data['msg'] =  "Success!! New group Added"; 
    } else {
      $data['msg'] =  "Error!! New group Could not be Added"; 
    }
    }
    // else
    // {
      
    // }
    $this->load->view('layout/header');
    $this->load->view('new_group', $data);
    $this->load->view('layout/footer');
  }

  //View Groups a group belongs to 
  public function view_group() {
    $data['msg']='';
    $group_id = intval($this->uri->segment(2));
    $data['details'] = $this->dashboard_model->get_group($group_id);
    $data['users'] = $this->dashboard_model->get_all_users();

    $this->load->view('layout/header');
    $this->load->view('view_group', $data);
    $this->load->view('layout/footer');
  }


} 
?>
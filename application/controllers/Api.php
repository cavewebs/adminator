<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {

        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        header('Access-Control-Allow-Credentials: true');

        header('Access-Control-Max-Age: 86400');    // cache for 1 day

    }

    // Access-Control headers are received during OPTIONS requests

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))

            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");        

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))

            header("Access-Control-Allow-Headers:        
            {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);

    }

require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

// require('application/libraries/REST_Controller.php');

    class Api extends REST_Controller
{
     function __construct() {
    parent::__construct();
    $this->load->model('dashboard_model'); 
    $this->load->helper('url');

    $this->load->database();

    }

    function all_users_get()
    {
        $id = $this->get('id');
        $data = $this->dashboard_model->get_all_users();
        $this->response($data, 200);
    }
    
    //returns false if not found
    function user_details_get()
    {
        $id = $this->get('id');
        $data = $this->dashboard_model->get_user($id);
        if ($data){
        $this->response($data, 200);
        } else{
        $this->response(false, 200);         
        }
    }

    //Returns  true on success
    function new_user_post()
    {
        $data = $this->dashboard_model->add_user();
        $this->response($data, 200);
          
    }
    
    //delete user from group
    //will return true on success
     function remove_user_get() {
        $del_id = $this->get('id');
        $data = $this->dashboard_model->remove_user($del_id);
        $this->response($data, 200);
    }

    //delete user from db
    //Returns True on success
     function delete_user_get() {
        $del_id = $this->get('id');
        $data = $this->dashboard_model->delete_user($del_id);
        $this->response($data, 200);
    }

    //delete group from db
     function delete_group_get() {
        $del_id = $this->get('id');
        $data = $this->dashboard_model->delete_group($del_id);
        $this->response($data, 200);
    }

    //Adds user to user_groups table
     function add_user_post() {
        $data = array(
        'uid' => intval($this->uri->segment(2)),
        'gid' => intval($this->uri->segment(3))
    );
    $data = $this->db->insert('user_groups', $data);
    $this->response($data, 200);
    }
        
    // GROUPS
    //returns false if no groups
     function all_groups_get() {
        $data = $this->dashboard_model->get_all_groups();
        if ($data){
        $this->response($data, 200);
        } else{
        $this->response(false, 200);
        }
    }
        
     function new_group_post()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('g_name', 'Group Name', 'required');
        $this->form_validation->set_rules('g_about', 'About the Group', 'required');

        if ($this->form_validation->run())
        {
            $data = $this->dashboard_model->add_group();
            $this->response($data, 200);
        }
        else
        {
            $this->response(validation_errors(), 200);

        }
        
    }

    //View Groups a group belongs to 
     function view_user_groups_get() {
        $group_id = $this->get('id');
        $data = $this->dashboard_model->get_groups($group_id);
        $this->response($data, 200);
    }


    function login_post()
    {
        $email = $this->post('email');
        $password = hash('ripemd128', $this->post('password'));
        $result = $this->core_model->login($email, $password);
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response('success');
        }    
    }
}
?>
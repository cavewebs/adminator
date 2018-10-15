<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

// require('application/libraries/REST_Controller.php');

    class Auth extends REST_Controller
{
        public function __construct() {
    parent::__construct();
    $this->load->model('dashboard_model');
    $this->load->model('api_core_model');
}

    
     function login_post()
    {
        $result = $this->api_core_model->login();
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
         
    }


    function user_get()
    {
        if(!$this->get('email'))
        {
            $this->response(NULL, 400);
        }
        $email = $this->get('email');
        $password = hash('ripemd128', $this->get('password'));

        $query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'is_blocked' => 'false'));

        $result = $query->result();

        if($result) {
                        $user = $result;

          $result= 'true';} 
        else { 
                        $user = 'false';}


         
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
     
    function user_post()
    {
        $result = $this->user_model->update( $this->post('id'), array(
            'name' => $this->post('name'),
            'email' => $this->post('email')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
         
    }
     
    function users_get()
    {
        $users = $this->dashboard_model->get_trending_dizcoveries();
         
        if($users)
        {
            $this->response($users, 200);
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
}
?>
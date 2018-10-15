<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
 header("Access-Control-Allow-Headers: *");
require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

// require('application/libraries/REST_Controller.php');

    class auth extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->model('core_model');
    }

    function login_post()
    {
        $result = $this->core_model->login();
         
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
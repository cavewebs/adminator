<?php
defined('BASEPATH') or die('');
date_default_timezone_set('Africa/Lagos');

use Embed\Embed;

class Dashboard_model extends CI_Model {
  public function __construct(){
    parent::__construct();
     $this->load->helper('date');
  }

//User Functions 
    

   public function get_all_users() {
    return $this->db->get("users")->result_array();
  }

  public function get_user($id) {
    return $this->db->get_where("users", array('id'=>$id))->row();
  }

  public function get_user_groups($id) {
    $this->db->select('*');
    $this->db->from('user_groups');
    $this->db->where('uid', $id);
    $this->db->join('groups', 'groups.id = user_groups.gid');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function get_other_groups($id) {
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->join('user_groups', 'groups.id = user_groups.gid');
    $this->db->where('user_groups.uid !=', $id);
    $query = $this->db->get()->result_array();
    return $query;
  }
  

  public function add_user()
  {
      $data = array(
        'name' => $this->input->post('name'),
        'gender' => $this->input->post('gender')
      );
      return $this->db->insert('users', $data);
  }




  //group Functions 
    

  public function get_all_groups() {
    return $this->db->get("groups")->result_array();
  }

  public function get_group($id) {
    return $this->db->get_where("groups", array('id'=>$id))->row();
  }

  public function get_groups($id) {
    $this->db->select('*');
    $this->db->from('user_groups');
    $this->db->where('uid', $id);
    $this->db->join('groups', 'groups.id = user_groups.gid');
    $query = $this->db->get()->result_array();
    return $query;
  }
  

  public function add_group()
  {

      $data = array(
          'g_name' => $this->input->post('g_name'),
          'g_about' => $this->input->post('g_about')
      );

      return $this->db->insert('groups', $data);
  }

  public function remove_user($id)
  {
    return $this->db->query('DELETE FROM user_groups WHERE id ='.$id);
  }

  public function delete_user($id)
  {
    return $this->db->query('DELETE FROM users WHERE id ='.$id);
  }

  public function delete_group($id)
  {
    return $this->db->query('DELETE FROM groups WHERE id ='.$id);
  }

  
} 
?>
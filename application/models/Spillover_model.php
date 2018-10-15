<?php
defined('BASEPATH') or die('Direct access not allowed');
date_default_timezone_set('Africa/Lagos');
class Spillover_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper('date');
    //$this->user = $this->session->name;
    $this->user = $this->session->email;
    $this->bank_details = $this->session->bank_detail;
  }

  public function bundle_tables($bundle) {

    if($bundle === 'Bundle One 5k') {
      return 'bundle_one';
    } elseif ($bundle === 'Bundle Two 10k') {
      return 'bundle_two';
    } elseif ($bundle === 'Bundle Three 25k') {
      return 'bundle_three';
    } elseif ($bundle === 'Bundle Four 50k') {
      return 'bundle_four';
    }
  }


  public function match_user() {

    //lets validate some ish

    $check_q = $this->db->query("SELECT user FROM donations WHERE user='$this->user' AND status='pending' LIMIT 1")->num_rows();

    if($check_q > 0) {
      $this->session->set_flashdata('msg', 'You had already been matched');
      redirect(site_url('dash'));
    }

    //lets get the bundle first
    /* no need to double check
    $queryD = $this->db->get_where('users', array('number' => $this->user));
    $resultD = $queryD->row_array();
    $bundleD = $resultD['bundle'];
    $swiftD = $resultD['swift'];
    $check_d = $this->db->query("SELECT * FROM donations WHERE user='$this->user' AND bundle='$bundleD' AND  swift='$swiftD' AND status='pending' OR status='confirmed' LIMIT 1")->num_rows(); */

    //lets get the bundle first
    $query = $this->db->get_where('users', array('email' => $this->user));
    $result = $query->row_array();


    $bundle = $result['bundle'];
    $bundle_swift = $result['swift'];
    $transn_type = $result['transn_type'];
    $referer = $result['referer'];
    //now fetch the number of match for a swift
    $b_query = $this->db->query("SELECT * FROM $bundle WHERE package_name='$bundle_swift'");
    $b_result = $b_query->row_array();

    $swift_match = $b_result['matches'];
    if($transn_type==='bitcoin'){$swift_money = $b_result['bitcoin_value'];}else{$swift_money = $b_result['package_requires'];}
    
    

    //now search for user's available for donation

    $donation_query = $this->db->query("SELECT * FROM users WHERE NOT(email = '$this->user') AND matches != '0' AND bundle='$bundle' AND swift='$bundle_swift' AND eligible='true' AND is_blocked='false' AND transn_type='$transn_type' AND date_po < DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 5 DAY) ORDER BY RAND() LIMIT 1");
    $donation_result = $donation_query->row_array();

    $swift = $donation_result['swift'];

    if ($donation_result > 0) {
    $timee = date('Y-m-d H:i:s');
    //count the match of that user to donate to
    $count = $donation_result['matches'] - 1;
    //update the count
    $this->db->query("UPDATE users SET matches='$count' WHERE email='{$donation_result['email']}'");
        $data = array(
        'user' => $this->user,
        'donates_to' => $donation_result['email'],
        'bundle' => $bundle,
        'transn_type'=>$transn_type,
        'swift' => $swift,
        'amount' => $swift_money,
        'status' => 'Pending',
        'time' => $timee
      );
      $this->db->insert('donations', $data);
      $inserted_id = $this->db->insert_id();
      $this->db->query("UPDATE users SET spill_status='false' WHERE email='$this->user'");
      //Give the referer of this user his or her bonus
       $data = array(
        'user_email' => $this->user,
        'refered_by' => $referer,
        'amount' => $swift_money,
        'status' => 'Pending',
        'bundle' => $bundle,
        'time' => $timee,
        'donation_id' => $inserted_id
      );
      $this->db->insert('bonus', $data);
      if($transn_type==='bank'){$details ='Bank details:'.$donation_result['bank_details'];}else{$details ='Bitcoin address:'.$donation_result['bitcoin_address'];}
      $this->session->set_flashdata('msg', "You have been matched to pay {$donation_result['name']}, <br> a sum of {$swift_money} <br> {$details}, <br>");
    } else {
      $this->session->set_flashdata('msg', 'There are no empty slots, try again in few minutes');
    }
  }
}
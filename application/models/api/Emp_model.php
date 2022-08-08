<?php

class Emp_model extends CI_Model{

    // public $emp;

  public function __construct(){

    
    parent::__construct();
    $this->load->database();
    // $this->emp = $this->load->database('tbl_emp',TRUE);

  }

  
  public function emp_insert($data=array())
  {
      return $this->db->insert("tbl_employee",$data);
  }

}
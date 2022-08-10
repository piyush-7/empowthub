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


  
  public function update_employee_information($id, $informations){

    $this->db->where("id", $id);
    return $this->db->update("tbl_employee", $informations);
 }


 public function get_employee()
 {
     $this->db->select("*");
     $this->db->from("tbl_employee");

     $query = $this->db->get();

     return $query->result();
 }

}
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


 public function leave_insert($data=array())
 {
     return  $this->db->insert("tbl_leave",$data);
 }


 public function department_insert($data=array())
 {
     return  $this->db->insert("tbl_department",$data);
 }

 public function designation_insert($data=array())
 {
     return  $this->db->insert("tbl_designaion",$data);
 }


 public function get_manager()
 {
    $this->db->select('e.emp_name as Name,IFNULL(m.emp_name,"No Manager") as Manager');
    
    $this->db->from('tbl_employee as e');
    $this->db->join('tbl_employee as m', 'e.manager_id = m.emp_id','left');
    $query=$this->db->get();

    return $query->result();

 }

}
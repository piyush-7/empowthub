<?php

require APPPATH.'libraries/REST_Controller.php';

class Emp_dep  extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("api/Emp_model"));
        $this->load->library(array("form_validation"));
        $this->load->helper("security");
    }


    public function index_get()
    {
      $emp_dep = $this->Emp_model->emp_depart();
  
      if(count($emp_dep)>0){
  
        $this->response(array(
          "status" => 1,
          "message" => "Employee-Department found",
          "data" => $emp_dep
        ), REST_Controller::HTTP_OK);
      }else{
  
        $this->response(array(
          "status" => 0,
          "message" => "No Employee-Department found",
          "data" => $emp_dep
        ), REST_Controller::HTTP_NOT_FOUND);
      }
    }
  


}
<?php

require APPPATH.'libraries/REST_Controller.php';

class Emp_desi  extends REST_Controller
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
      $emp_desi = $this->Emp_model->emp_desi();
  
      if(count($emp_desi)>0){
  
        $this->response(array(
          "status" => 1,
          "message" => "Employee-Designation found",
          "data" => $emp_desi
        ), REST_Controller::HTTP_OK);
      }else{
  
        $this->response(array(
          "status" => 0,
          "message" => "No Employee-Designation found",
          "data" => $emp_desi
        ), REST_Controller::HTTP_NOT_FOUND);
      }
    }


    
}
<?php

require APPPATH.'libraries/REST_Controller.php';

class Emp_leave_find  extends REST_Controller
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
      $emp_leave = $this->Emp_model->emp_leave_find();
  
      if(count($emp_leave)>0){
  
        $this->response(array(
          "status" => 1,
          "message" => "Employee-Leave found",
          "data" => $emp_leave
        ), REST_Controller::HTTP_OK);
      }else{
  
        $this->response(array(
          "status" => 0,
          "message" => "No Employee-Leave found",
          "data" => $emp_leave
        ), REST_Controller::HTTP_NOT_FOUND);
      }
    }

}
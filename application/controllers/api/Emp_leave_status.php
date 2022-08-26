<?php

require APPPATH.'libraries/REST_Controller.php';

class Emp_leave_status  extends REST_Controller
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
        $emp_leave_status = $this->Emp_model->leave_status();
  
        if(count($emp_leave_status)>0){
  
        $this->response(array(
          "status" => 1,
          "message" => "Employee Leave status found",
          "data" => $emp_leave_status
        ), REST_Controller::HTTP_OK);
        }else{
  
        $this->response(array(
          "status" => 0,
          "message" => "No Employee-Leave status found",
          "data" => $emp_leave_status
        ), REST_Controller::HTTP_NOT_FOUND);
      }
    }


    public function index_put()
  {
    //updating data method
    
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->leave_id) && isset($data->emp_id) && isset($data->leave_status)){

      $leave_status = $data->leave_id;
      $leave_info = array(
        "emp_id" => $data->emp_id,
        "leave_status" => $data->leave_status,
        
      );


      if($this->Emp_model->update_leave_status($leave_status, $leave_info)){

          $this->response(array(
            "status" => 1,
            "message" => "Leave Status Updated"
          ), REST_Controller::HTTP_OK);
      }else{

        $this->response(array(
          "status" => 0,
          "messsage" => "Leave Status Not Updated"
        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{

      $this->response(array(
        "status" => 0,
        "message" => "All fields are needed"
      ), REST_Controller::HTTP_NOT_FOUND);
    }

    
  }


  
}
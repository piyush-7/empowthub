<?php

require APPPATH.'libraries/REST_Controller.php';


class Show_manager extends REST_Controller {

 
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("api/Emp_model"));
        $this->load->library(array("form_validation"));
        $this->load->helper("security");
    }


    public function index_get()
    {
      $find_manager = $this->Emp_model->get_manager();
  
      if(count($find_manager)>0){
  
        $this->response(array(
          "status" => 1,
          "message" => "Employee-Manager found",
          "data" => $find_manager
        ), REST_Controller::HTTP_OK);
      }else{
  
        $this->response(array(
          "status" => 0,
          "message" => "No Employee-Manager found",
          "data" => $find_manager
        ), REST_Controller::HTTP_NOT_FOUND);
      }
    }
  

}
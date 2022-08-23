<?php

require APPPATH.'libraries/REST_Controller.php';


class Designation extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("api/Emp_model"));
        $this->load->library(array("form_validation"));
        $this->load->helper("security");
    }


    public function index_post()
    {
        $desi_name = $this->security->xss_clean($this->input->post("desi_name"));


        
        if($this->form_validation->run( $this->form_validation->set_rules("desi_name", "Designation Name", "required")) === FALSE)
        {

        $this->response(array(
          "status" => 0,
          "message" => "Designation Name fields are needed"
        ) , REST_Controller::HTTP_NOT_FOUND);
  
        }

        else
        {
            if(!empty($desi_name))
            {
                $designation = array("desi_name"=>$desi_name);

                if($this->Emp_model->designation_insert($designation))
                {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Designation has been created"
                      ), REST_Controller::HTTP_OK);
                }

                else
                {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to create Designation"
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
                else
                {
                    $this->response(array(
                        "status" => 0,
                        "message" => "All fields are needed"
                      ), REST_Controller::HTTP_NOT_FOUND);
                }


            
        }
    }

}

<?php

require APPPATH.'libraries/REST_Controller.php';


class Emp_desi_map extends REST_Controller
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
        $emp_id = $this->security->xss_clean($this->input->post("emp_id"));


        if($this->form_validation->run( $this->form_validation->set_rules("desi_name", "Designation Name", "required")) === FALSE)
        {

        $this->response(array(
          "status" => 0,
          "message" => "Designation Name fields are needed"
        ) , REST_Controller::HTTP_NOT_FOUND);
  
        }


        elseif($this->form_validation->run($this->form_validation->set_rules("emp_id", "Emp_id", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Emp_id fields are needed & Not Dublicate"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        else
        {
            if(!empty($desi_name) && !empty($emp_id) )
            {
                $desi = array("desi_name"=>$desi_name,"emp_id"=>$emp_id);

                if($this->Emp_model->emp_desi_map($desi))
                {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Emp-Desi has been map"
                      ), REST_Controller::HTTP_OK);
                }

                else
                {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to map Emp-Desi"
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
<?php

require APPPATH.'libraries/REST_Controller.php';


class Emp_dep_map extends REST_Controller
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
        $depart_name = $this->security->xss_clean($this->input->post("depart_name"));
        $emp_id = $this->security->xss_clean($this->input->post("emp_id"));


        if($this->form_validation->run( $this->form_validation->set_rules("depart_name", "Department Name", "required")) === FALSE)
        {

        $this->response(array(
          "status" => 0,
          "message" => "Department Name fields are needed"
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
            if(!empty($depart_name) && !empty($emp_id) )
            {
                $depart = array("depart_name"=>$depart_name,"emp_id"=>$emp_id);

                if($this->Emp_model->emp_dep_map($depart))
                {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Emp-Dep has been inserted"
                      ), REST_Controller::HTTP_OK);
                }

                else
                {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to inserted Emp-Dep"
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
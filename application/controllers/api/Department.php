<?php 

require APPPATH.'libraries/REST_Controller.php';

class Department extends REST_Controller
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


        
        if($this->form_validation->run( $this->form_validation->set_rules("depart_name", "Department Name", "required|is_unique[tbl_department.depart_name]")) === FALSE)
        {

        $this->response(array(
          "status" => 0,
          "message" => "Department Name fields are needed"
        ) , REST_Controller::HTTP_NOT_FOUND);
  
        }

        else
        {
            if(!empty($depart_name))
            {
                $depart = array("depart_name"=>$depart_name);

                if($this->Emp_model->department_insert($depart))
                {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Department has been created"
                      ), REST_Controller::HTTP_OK);
                }

                else
                {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to create Department"
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
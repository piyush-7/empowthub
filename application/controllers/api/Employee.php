<?php

require APPPATH.'libraries/REST_Controller.php';

class Employee extends REST_Controller{

    // public $emp;

  public function __construct(){

    parent::__construct();
    //load database

    
    // $this->emp = $this->load->database('tbl_emp',TRUE);
    $this->load->model(array("api/Emp_model"));
    $this->load->library(array("form_validation"));
    $this->load->helper("security");
  }


  public function index_post()
  {
      $emp_name = $this->security->xss_clean($this->input->post("emp_name"));
      $emp_email = $this->security->xss_clean($this->input->post("emp_email"));
      $emp_password = $this->security->xss_clean($this->input->post("emp_password"));
      $emp_add = $this->security->xss_clean($this->input->post("emp_add"));
      $emp_mobile = $this->security->xss_clean($this->input->post("emp_mobile"));
      $emp_gender = $this->security->xss_clean($this->input->post("emp_gender"));
      $emp_dob = $this->security->xss_clean($this->input->post("emp_dob"));
      $emp_pancard = $this->security->xss_clean($this->input->post("emp_pancard"));
      $emp_joining = $this->security->xss_clean($this->input->post("emp_joining"));
      $emp_salary = $this->security->xss_clean($this->input->post("emp_salary"));


       //form validation
      //  $this->form_validation->set_rules("emp_name", "Name", "required");
      //  $this->form_validation->set_rules("emp_email", "Email", "required|valid_email|valid_emails|is_unique[tbl_employee.emp_email]");
      //  $this->form_validation->set_rules("emp_password", "Password", "required");
      //  $this->form_validation->set_rules("emp_add", "Address", "required");
      //  $this->form_validation->set_rules("emp_mobile", "Mobile", "required|exact_length[10]|numeric");
      //  $this->form_validation->set_rules("emp_gender", "Gender", "required");
      //  $this->form_validation->set_rules("emp_dob", "emp_dob", "required");
      //  $this->form_validation->set_rules("emp_pancard", "Pancard", "required");
      //  $this->form_validation->set_rules("emp_joining", "Date", "required");
      //  $this->form_validation->set_rules("emp_salary", "Salary", "required");


       if($this->form_validation->run( $this->form_validation->set_rules("emp_name", "Name", "required")) === FALSE)
       {

          //   // we have some errors
            $this->response(array(
              "status" => 0,
              "message" => "Name fields are needed"
            ) , REST_Controller::HTTP_NOT_FOUND);
      
        }

        elseif($this->form_validation->run($this->form_validation->set_rules("emp_email", "Email", "required|valid_email|valid_emails|is_unique[tbl_employee.emp_email]")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Email fields are needed & Should be unique"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_password", "Password", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Password fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }


        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_add", "Address", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Address fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_mobile", "Mobile", "required|exact_length[10]|numeric")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Mobile fields are needed & Should be 10 digit"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_gender", "Gender", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Gender fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_dob", "emp_dob", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Dob fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_pancard", "Pancard", "required|exact_length[10]")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "PanCard fields are needed & Should be Combination of 10 Char & Digit"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_joining", "Date", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Joining Date fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("emp_salary", "Salary", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Salary fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }


          else
          {
      
            if(!empty($emp_name) && !empty($emp_email) && !empty($emp_password) && !empty($emp_add) && !empty($emp_mobile) && !empty($emp_gender) && !empty($emp_dob) && !empty($emp_pancard) && !empty($emp_joining) && !empty($emp_salary) ){
              // all values are available
              $emp = array(
                "emp_name" => $emp_name,
                "emp_email" => $emp_email,
                "emp_password" => $emp_password,
                "emp_add" => $emp_add,
                "emp_mobile" => $emp_mobile,
                "emp_gender" => $emp_gender,
                "emp_dob" => $emp_dob,
                "emp_pancard" => $emp_pancard,
                "emp_joining" => $emp_joining,
                "emp_salary" => $emp_salary,
              );
      
              if($this->Emp_model->emp_insert($emp))
              {
      
                $this->response(array(
                  "status" => 1,
                  "message" => "Employee has been created"
                ), REST_Controller::HTTP_OK);
              }
              else
              {
      
                $this->response(array(
                  "status" => 0,
                  "message" => "Failed to create Employee"
                ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              }
            }
            else
            {
              // we have some empty field
              $this->response(array(
                "status" => 0,
                "message" => "All fields are needed"
              ), REST_Controller::HTTP_NOT_FOUND);
            }
          }
      }


                 ///////////////////


  public function index_put()
  {
    //updating data method
   
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->id) && isset($data->emp_name) && isset($data->emp_email) && isset($data->emp_password) && isset($data->emp_add) && isset($data->emp_mobile) && isset($data->emp_gender) && isset($data->emp_dob) && isset($data->emp_pancard) && isset($data->emp_joining) && isset($data->emp_salary) ){

      $employee_id = $data->id;
      $employee_info = array(
        "emp_name" => $data->emp_name,
        "emp_email" => $data->emp_email,
        "emp_password" => $data->emp_password,
        "emp_add" => $data->emp_add,
        "emp_mobile" => $data->emp_mobile,
        "emp_gender" => $data->emp_gender,
        "emp_dob" => $data->emp_dob,
        "emp_pancard" => $data->emp_pancard,
        "emp_joining" => $data->emp_joining,
        "emp_salary" => $data->emp_salary,
      );

      if($this->emp_model->update_employee_information($employee_id, $employee_info)){

          $this->response(array(
            "status" => 1,
            "message" => "Employee data updated successfully"
          ), REST_Controller::HTTP_OK);
      }else{

        $this->response(array(
          "status" => 0,
          "messsage" => "Failed to update student data"
        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{

      $this->response(array(
        "status" => 0,
        "message" => "All fields are needed"
      ), REST_Controller::HTTP_NOT_FOUND);
    }

    
  }


  public function index_get()
  {
    $employee = $this->Emp_model->get_employee();

    if(count($employee)>0){

      $this->response(array(
        "status" => 1,
        "message" => "Employee found",
        "data" => $employee
      ), REST_Controller::HTTP_OK);
    }else{

      $this->response(array(
        "status" => 0,
        "message" => "No Employee found",
        "data" => $employee
      ), REST_Controller::HTTP_NOT_FOUND);
    }
  }


}
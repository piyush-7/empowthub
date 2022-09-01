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
    $this->load->helper(array('security','form','url'));
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
      $depart_id = $this->security->xss_clean($this->input->post("depart_id"));
      $desi_id = $this->security->xss_clean($this->input->post("desi_id"));
      $manager_id = $this->security->xss_clean($this->input->post("manager_id"));


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


       if($this->form_validation->run( $this->form_validation->set_rules("emp_name", "Name", "required|min_length[4]|alpha")) === FALSE)
       {

          //   // we have some errors
            $this->response(array(
              "status" => 0,
              "message" => "Name must be min 4 character"
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
        elseif($this->form_validation->run( $this->form_validation->set_rules("depart_id", "Depart_id", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Depart_id fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }

        elseif($this->form_validation->run( $this->form_validation->set_rules("desi_id", "Desi_id", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Desi_id fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }
        elseif($this->form_validation->run( $this->form_validation->set_rules("manager_id", "Manager_id", "required")) === FALSE)
        {
          $this->response(array(
            "status" => 0,
            "message" => "Manager_id fields are needed"
          ) , REST_Controller::HTTP_NOT_FOUND);

        }


          else
          {
      
            if(!empty($emp_name) && !empty($emp_email) && !empty($emp_password) && !empty($emp_add) && !empty($emp_mobile) && !empty($emp_gender) && !empty($emp_dob) && !empty($emp_pancard) && !empty($emp_joining) && !empty($emp_salary) && !empty($depart_id) && !empty($desi_id) && !empty($manager_id)){
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
                "depart_id" => $depart_id,
                "desi_id" => $desi_id,
                "manager_id" => $manager_id,
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


  public function index_delete()
  {
      $data = json_decode(file_get_contents("php://input"));

      $emp_id = $this->security->xss_clean($data->emp_id);  
      
      if($this->Emp_model->emp_delete($emp_id)){

        $this->response(array(
          "status" => 1,
          "messsage" => "Employee has been deleted"
        ), REST_Controller::HTTP_OK);


      }
      else{

        $this->response(array(
          "status" => 0,
          "messsage" => "Failed to deleted"
        ), REST_Controller::HTTP_NOT_FOUND);


      }
  }




  // public function index_put($data) //Normal method
  // {

    
  //   // $emp_name = $this->security->xss_clean($this->input->post("emp_name"));
  //   // $emp_email = $this->security->xss_clean($this->input->post("emp_email"));
  //   // $emp_password = $this->security->xss_clean($this->input->post("emp_password"));
  //   // $emp_add = $this->security->xss_clean($this->input->post("emp_add"));
  //   // $emp_mobile = $this->security->xss_clean($this->input->post("emp_mobile"));
  //   // $emp_gender = $this->security->xss_clean($this->input->post("emp_gender"));
  //   // $emp_dob = $this->security->xss_clean($this->input->post("emp_dob"));
  //   // $emp_pancard = $this->security->xss_clean($this->input->post("emp_pancard"));
  //   // $emp_joining = $this->security->xss_clean($this->input->post("emp_joining"));
  //   // $emp_salary = $this->security->xss_clean($this->input->post("emp_salary"));
  //   // $depart_id = $this->security->xss_clean($this->input->post("depart_id"));
  //   // $desi_id = $this->security->xss_clean($this->input->post("desi_id"));
     
  //   if($this->form_validation->run( $this->form_validation->set_rules("emp_name", "Name", "required")) === FALSE)
  //      {

  //         //   // we have some errors
  //           $this->response(array(
  //             "status" => 0,
  //             "message" => "Name fields are needed"
  //           ) , REST_Controller::HTTP_NOT_FOUND);
      
  //       }

  //       elseif($this->form_validation->run($this->form_validation->set_rules("emp_email", "Email", "required|valid_email|valid_emails|is_unique[tbl_employee.emp_email]")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Email fields are needed & Should be unique"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_password", "Password", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Password fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }


  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_add", "Address", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Address fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_mobile", "Mobile", "required|exact_length[10]|numeric")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Mobile fields are needed & Should be 10 digit"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_gender", "Gender", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Gender fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_dob", "emp_dob", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Dob fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_pancard", "Pancard", "required|exact_length[10]")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "PanCard fields are needed & Should be Combination of 10 Char & Digit"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_joining", "Date", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Joining Date fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }

  //       elseif($this->form_validation->run( $this->form_validation->set_rules("emp_salary", "Salary", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Salary fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }
  //       elseif($this->form_validation->run( $this->form_validation->set_rules("depart_id", "Department_id", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Department_id fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }
  //       elseif($this->form_validation->run( $this->form_validation->set_rules("desi_id", "Desi_id", "required")) === FALSE)
  //       {
  //         $this->response(array(
  //           "status" => 0,
  //           "message" => "Desi_id fields are needed"
  //         ) , REST_Controller::HTTP_NOT_FOUND);

  //       }


  //    else
  //    { 
        
  //       if($this->Emp_model->update_item($data)):

  //         $this->response(array(
  //           "status" => 1,
  //           "message" => "Employee has been Updated"
  //         ), REST_Controller::HTTP_OK);

  //       else:

  //         $this->response(array(
  //           "status" => 1,
  //           "message" => "Employee has been not updated"
  //         ), REST_Controller::HTTP_OK);


  //     endif;
        
  //    }
  // }


  public function index_put() //working with non validation
  {
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->emp_id) && isset($data->emp_name) && isset($data->emp_email) && isset($data->emp_password) && isset($data->emp_add) && isset($data->emp_mobile)&& isset($data->emp_gender)&& isset($data->emp_dob)&& isset($data->emp_pancard)&& isset($data->emp_joining)&& isset($data->emp_salary)&& isset($data->depart_id)&& isset($data->desi_id)){

      $employee_id = $data->emp_id;
      $emp_info = array(
        "emp_name" => $data->emp_name,
        "emp_email" => $data->emp_email,
        "emp_password" => $data->emp_password,
        "emp_mobile" => $data->emp_mobile,
        "emp_gender" => $data->emp_gender,
        "emp_dob" => $data->emp_dob,
        "emp_pancard" => $data->emp_pancard,
        "emp_joining" => $data->emp_joining,
        "emp_salary" => $data->emp_salary,
        "depart_id" => $data->depart_id,
        "desi_id" => $data->desi_id,
        
      );

      if($this->Emp_model->update_employee_information($employee_id, $emp_info)){

          $this->response(array(
            "status" => 1,
            "message" => "Employee Has been updated"
          ), REST_Controller::HTTP_OK);
      }else{

        $this->response(array(
          "status" => 0,
          "messsage" => "Failed to update Employee data"
        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{

      $this->response(array(
        "status" => 0,
        "message" => "All fields are needed"
      ), REST_Controller::HTTP_NOT_FOUND);
    }
  }

  
    // public function index_put($emp_id) //update third method
    // {
    //   $emp = new Emp_model;
    //   $data =array(
    //     'emp_name' => $this->put->post('emp_name'),
    //     'emp_email'=> $this->put->post('emp_email'),
    //     'emp_password' => $this->put->post('emp_password'),
    //     'emp_add' => $this->put->post('emp_add'),
    //     'emp_mobile' => $this->put->post('emp_mobile'),
    //     'emp_gender' => $this->put->post('emp_gender'),
    //     'emp_dob' => $this->put->post('emp_dob'),
    //     'emp_pancard' => $this->put->post('emp_pancard'),
    //     'emp_joining' => $this->put->post('emp_joining'),
    //     'emp_salary' => $this->put->post('emp_salary'),
    //     'depart_id' => $this->put->post('depart_id'),
    //     'desi_id' => $this->put->post('desi_id'));

    //     $reuslt = $emp->emp_update($emp_id,$data);

    //     if($reuslt > 0)
    //     {
    //       $this->response(array(
    //         "status" => 1,
    //         "message" => "Employee has been UPDATED"
    //       ), REST_Controller::HTTP_OK);
    //     }

    //     else{
    //       $this->response(array(
    //         "status" => 0,
    //         "message" => "Employee has been NOT UPDATED"
    //       ), REST_Controller::HTTP_NOT_FOUND);

    //     }
        

    // }



    public function emp_post()
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
      $depart_id = $this->security->xss_clean($this->input->post("depart_id"));
      $desi_id = $this->security->xss_clean($this->input->post("desi_id"));
      $manager_id = $this->security->xss_clean($this->input->post("manager_id"));

       //form validation
       $this->form_validation->set_rules("emp_name", "Name", "required|min_length[4]|alpha");
       $this->form_validation->set_rules("emp_email", "Email", "required|valid_email|valid_emails|is_unique[tbl_employee.emp_email],array('required' => 'Name must be min 4 character')");
       $this->form_validation->set_rules("emp_password", "Password", "required");
       $this->form_validation->set_rules("emp_add", "Address", "required");
       $this->form_validation->set_rules("emp_mobile", "Mobile", "required|exact_length[10],array('required' => 'Mobile Number Should be 10 digit')|numeric");
       $this->form_validation->set_rules("emp_gender", "Gender", "required");
       $this->form_validation->set_rules("emp_dob", "emp_dob", "required");
       $this->form_validation->set_rules("emp_pancard", "Pancard", "required|exact_length[10],array('required' => 'anCard fields are needed & Should be Combination of 10 Char & Digit')");
       $this->form_validation->set_rules("emp_joining", "Date", "required");
       $this->form_validation->set_rules("emp_salary", "Salary", "required");
       $this->form_validation->set_rules("desi_id", "Desi_id", "required");
       $this->form_validation->set_rules("depart_id", "Depart_id", "required");
       $this->form_validation->set_rules("manager_id", "Manager_id", "required");

        
       if ($this->form_validation->run() == FALSE) 
       {
        
       }
    }

    public function emp_find_get($emp_id)
    {
      $emp = new emp_model;
      $result = $emp->edit_emp($emp_id);

      $this->response($result,200);
    }
}
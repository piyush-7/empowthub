<?php 

require APPPATH.'libraries/REST_Controller.php';

class Department extends REST_Controller{

    public function index_put()
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



    $this->form_validation->set_rules("emp_name", "Name", "required|min_length[4]|alpha, array('required' => 'Name Must be 4 Character')");
    $this->form_validation->set_rules("emp_email", "Email", "required|valid_email|valid_emails|is_unique[tbl_employee.emp_email], array('required' => 'Email Already Exist')");
    $this->form_validation->set_rules("emp_password", "Password", "required");
    $this->form_validation->set_rules("emp_add", "Address", "required");
    $this->form_validation->set_rules("emp_mobile", "Mobile", "required|exact_length[10]|numeric, array('required' => 'Mobile No. Must Be 10 digit')");
    $this->form_validation->set_rules("emp_gender", "Gender", "required");
    $this->form_validation->set_rules("emp_dob", "DOB", "required");
    $this->form_validation->set_rules("emp_pancard", "Pancard", "required|exact_length[10]");
    $this->form_validation->set_rules("emp_joining", "Joining", "required");
    $this->form_validation->set_rules("emp_salary", "Salary", "required");
    $this->form_validation->set_rules("depart_id", "Depart_id", "required");
    $this->form_validation->set_rules("desi_id", "Desi_id", "required");

    if($this->form_validation->run() === FALSE){

      //   // we have some errors
        $this->response(array(
          "status" => 0,
          "message" => "All fields are needed"
        ) , REST_Controller::HTTP_NOT_FOUND);
      }

      else
      {
        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->emp_id) && isset($data->emp_name) && isset($data->emp_email) && isset($data->emp_password) && isset($data->emp_add) && isset($data->emp_mobile)&& isset($data->emp_gender)&& isset($data->emp_dob)&& isset($data->emp_pancard)&& isset($data->emp_joining)&& isset($data->emp_salary)&& isset($data->depart_id)&& isset($data->desi_id))
        {
    
                  $employee_id = $data->$emp_id;
                  $employee_info = array(
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
        );
    
          if($this->Emp_model->update_employee_information($employee_id, $employee_info)){
    
              $this->response(array(
                "status" => 1,
                "message" => "Student data updated successfully"
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



  }
    
}
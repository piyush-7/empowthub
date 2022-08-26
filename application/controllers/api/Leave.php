<?php



    require APPPATH.'libraries/REST_Controller.php';

    class Leave extends REST_Controller 
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
            $leave_reason = $this->security->xss_clean($this->input->post("leave_reason"));
            $start_date = $this->security->xss_clean($this->input->post("start_date"));
            $end_date = $this->security->xss_clean($this->input->post("end_date"));
            $emp_id = $this->security->xss_clean($this->input->post("emp_id"));

            if($this->form_validation->run( $this->form_validation->set_rules("leave_reason", "Leave Reason", "required")) === FALSE)
            {

          //   // we have some errors
            $this->response(array(
              "status" => 0,
              "message" => "Leave Reason fields are needed"
            ) , REST_Controller::HTTP_NOT_FOUND);
      
            }



            if($this->form_validation->run( $this->form_validation->set_rules("start_date", "Start Date", "required")) === FALSE)
            {

          //   // we have some errors
            $this->response(array(
              "status" => 0,
              "message" => "Start Date fields are needed"
            ) , REST_Controller::HTTP_NOT_FOUND);
      
            }


            if($this->form_validation->run( $this->form_validation->set_rules("end_date", "End Date", "required")) === FALSE)
            {

          //   // we have some errors
            $this->response(array(
              "status" => 0,
              "message" => "End Date fields are needed"
            ) , REST_Controller::HTTP_NOT_FOUND);
      
            }
            if($this->form_validation->run( $this->form_validation->set_rules("emp_id", "Emp_id", "required|is_unique[tbl_leave.emp_id]")) === FALSE)
            {

          //   // we have some errors
            $this->response(array(
              "status" => 0,
              "message" => "Leave Request Already Created"
            ) , REST_Controller::HTTP_NOT_FOUND);
      
            }




            else
            {
            

                if(!empty($leave_reason) && !empty($start_date) && !empty($end_date) && !empty($emp_id))
                {

                $leave = array("leave_reason"=>$leave_reason,
                                  "start_date"=> $start_date,
                                  "end_date" => $end_date,
                                  "emp_id"=>$emp_id                
                                );



                                if($this->Emp_model->leave_insert($leave))
                                {
                        
                                  $this->response(array(
                                    "status" => 1,
                                    "message" => "Leave Request has been created"
                                  ), REST_Controller::HTTP_OK);
                                }
                                else
                                {
                        
                                  $this->response(array(
                                    "status" => 0,
                                    "message" => "Failed to create Leave Request"
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



          public function index_get()
        {
          $leave = $this->Emp_model->leave_fetch();

          if(count($leave)>0){

            $this->response(array(
              "status" => 1,
              "message" => "All Leave found",
              "data" => $leave
            ), REST_Controller::HTTP_OK);
          }else{

            $this->response(array(
              "status" => 0,
              "message" => "No Leave found",
              "data" => $leave
            ), REST_Controller::HTTP_NOT_FOUND);
          }
        }


        public function index_delete()
        {
          $data = json_decode(file_get_contents("php://input"));

          $leave_id = $this->security->xss_clean($data->leave_id);  
          
          if($this->Emp_model->emp_delete($leave_id)){
    
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


       




    }

        


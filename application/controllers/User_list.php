<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('user_model');
		}
	

	public function index()
		{
			// echo "skgfshg";die;
		$this->load->view('user_list');
		
		}
		public function fetch_data(){
			
			
			$result=$this->user_model->get_user_list();
			if(!empty($result)){
				
				echo json_encode($result);
			}else{
				
				echo json_encode($result);
			}
		}
		// public function fetch_data_for_edit(){
			
		// 	 $u_id = $this->security->xss_clean(trim($this->input->post('val')));
	   
		// 	$result=$this->admin_model->get_user_list_by_id($u_id);
			
	    // if(!empty($result)){
	    // 	$data=array('status'=>true, 'result'=>$result[0]);
	    // 	echo json_encode($data);
	    // }else{
	    // 	$data=array('status'=>false, 'result'=>'');
	    // 	echo json_encode($data);
	    // }
		// }

		public function total_user_data(){
			// if(!isset($this->session->userdata['admin_logged_in'])){
			// 	redirect('login');
			// }
			
			// $from_date_ymd = date('Y-m-d');
			// $to_date_ymd   = date('Y-m-d');
			// if(isset($_GET['from_date'])){
			// 	$from_date_ymd = date('Y-m-d', strtotime($_GET['from_date']));
			// 	$to_date_ymd = date('Y-m-d', strtotime($_GET['to_date']));
			// }
		// echo $from_date_ymd."--".$to_date_ymd;
			// $login_id = $this->session->userdata['admin_logged_in']['login_id'];
			// $user_id = $this->session->userdata['admin_logged_in']['id'];
			// $data['get_tl_wise_download_data'] = $this->Login_database->getTLWiseTotalDownloadData($from_date_ymd, $to_date_ymd);
			 $this->load->view('user_list_data');
		}





















public function user_data_store()
{

	
	$u_name=$this->security->xss_clean(trim($this->input->post('u_name')));
	$email=$this->security->xss_clean(trim($this->input->post('email')));
	$subject=$this->security->xss_clean(trim($this->input->post('subject')));
	$date_val=$this->security->xss_clean(trim($this->input->post('date_val')));
	$msg=$this->security->xss_clean(trim($this->input->post('msg')));
	$time_val=$this->security->xss_clean(trim($this->input->post('time_val')));

	
	$combined_date_and_time = $date_val . ' ' . $time_val;
	$past_date = strtotime($combined_date_and_time);
	// echo $past_date;die;
	
	
	//   echo $u_name;
	//   echo $email;
	//   echo $subject;
	//   echo $date_val;
	//   echo $msg;
	//   echo $time_val;
	//   die;
	$file_name=$_FILES['profile_image']['name'];
	$tmp_file_name=$_FILES['profile_image']['tmp_name'];
	$file_size=$_FILES['profile_image']['size'];
	$file_type=str_replace('image/', '', $_FILES['profile_image']['type']);

	$destination='assets/user_image/';

	$new_tmp_file_name='img_'.time().'_'.$file_name;
	$new_file_name=$destination.$new_tmp_file_name;

	if (!empty($file_name) and ($file_size)> 500000 ) 
	{
		$this->session->set_flashdata('msg_error', 'Maximum File size allowed is 500KB');
		redirect('form');
	}
	$file_type_arr=array('jpg','jpeg','JPG','JPEG','png','PNG');

	if(!empty($file_name) and  !in_array($file_type, $file_type_arr)){
		$this->session->set_flashdata('msg_error', 'Only allowed types are: '.implode(',', $file_type_arr));
		redirect('form');
	}
	if (!empty($file_name)) {
		
		if(!file_exists($new_file_name)){
			move_uploaded_file($tmp_file_name, $new_file_name);
		}
	}
	  echo "goutam";die;
	
    $todaydate=date('Y-m-d h:i:s');
	//var_dump($form_data);
	// $table = 'user_master';
	$check_exist_employee_val = $this->user_model->check_exist_employee($email);
	if($check_exist_employee_val>='1'){
		$this->session->set_flashdata('msg_error', 'This Employee Already Exist');
		   redirect('form');
	}	


	// $data = array(
	// 	'emp_code' => $emp_code,
	// 	'employee_code_new' => $emp_code,
	// 	'user_name' => $name,
	// 	'email' => $email,
	// 	'emp_mobile' => $mobile,
	// 	'password' => $password,
	// 	'normal_pass' => $normal_pass,
	// 	'status' => '1',
	// 	'user_type' => 'Employee',
	// 	'emp_type' => $emp_type,
	// 	'marketing_manager' => $marketing_manager,
	// 	'admin_image'=>$new_tmp_file_name,
	// 	'designation' => $designation,
	// 	'promo_code' => $promo_code,
	// 	'is_promo_limit_applicable' => $is_promo_limit_applicable,
	// 	'promo_limit' => $promo_limit,
	// 	'created_time' => $created_time,
	// 	'discount' => $discount,
	// 	'has_escalation_view' => $has_escalation,
	// 	'other_state' =>$other_state,
	// 	'reporting_manager_id'=>$team_lead,
	// 	'emp_dept'=>$inbo_out

	// );



	// $result = $this->Login_database->AddEmplyee($data);
	// if($result==1)
	// {
	// 	$this->session->set_flashdata('msg_succ', 'Saved Successfully!');
	// 	redirect('AllEmployee');

	// }
	// die();
// 	else if($user_id !=''){

// 	$update_data=array(
// 						'user_name' => $u_name,
// 						'full_name' => $name,
// 						'status' => 1,
						
// 						'updated_ts'=>$todaydate,
// 						'email'=>$email,
// 						'password' =>$password
// 					);
// $data = $this->admin_model->updateData($table, $update_data, $user_id);
//     		if($data){
// 				echo 2;
// 			}else{
// 				echo 0;
// 			}

// 	}
// 	else{

// 	$insert_data=array(
// 						'user_name' => $u_name,
// 						'full_name' => $name,
// 						'status' => 1,
						
// 						'created_ts'=>$todaydate,
// 						'email'=>$email,
// 						'password' =>$password
// 					);
// 					$data=$this->admin_model->submit_data_store($insert_data);
// 					echo 1;
		
			
				
// }

}












	
	
}
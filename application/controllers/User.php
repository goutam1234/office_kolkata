<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		$this->load->model('admin_model');
		}
	

	public function index()
		{
		$this->load->view('user_list');
		
		}
		public function fetch_data(){
			
			
			$result=$this->admin_model->get_user_list();
			if(!empty($result)){
				
				echo json_encode($result);
			}else{
				
				echo json_encode($result);
			}
		}
		public function fetch_data_for_edit(){
			
			 $u_id = $this->security->xss_clean(trim($this->input->post('val')));
	   
			$result=$this->admin_model->get_user_list_by_id($u_id);
			
	    if(!empty($result)){
	    	$data=array('status'=>true, 'result'=>$result[0]);
	    	echo json_encode($data);
	    }else{
	    	$data=array('status'=>false, 'result'=>'');
	    	echo json_encode($data);
	    }
		}


public function user_data_store()
{
	$u_name=$this->input->post('u_name');
	
	$name=$this->input->post('name');
	$email=$this->input->post('email');
	$password=$this->input->post('password');
	$user_id=$this->input->post('user_id');
	
	
    	$todaydate=date('Y-m-d h:i:s');
	//var_dump($form_data);
	$table = 'user_master';
	$check_existing_data = $this->admin_model->checkExistingusername($table,$u_name);
    	if(count($check_existing_data) > 0 && $user_id==''){
			
				echo 0;
			
    	}
	else if($user_id !=''){

	$update_data=array(
						'user_name' => $u_name,
						'full_name' => $name,
						'status' => 1,
						
						'updated_ts'=>$todaydate,
						'email'=>$email,
						'password' =>$password
					);
$data = $this->admin_model->updateData($table, $update_data, $user_id);
    		if($data){
				echo 2;
			}else{
				echo 0;
			}

	}
	else{

	$insert_data=array(
						'user_name' => $u_name,
						'full_name' => $name,
						'status' => 1,
						
						'created_ts'=>$todaydate,
						'email'=>$email,
						'password' =>$password
					);
					$data=$this->admin_model->submit_data_store($insert_data);
					echo 1;
		
			
				
}

}












	
	
}
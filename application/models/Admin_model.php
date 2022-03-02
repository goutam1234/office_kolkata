<?php
	class Admin_model extends CI_model
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->database();
		}

		public function get_user_list(){
        $this->db->select('um.full_name,um.user_id');
        $this->db->from('user_master as um');
       
        $this->db->where('um.status',1);
        $query=$this->db->get();
        $data= $query->result();
	return $data;
	
    }
public function get_user_list_by_id($u_id){
        $this->db->select('um.*');
        $this->db->from('user_master as um');
       
        $this->db->where('um.user_id',$u_id);
        $query=$this->db->get();
        $data= $query->result();
	return $data;
	
    }

public function checkExistingusername($table,$u_name){
        $query = $this->db->where('user_name', $u_name)->get($table);
        // echo $this->db->last_query();die;
        return $query->result();
    }

public function submit_data_store($insert_data){
       
        $ins=$this->db->insert('user_master',$insert_data);
        //echo $this->db->last_query();die();
        return $ins;
    }
public function updateData($table,$updateArray,$user_id){
        $query = $this->db->set($updateArray)->where('user_id', $user_id)->update($table);
        return $query;
    }
 
	


	}
?>
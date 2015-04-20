<?php

class Admin_model extends CI_Model {

	public function get_db_session_data(){
		$query = $this->db->select('user_id')->get('admin');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row){
		    $udata = unserialize($row->user_data);
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}

	public function get_admin_id(){
		$query = $this->db->select('user_id')->get('admin');
		return $query->result_array();
	}
	public function is_admin($id){
		$query = $this->db->select('user_id')->where('user_id',$id)->get('admin');
		if($query->num_rows == 1){
			return true;
		}else{
			return false;
		}
	}
	public function get_all_user(){
		$query = $this->db->select('*')->get('users');
		return $query->result_array();
	}
}


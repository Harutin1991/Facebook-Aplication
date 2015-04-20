<?php
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}
	
	function index($id){
		if(!$this->validate_credentials($id)){
			redirect('exitapp/nonadmin');
		}
		$users = $this->admin_model->get_all_user();
		
		$this->load->model('polls_model');
		$user_poll = array();
		foreach($users as $key=>$user){
			$count_poll = $this->polls_model->pollcount($user['uid']);
			$user_poll[$key][] = $user;
			$user_poll[$key]['count_poll'] = $count_poll;
		}
		$data['users'] = $user_poll;
		$data['main_content'] = 'admin/admin_profile';
		$this->load->view('includes/template', $data);
	}
	public function validate_credentials($id){	
		$admin_id = $this->admin_model->get_admin_id();
		$admins = array();
		foreach($admin_id as $key=>$val){
			$admins[] = $val['user_id'];
		}
		if(!in_array($id,$admins)){
			return false;
		}else{
			return true;
		}
	}	

}	
	
?>
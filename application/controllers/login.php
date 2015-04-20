<?php

class Login extends CI_Controller {

	public function __construct(){
			parent::__construct();
			parse_str($_SERVER['QUERY_STRING'], $_REQUEST );
			$CI = & get_instance();
			$CI->config->load("facebook",TRUE);
			$config = $CI->config->item('facebook');
			$this->load->library('Facebook', $config);
			$this->load->model('polls_model');
			
	}
	public function login_user(){
		//$param = func_get_args(); 
		if(isset($_POST['signed_request'])){
		$user_data = parse_signed_request($_POST['signed_request']);
			if(isset($user_data['user_id']) && !empty($user_data['user_id'])){
				$uid = $user_data['user_id'];
					if($this->polls_model->getuser($uid)){
						redirect('/myapp/index/');
					}
				}
		}
			if(isset($_POST['id'])){
				$data_user = $this->facebook->api("{$_POST['id']}");
				if($data_user['link']){
					$link = $data_user['link'];
				}else{
					$link = "NULL";
				}
				if(isset($_POST['email']) && !empty($_POST['email'])){
					$email = $_POST['email'];
				}else{
					$email = "NULL";
				}
				
				$data_to_store = array(
								'uid' => $data_user['id'],
								'firstname' => $data_user['first_name'],
								'lastname' => $data_user['last_name'],
								'email' => $email,
								'link' => $link
				);
				$session_data = array('user_id' => $data_user['id']);
				$this->session->unset_userdata('signed_request');
				$this->session->set_userdata($session_data);
				if($this->polls_model->storeuserid($data_to_store)){
					redirect('myapp/index/');
				}	
			}
				//$data['segmen1'] = $param[0];
				//$data['segmen2'] = $param[1];
				$data['main_content'] = 'app/login';
                $this->load->view('includes/template', $data); 
	}
	public function nodate(){
			$data['message'] = 'No Result';
			$this->load->view('app/nodate', $data); 
	}

}
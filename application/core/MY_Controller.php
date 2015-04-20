<?php

class MY_Controller extends CI_Controller {

		public function __construct(){
			parent::__construct();
			parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
			$CI = & get_instance();
			$CI->config->load("facebook",TRUE);
			$config = $CI->config->item('facebook');
			$this->load->library('Facebook', $config);
			$this->load->model('polls_model');
			
			if(isset($_POST['signed_request'])){
				$user_request = parse_signed_request($_POST['signed_request']);
				if(isset($user_request['user_id']) && $user_request['user_id']){
					if(isset($this->session->userdata['user_id'])){
							
							if($user_request['user_id'] != $this->session->userdata['user_id']){
								$this->session->unset_userdata('user_id');
								$this->session->unset_userdata('signed_request');
								$user_data = array('user_id' => $user_request['user_id']);
								
								$this->session->set_userdata($user_data);
							}
					}else{
						$this->session->unset_userdata('user_id');
						$this->session->unset_userdata('signed_request');
						$user_data = array('user_id' => $user_request['user_id']);
						$this->session->set_userdata($user_data);
					}
				}elseif(!$user_request['user_id']){
						redirect('exitapp/start_poll');
				}
			}
				if(!isset($this->session->userdata['user_id']) || !$this->session->userdata['user_id']){
					redirect('exitapp/start_poll');
				}
				
				
				//var_dump($arr);
		}
}
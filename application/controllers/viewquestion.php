<?php

class Viewquestion extends CI_Controller {

		public function __construct(){
			parent::__construct();
			parse_str($_SERVER['QUERY_STRING'], $_REQUEST );
			$CI = & get_instance();
			$CI->config->load("facebook",TRUE);
			$config = $CI->config->item('facebook');
			$this->load->library('Facebook', $config);
			$this->load->model('polls_model');
			
			if(isset($_POST['signed_request'])){
	$user_request = parse_signed_request($_POST['signed_request']);
		if(isset($user_request['oauth_token'])){
		$response = file_get_contents('https://graph.facebook.com/oauth/access_token?client_id=1421106854794084&client_secret=5887e02e4c087f79b0adc0663188c305&grant_type=fb_exchange_token&fb_exchange_token='.$user_request['oauth_token']);
					$params = null;
					parse_str($response, $params);
					$store_session_data = array(
						'user_id'=> $user_request['user_id']
					);
					$this->session->unset_userdata('signed_request');
					$this->session->set_userdata($store_session_data);
			}elseif(!isset($user_request['user_id'])){
				$this->session->unset_userdata('user_id');
				$signed_request = array('signed_request' => $_POST['signed_request']);
				$this->session->set_userdata($signed_request);
			}
		}
			
			
		}
		function index(){	
			$app_config = $this->facebook->api('1421106854794084');
			$param = func_get_args();
			if(isset($_POST['signed_request'])){
					$user_data = parse_signed_request($_POST['signed_request']);	
					
						if(isset($user_data['user_id']) && !empty($user_data['user_id'])){
							$data['user_data'] = $user_data['user_id'];		
							$_SESSION['uid'] = $user_data['user_id'];	
						}else{
							$data['user_data'] = false;
						}
			}else{
				$data['user_data'] = false;
			}
			if(!empty($param[0])){
				$url = 'https://apps.facebook.com/'.$app_config["namespace"].'/viewquestion/'.$param[0];
				$data['url']=$url;
				$data['question'] = $this->polls_model->find_quest_by_url($url);
				if(!empty($data['question'])){
					$poll_id =$data['question'][0]['poll_id'];
					$data['info'] = $this->polls_model->getuserpoll_by_id_for_users($poll_id);
				}
				
					if(!empty($data['question'])){
						$data['text'] = $this->polls_model->get_text($data['question'][0]['poll_id']);
						foreach(unserialize($data['text'][0]['text']) as $key=>$text){
							$data['poll_text'][$key] = $text;
						}
					}
				$data['main_content'] = 'app/view_quest';
				$this->load->view('includes/template', $data);
			}else{
				$data['message'] = "No Qestion";
				$this->load->view('app/nodate', $data);
			}
		}
		
		
		
}
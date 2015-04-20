<?php

class Viewresult extends CI_Controller {

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
					$this->session->set_userdata($store_session_data);
			}elseif(!isset($user_request['user_id'])){
				$this->session->sess_destroy();
				$signed_request = array('signed_request' => $_POST['signed_request']);
				$this->session->set_userdata($signed_request);
			}
		}
		}
		function index($numb){
			$app_config = $this->facebook->api('1421106854794084');
			$url = 'https://apps.facebook.com/'.$app_config["namespace"].'/viewresult/'.$numb;
			$poll_id = $this->polls_model->get_poll_id_by_url($url);
			$data['qa'] = $this->polls_model->poll_quest_answer($poll_id[0]['id']);
			$data['answer_name'] = $this->polls_model->get_answer($poll_id[0]['id']);
			$key1 = array();
			
			foreach($data['qa'] as $qa){
				$value[] = unserialize($qa['answered']);
			}
		
			foreach($value as $val){
				foreach ($val as $key=>$res){
					$a[$key][] = $res;
				}
			}
		$result = array();
		foreach($a as $key=>$answ){
			$k=explode('_',$key);
			if($k[0]=="textbox"||$k[0]=="email"||$k[0]=="textareabox"){}
			elseif($this->polls_model->get_quest($k[1])){
				if($k[0] == "chekbox"){
						$name=array();
					foreach($answ as $akey=>$aval){
						foreach($aval as $value){
							$name[] = $value;
						}
					}
						$result[]=array_count_values($name);
				}else{			
					$result[]=array_count_values($answ);
				}
					
			}
		}
			$data['text'] = $this->polls_model->get_text($poll_id[0]['id']);
			foreach(unserialize($data['text'][0]['text']) as $key=>$text){
				$data['poll_text'][$key] = $text;
			}
			$data['value'] = $result;
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id_for_users($poll_id[0]['id']);
			$data['main_content'] = 'app/view_result';
			$this->load->view('includes/template', $data);
		}
}
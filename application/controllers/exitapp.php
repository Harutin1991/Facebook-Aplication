<?php

class Exitapp extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$CI = & get_instance();
			$CI->config->load("facebook",TRUE);
			$config = $CI->config->item('facebook');
			$this->load->library('Facebook', $config);
		$this->load->model('polls_model');
		if(isset($_POST['signed_request'])){
	$user_request = parse_signed_request($_POST['signed_request']);
	//$app_config = $this->facebook->api('1421106854794084/roles?limit=5000&offset=5000&offset=0');
	//out($app_config);die;
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
	
	public function index(){
			$data['message'] = 'You don`t Register';
			$data['main_content'] = 'app/nodate';
			$this->load->view('includes/template', $data);
	}
	public function nonadmin(){
		$data['message'] = 'You don`t Admin';
		$data['main_content'] = 'app/nodate';
		$this->load->view('includes/template', $data);
	}
	public function start_poll(){
		if(isset($this->session->userdata['user_id']) && $this->polls_model->getuser($this->session->userdata['user_id'])){
			
			redirect('myapp/index');		
		}else{
			$data['user_data'] = false;
		}
		$data['main_content'] = 'app/start_poll';
		$this->load->view('includeforexitapp/template', $data);
			
	}
	// public function addpoll(){
			// if(isset($this->session->userdata['user_id'])){
				//out($this->session->userdata['user_id']);
				// $data['user_data'] = isset($this->session->userdata['user_id']);
				// $data['poll_user'] = $this->session->userdata['user_id'];
			// }else{
				// $data['user_data'] = false;
			// }
			
			// $app_config = $this->facebook->api('1421106854794084/roles?limit=5000&offset=5000&offset=0');
			
			// $arr = array();
			// $app_config=$app_config["data"];
			// foreach($app_config as $k=>$v){
				
				// $arr[$k]=$v["user"];
			// }
			// $data['user']=$arr;

		// $data['segment'] = 'includeforexitapp/segments';
		// $data['main_content'] = 'app/newpoll';
		// $this->load->view('includeforexitapp/template', $data);  
	// }
	
	public function chek($id){
			if($this->input->post()){
				if($this->session->userdata('signed_request')){
					$uid = 'anonymouse';
				}else{
					$uid = $this->session->userdata('user_id');
				}
				$this->load->helper('date');
				$date = now();
				$datestring = "%Y-%m-%d-%h-%i";
				$question_answered = serialize($this->input->post());
				
				$data_to_store = array(
					'poll'     =>   $id,
					'user_id'  => 	$uid,
					'answered' => 	$question_answered,
					'date'     =>   mdate($datestring, $date)
				);
				$user_id = $this->polls_model->get_user_by_pollid($id);
				$href = 'myapp/result/'.$id;
					if($this->polls_model->chek($data_to_store)){
							$this->send_notification($user_id,$href);
							$poll_user_id = $this->polls_model->get_user_by_pollid($id);
							$poll_name = $this->polls_model->getuserpoll_by_id($id,$poll_user_id[0]['user_id']);
							//if($uid != 'anonymouse'){
						//		$massage = 'I have answered the poll questions which name is '.$poll_name[0]['name'];
					//			$this->send_massage_chek($uid,$massage);
					//		}
							redirect('exitapp/thanks/'.$id);
					}
				
			}else{
				redirect('exitapp/start_poll');
					
			}
	}
	public function send_massage_chek($uid,$message){
		$response = $this->facebook->api( '/'.$uid.'/feed', 'POST', array(
				'message' => $message
            ) );    

	}
	public function send_notification($uid,$href){
		$CI = & get_instance();
		$CI->config->load("facebook",TRUE);
		$config = $CI->config->item('facebook');
		$app_access_token = $config['appId'] . '|' . $config['secret'];
		$response = $this->facebook->api( '/'.$uid[0]['user_id'].'/notifications', 'POST', array(

                'template' => 'You have received a new message.',

                'href' => $href,

                'access_token' => $app_access_token
            ) );    

	}
	public function thanks($id){
	if($this->session->userdata('signed_request')){
		$data['flesh_message'] = true;
	}else{
		$data['flesh_message'] = false;
	}
			$param = func_get_args();
			$app_config = $this->facebook->api('1421106854794084');
			if(!empty($param[0])){
				$url = 'https://apps.facebook.com/'.$app_config["namespace"].'/exitapp/thanks/'.$param[0];
				$data['url']=$url;
				$data['info'] = $this->polls_model->getuserpoll_by_id_for_users($param[0]);
				
			}
			$thanks = $this->polls_model->get_text($id);
			foreach(unserialize($thanks[0]['text']) as $key=>$text){
				$data['thanks'][$key] = $text;
			}
			$data['main_content'] = 'app/thanks';
			$this->load->view('includes/template', $data);
	}
	
	
	public function result(){
	
		$param = func_get_args();
		$dat = array();
		$dat2 = array();
		$user_id = null;
		
		
		
			$config['per_page'] = 3;
			$config['base_url'] = base_url("myapp/result").'/'.$param[0].'/';
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = 20;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['uri_segment'] = 4;

			$page = $this->uri->segment(4);

			$limit_end = ($page * $config['per_page']) - $config['per_page'];
				if ($limit_end < 0){
					$limit_end = 0;
				}
			$data['poll_quest'] = $this->polls_model->poll_quest($param[0],$user_id);
			$users_answer = $this->polls_model->user_answer($param[0],$config['per_page'],$limit_end);
			//$data['answered_user_id'] = $this->polls_model->get_answer_user_id($id);
			$this->load->helper('date');
			
			if($users_answer){
					$data['result'] = true;
			}else{
					$data['result'] = false;
					$data['message'] = "No Result";
			}
			$i = 0;
			$ar = array();
				foreach($users_answer as $key=>$usr_answer){
				
					//	$count = count($users_answer);
						$answered = unserialize($usr_answer['answered']);
						
						foreach($answered as $k=>$v){ 
							$arr[] = explode('_',$k);
							$question_name[] = $this->polls_model->question_name($arr[$i][1]);
							if(!empty($question_name[$i][0])){
								$ar[$question_name[$i][0]['question']] = $v;
							}
							$i++;
						}
						unset($usr_answer['answered']);
						if(!empty($ar)){
							$usr_answer['answered'] = $ar;
						}else{
							$data['result'] = false;
							$data['message'] = "No Result";
						}
						$data['users_answer'][] = $usr_answer;
						
				}
			$app_config = $this->facebook->api('1421106854794084');
			if(!empty($param[0])){
				$url = 'https://apps.facebook.com/'.$app_config["namespace"].'/exitapp/result/'.$param[0];
				$data['url']=$url;
				$data['info'] = $this->polls_model->getuserpoll_by_id_for_users($param[0]);
				
			}
			
			
			
			$config['total_rows'] = count($this->polls_model->user_answer($param[0]));
			$data['result_type']="All";
			$data['total_rows'] = $config['total_rows']/$config['per_page'];
			$this->pagination->initialize($config);
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id($param[0],$user_id);
			//$data['segment'] = 'app/segments';
			$data['main_content'] = 'app/result';
			$this->load->view('includes/template', $data);
		
	}
	public function message_poll(){
		$data['main_content'] = 'app/message_poll';
		$this->load->view('includes/template', $data);
	
	}
	
	
	
}
?>
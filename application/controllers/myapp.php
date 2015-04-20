<?php
class Myapp extends MY_Controller {
	public $uid;
	public function __construct(){
		parent::__construct();
		if(isset($this->session->userdata['user_id'])){
			$this->uid = $this->session->userdata['user_id'];
		}else{
			redirect('exitapp/start_poll');
		}
		
	}
	
	function index(){
	//$app_config = $this->facebook->api('1421106854794084/roles?limit=5000&offset=5000&offset=0');
	//out($app_config);exit;
			$config['per_page'] = 5;
			$config['base_url'] = base_url("myapp/index");
			$config['use_page_numbers'] = true;
			$config['num_links'] = 20;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$page = $this->uri->segment(3);
			$limit_end = ($page * $config['per_page']) - $config['per_page'];
				if ($limit_end < 0){
					$limit_end = 0;
				}
				$data['user'] = true;
				$config['total_rows'] = $this->polls_model->pollcount($this->uid);
				$poll_answer = $this->polls_model->get_poll_answer_count($this->uid);
				
					$p_a = array();
					foreach($poll_answer as $key=>$pa){
							$p_a[$pa['id']][] = $pa['answer'];
					}
				$data['result'] = $p_a;
				
				$data['total_rows'] = $config['total_rows']/$config['per_page'];
				$this->pagination->initialize($config);
                $data['user_poll'] = $this->polls_model->getuserpoll($this->uid,$config['per_page'],$limit_end);
				$data['user_account'] = $this->polls_model->get_user($this->uid);
				$data['main_content'] = 'app/base';
                $this->load->view('includes/template', $data);  

	}
	public function account($id){
		if($id == $this->uid){
			$data['user_account'] = $this->polls_model->get_user($this->uid);
			$this->load->model('admin_model');
			$data['is_admin'] = $this->admin_model->is_admin($this->uid);
			$data['poll_count'] = $this->polls_model->pollcount($this->uid);
			$data['user'] = $this->polls_model->get_user($id);
			$data['main_content'] = 'app/account';
			$this->load->view('includes/template', $data);
		}else{
			redirect('myapp/nodate/This is not your account id');
		}
	}
	public function update_user_date(){
		if($_POST['name'] == 'firstname'){
			$first_name = $_POST['value'];
			$datastore = array(
					'firstname' => $first_name
			);
			$this->polls_model->updateuser($this->uid,$datastore);
		}
		if($_POST['name'] == 'lastname'){
			$last_name = $_POST['value'];
			$datastore = array(
					'lastname' => $last_name
			);
			$this->polls_model->updateuser($this->uid,$datastore);
		}
		if($_POST['name'] == 'email'){
			$email = $_POST['value'];
			$datastore = array(
					'email' => $email
			);
			$this->polls_model->updateuser($this->uid,$datastore);
		}
		
	}
	public function addpoll(){
			if(isset($this->uid)){
				$data['user_data'] = $this->uid;		
			}else{
				$data['user_data'] = false;
			}
			$data['poll_user'] = $this->polls_model->getpolluser($this->uid);
			$app_config = $this->facebook->api('1421106854794084/roles?limit=5000&offset=5000&offset=0');
			//out($app_config);
			$arr = array();
			$app_config=$app_config["data"];
			foreach($app_config as $k=>$v){
				
				$arr[$k]=$v["user"];
			}
			$data['user']=$arr;
			$data['segment'] = 'app/segments';
			$data['main_content'] = 'app/newpoll';
			$this->load->view('includes/template', $data);  
	}
	public function edittable($id){
		if(isset($_POST['value'])){
			$data_store = array(
							'share_text' => $_POST['value']
						);
			if($this->polls_model->store_share_text($data_store,$id)){
				echo 'hello';
			}
		}
	}
	public function nodate($message = "No Result"){
			$message = urldecode($message);
			$data['message'] = $message;
			$this->load->view('app/nodate', $data); 
	}
	
      
    function add(){
		
			$this->load->helper('date');
			$date = now();
			$datestring = "%Y-%m-%d-%h-%i";
			$url_data = md5($this->input->post('pollname').now());
			$url_result = md5($this->input->post('pollname').md5(now()));
			$app_config = $this->facebook->api('1421106854794084');
			$url = 'https://apps.facebook.com/'.$app_config["namespace"].'/viewquestion/'.substr($url_data,0,5);
			$result_shar_url = 'https://apps.facebook.com/'.$app_config["namespace"].'/viewresult/'.substr($url_result,0,5);
			$polledit = serialize($this->input->post('polledit'));
		  
			$data_to_store = array(
						'name' => $this->input->post('pollname'),
						'text' => $polledit,
						'user_id' => $this->uid,
						'date' => mdate($datestring, $date),
						'link' => $url,
						'result_share_url' => $result_shar_url
			);
			
			if($this->polls_model->addpoll($data_to_store)){
				
					$id = $this->db->insert_id();
					$count_poll = $this->polls_model->pollcount($this->uid);
					
					//$this->send_massage($this->uid,$count_poll);
					
					redirect('myapp/question/'.$id);
			}
			else{ 
					redirect('myapp/addpoll');
			}
             
	}
 
	public function description(){

		$param = func_get_args(); 
		$dat = array();
		$dat2 = array();
		if(!empty($param[0])){
			$dat = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
			$dat2 = $this->polls_model->getpolluser($this->uid);
			
		}
		 if(empty($dat) || empty($dat2)){
				$data['main_content'] = 'app/notfound';
				$this->load->view('includes/template', $data);
		}else{
				if($this->input->server('REQUEST_METHOD') === 'POST'){
		
				if(is_array($this->input->post('polledit'))){
						$polledit = serialize($this->input->post('polledit'));
				  }
				$data_to_store = array(
							'name' => $this->input->post('pollname'),
							'text' => $polledit,
							'user_id' => $this->uid
				  );
				  if($this->polls_model->updatepoll($param[0],$data_to_store)){
						redirect('myapp/question/'.$param[0]);
					}
				}
				
		   $data['segment'] = 'app/segments';
		   $data['poll_user'] = $this->polls_model->getpolluser($this->uid);
		   $data['user_poll'] = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
		   $data['main_content'] = 'app/description';
		   $this->load->view('includes/template', $data);
		}

	}

	public function question(){
			
		$param = func_get_args();
		$dat = array();
		if(is_array($param) && !empty($param[0])){
			$dat = $this->polls_model->getpollquetion($param[0]);
			$dat2 = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
		}
		 if(!$dat && !$dat2){
				$data['main_content'] = 'app/notfound';
				$this->load->view('includes/template', $data);
		}else{
			$data['segment'] = 'app/segments';
			$data['poll_question'] = $this->polls_model->getpollquetion($param[0]);
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
			//out($data['poll_question']);
			$data['main_content'] = 'app/create_question';
			$this->load->view('includes/template', $data);  
			
		}
		
	}
	public function share(){
		$param = func_get_args();
		
		$dat = array();
		if(is_array($param) &&!empty($param[0])){
			$dat = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
		}
		 if(!$dat){
				$data['main_content'] = 'app/notfound';
				$this->load->view('includes/template', $data);
		}else{
			$data['segment'] = 'app/segments';
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
			$data['main_content'] = 'app/share';
			$this->load->view('includes/template', $data); 
		}
	
	}
	public function user_poll_question($id){
		$poll_answer = $this->polls_model->get_poll_answer_count($this->uid);
			$p_a = array();
				foreach($poll_answer as $key=>$pa){
						$p_a[$pa['id']][] = $pa['answer'];
				}
		$data['result'] = $p_a;
		$data['user_poll_question'] = $this->polls_model->user_poll_question($id);
		$data['main_content'] = 'app/user_poll_question';
		$this->load->view('includes/template', $data); 
	}
	public function add_question($id){
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$this->load->helper('date');
				$date = now();
				$datestring = "%Y-%m-%d-%h-%i";
				if(is_array($this->input->post('question_choices'))){
					$question_choices = serialize($this->input->post('question_choices'));
				}
				if(is_array($this->input->post('question_scale'))){
					$question_scale = serialize($this->input->post('question_scale'));
				}
				$question_link = $this->input->post('question_link');
				if(isset( $question_link)){
					if(is_array($this->input->post('question_link'))){
						$answer_link = serialize($this->input->post('question_link'));
					}else{
						$answer_link = serialize(array(0=>'0'));
					}
				}
				if($this->input->post('chek_link') == 'on'){
						$chek_link = 1;
				}else{
						$chek_link = 0;
				}
				$data_to_store = array(
						'question' => $this->input->post('question'),
						'question_type' => $this->input->post('question_type'),
						'question_choices' => $question_choices,
						'question_scale' => $question_scale,
						'poll_id'     => 	$id,
						'date' => mdate($datestring, $date),
						'edit_date' => mdate($datestring, $date),
						'link_type' => $chek_link,
						'answer_link' => $answer_link
				);

				if($this->polls_model->addquestion($data_to_store)){
						redirect('myapp/question/'.$id);
				}

			}
			$data['main_content'] = 'app/user_poll_question';
			$this->load->view('includes/template', $data); 

	}
	public function delete($id){
		$poll = $this->polls_model->getuserpoll_by_id($id,$this->uid);
		if(!empty($poll)){	
if($this->polls_model->delete_quest($id) && $this->delete_image($id) && $this->polls_model->delete_answered_poll($id)){
			if($this->polls_model->delete_poll($id)){
					redirect('myapp/index');
			}
		}
		}else{
			redirect('myapp/nodate/This is not your Poll');
		}
	}
	public function delete_image($id){
		$poll = $this->polls_model->getuserpoll_by_id($id,$this->uid);
		if(!empty($poll)){	
			$tmp_path = $this->polls_model->get_path_poll_image($id);
			if(!empty($tmp_path[0]['path'])){
				$path = $tmp_path[0]['path'];
				$arr = explode('/',$path);
				unset($arr[count($arr)-1]);
				$dir_name = implode('/',$arr);
				if(unlink($tmp_path[0]['path'])){
					if(rmdir($dir_name)){
						return true;
					}else{
						return false;
					}
				
				}
			}elseif(empty($tmp_path[0]['path'])){
				return true;
			}
		}

	}

	public function delete_quest(){
		$param = func_get_args();
		$poll = $this->polls_model->getuserpoll_by_id($param[1],$this->uid);
		if(!empty($poll)){		
			if($this->polls_model->delete_quest($param[0])){
				$question = $this->polls_model->getpollquetion($param[1]);	
					if(empty($question)){
						$this->polls_model->delete_answered_poll($param[1]);
					}
					redirect('myapp/question/'.$param[1]);
			}
		}else{
			redirect('myapp/nodate/This is not your Poll');
		}
	}
		
	public function delete_answered(){
		$param = func_get_args();
		$poll = $this->polls_model->getuserpoll_by_id($param[1],$this->uid);
		if(!empty($poll)){
			if($this->polls_model->delete_answered($param[0])){	
					redirect('myapp/result/'.$param[1]);
			}
		}else{
			redirect('myapp/nodate/This is not your Poll');
		}
	}

	public function update_question(){
		
			$param = func_get_args();
			if ($this->input->server('REQUEST_METHOD') === 'POST'){

				$this->load->helper('date');
				$date = now();
				$datestring = "%Y-%m-%d-%h-%i";
			
				if(is_array($this->input->post('question_choices'))){
					$question_choices = serialize($this->input->post('question_choices'));
				}
				if(is_array($this->input->post('question_scale'))){
					$question_scale = serialize($this->input->post('question_scale'));
				}
				$question_link = $this->input->post('question_link');
				if(isset( $question_link)){
					if(is_array($question_link)){
							$answer_link = serialize($question_link);
					}else{
							$answer_link = serialize(array(0=>'0'));
					}
				}
				if($this->input->post('chek_link_edit') == 'on'){
						$chek_link = 1;
				}else{
						$chek_link = 0;
						$answer_link = serialize(array(0=>'0'));
				}
				$data_to_store = array(
						'question' => $this->input->post('question'),
						'question_type' => $this->input->post('question_type'),
						'question_choices' => $question_choices,
						'question_scale' => $question_scale,
						'poll_id'     => 	$param[1],
						'edit_date' => mdate($datestring, $date),
						'link_type' => $chek_link,
						'answer_link' => $answer_link
				);

				if($this->polls_model->update_question($param[0],$data_to_store)){
					redirect('myapp/question/'.$param[1]);
				}

			}
			$data['main_content'] = 'app/user_poll_question';
			$this->load->view('includes/template', $data); 
	}
		
	
	public function upload($id){

			if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$path = "assets/upload/";
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
				if(strlen($name)){
						$ext = getExtension($name);
					if(in_array($ext,$valid_formats)){
								if(is_dir($path.$id)){ 			
									$path = $path.$id.'/';		
								}else{
									mkdir($path.$id);
									$path = $path.$id.'/';	
								}
						$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;	
						$tmp = $_FILES['photoimg']['tmp_name'];
						$tmp_path = $this->polls_model->get_path_poll_image($id);
							if(file_exists($tmp_path[0]['path'])){
									$tmp_path = $this->polls_model->get_path_poll_image($id);
									unlink($tmp_path[0]['path']);
							}
							if(move_uploaded_file($tmp, $path.$actual_image_name)){
									$data_stor = array(
										'path' => $path.$actual_image_name
									);
									$this->polls_model->update_poll($id,$data_stor);
									
									echo "<label for='photoimg'><img src='".base_url().$path.$actual_image_name."'   class='preview' style='cursor: pointer;'></label>";
							}

					}
				}else{
					$img_url = $this->polls_model->get_path_poll_image($id);
					echo "<label for='photoimg'><img src='".base_url().$img_url[0]['path']."'   class='preview' style='cursor: pointer;'></label>";
				}
			}
				
	}
	
	public function result(){
	
		$param = func_get_args();
		$dat = array();
		$dat2 = array();
		$user_id = null;
		
		if(isset($_POST['signed_request'])){
				$user_request = parse_signed_request($_POST['signed_request']);
				if(isset($user_request['user_id']) && $user_request['user_id']){
					$user_id = $user_request['user_id'];
					
				}
		}else{
	
			$user_id = $this->uid;
		}
		if(is_array($param) && !empty($param[0])){
			$dat = $this->polls_model->getpollquetion($param[0]);
			$dat2 = $this->polls_model->getuserpoll_by_id($param[0],$user_id);
		}
		 if((!$dat && !$dat2) || !$dat2){
				$data['main_content'] = 'app/notfound';
				$this->load->view('includes/template', $data);
		}else{
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
			$config['total_rows'] = count($this->polls_model->user_answer($param[0]));
			$data['total_rows'] = $config['total_rows']/$config['per_page'];
			$this->pagination->initialize($config);
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id($param[0],$user_id);
			$data['segment'] = 'app/segments';
			$data['main_content'] = 'app/result';
			$this->load->view('includes/template', $data);
		}
	}

	public function statistics(){
	
		$param = func_get_args();
		$dat = array();
		if(is_array($param) && !empty($param[0])){
			$dat = $this->polls_model->getpollquetion($param[0]);
			$dat2 = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
		}
		 if(!$dat || !$dat2){
				$data['main_content'] = 'app/notfound';
				$this->load->view('includes/template', $data);
		}else{
			$this->load->helper('date');
			$data['qa'] = $this->polls_model->poll_quest_answer($param[0]);
			$answer_name = $this->polls_model->get_date_answer($param[0],1);
			$dat = array();
			$date_answer = array();

			foreach($answer_name as $key=>$val){
					$day = explode('-',$val['date']);
					$dat[] = $val['date'];	
			}
			$date_answer[] = array_count_values($dat);
			$date = now();
			$datestring = "%Y/%m/%d";
			$now_day = mdate($datestring,$date);
			$month = explode('/',$now_day);
			$new_moth = $month[1] - 1;
			if($new_moth<10){
				$new_moth = '0'.$new_moth;
			}
			$new_day = $month[2] + 1;
			$old_date = $month[0].'/'.$new_moth.'/'.$new_day;
			
			$days = getDatesBetween2Dates($old_date,$now_day);
			foreach($days as $key=>$val){
		
				if(isset($date_answer[0][$val])){
						$dat1[$val] = $date_answer[0][$val]; 
				}else{
					$dat1[$val] = 0;
				}
			}
			foreach($data['qa'] as $key=>$qa){
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
			$data['date_answer'] = $dat1;
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id($param[0],$this->uid);
			$data['value']=$result;
			$data['segment'] = 'app/segments';
			$data['main_content'] = 'app/statistics';
			$this->load->view('includes/template', $data);
		}
	}
	
    public function count_answered($id){
	
		$dat = $this->polls_model->getpollquetion($id);
		$dat2 = $this->polls_model->getuserpoll_by_id($id,$this->uid);
		 if(!$dat || !$dat2){
				$data['main_content'] = 'app/notfound';
				$this->load->view('includes/template', $data);
		}else{
			$data['poll_quest'] = $this->polls_model->poll_quest($id,$this->uid);
			$data['qa'] = $this->polls_model->poll_quest_answer($id);
			$data['answer_name'] = $this->polls_model->get_answer($id);

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
			$data['value'] = $result;
			$data['user_poll'] = $this->polls_model->getuserpoll_by_id($id,$this->uid);
			$data['segment'] = 'app/segments';
			$data['main_content'] = 'app/count_answered';
			$this->load->view('includes/template', $data);
		}
	}
	public function  sort_table(){
	
		if(isset($_POST['sort'])){
		
			foreach($_POST['sort'] as $key=>$quest_level){
				$quest_id = $quest_level[0];
				
				$data_store = array(
									'level' => $quest_level[1]
								);
				$this->polls_model->store_level_question($quest_id,$data_store);
			}
			
		}
	
	}
	public function send_massage($uid,$poll_count){
		
		if($poll_count == 1){
			$message = 'I have created a first poll';
		}else{
			$message = 'I have created a '.$poll_count.' polls';
		}
		
		$response = $this->facebook->api( '/'.$uid.'/feed', 'POST', array(
				'message' => $message
            ) );    
			

	}
	public function search($q){
		$response = $this->facebook->api('/search/','GET',array('q'=> $q));
		out($response);
	}
	
}

?>
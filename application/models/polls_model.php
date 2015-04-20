<?php

class Polls_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function addpoll($data){
        $insert = $this->db->insert('poll', $data);
		return $insert;
    }
    
    public function storeuserid($data){

		if($this->getuser($data['uid'])){ 
				return false;
		}else{ 
				$insert = $this->db->insert('users', $data);
				return $insert;
       }
    }
	public function updateuser($id, $data){
		
		$this->db->where('uid', $id);
		$this->db->update('users', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
		
	}
	public function get_user_by_pollid($id){
		$this->db->select('user_id');
		$this->db->from('poll');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	
	}
	public function get_text($id){
		$this->db->select('text');
		$this->db->from('poll');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
    public function getuser($id){
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('uid', $id);
		$query = $this->db->get();

		if($query->num_rows == 1){
			return true;
		}else{
			return false;
		} 	  
    }
	public function get_user($id){
           
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
	public function getpolluser($id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function get_poll_answer_count($uid){
		$this->db->select('p.id as id,a.answered as answer');
		$this->db->from('poll as p');
		$this->db->where('p.user_id', $uid);
		$this->db->join('answer as a','a.poll = p.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pollcount($id){
		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->num_rows(); 
	}
	
	public function getuserpoll($id,$limit_start=null,$limit_end=null){
		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('user_id', $id);
		$this->db->order_by('id','desc');
	 	if(is_numeric($limit_start) && is_numeric($limit_end)){
			$this->db->limit($limit_start,$limit_end);
		} 
		$query=$this->db->get();
		return $query->result_array(); 
		
	}
	public function getuserpoll_by_id($id,$uid){
		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('id', $id);
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		return $query->result_array(); 
		
	}
	public function getuserpoll_by_id_for_users($id){
		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
		
	}
	public function getpollquetion($id){
		$this->db->select('question.*,poll.name as name');
		$this->db->from('question');
		$this->db->where('poll_id', $id);
		$this->db->join('poll','question.poll_id = poll.id');
		$this->db->order_by('question.level');
		$query = $this->db->get();
		return $query->result_array(); 
	
	}
	public function is_poll_question($id){
		$this->db->select('*');
		$this->db->from('question as q');
		$this->db->where('q.poll_id', $id);
		$query = $this->db->get();
		if($query->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	public function addquestion($data){
		$insert = $this->db->insert('question', $data);
		return $insert;
	}
	 
	public function user_poll_question($id){
		$this->db->select('q.*, p.*');
		$this->db->from('poll as p');
		$this->db->where('p.id', $id);
		$this->db->join('question as q','q.poll_id = p.id');
		$query = $this->db->get();
		return $query->result_array();
	  
	}
	
	public function updatepoll($id, $data){
	  
		$this->db->where('id', $id);
		$this->db->update('poll', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	  
	}
	public function store_share_text($data, $id){
	  
		$this->db->where('id', $id);
		$this->db->update('poll', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	  
	}
	public function update_question($id, $data){
		$this->db->where('id', $id);
		$this->db->update('question', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	public function delete_poll($id){
		$this->db->where('id', $id);
		$this->db->delete('poll');
		return true;
	}
	public function delete_answered($id){
		$this->db->where('id', $id);
		$this->db->delete('answer');
		return true;
	}
	public function delete_answered_poll($id){	
		$this->db->where('poll', $id);
		$this->db->delete('answer');
		return true;
	}
	public function delete_answer($id){
		$this->db->where('poll', $id);
		$this->db->delete('answer');
		return true;	
	}
	public function delete_quest($id){
		$this->db->where('id', $id);
		$this->db->delete('question');
		return true;
	}
	public function find_quest_by_url($url){
		$this->db->select('p.id,q.*');
		$this->db->from('poll as p');
		$this->db->where('p.link', $url);
		$this->db->join('question as q','q.poll_id = p.id');
		$this->db->order_by('q.level');
		$query = $this->db->get();
		return $query->result_array();
		
	}
	public function update_poll($id,$data){
		$this->db->where('id', $id);
		$this->db->update('poll', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
		
	}
		
	public function chek($data){
		$insert = $this->db->insert('answer', $data);
		return $insert;
	}

	public function get_poll_id_by_url($url){
		$this->db->select('p.name,p.id');
		$this->db->from('poll as p');
		$this->db->where('result_share_url', $url);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function is_cheked($uid,$poll_id){
		$this->db->select('user_id');
		$this->db->from('answer');
		$this->db->where('answer.user_id', $uid);
		$this->db->where('answer.poll', $poll_id);
		$query = $this->db->get();
		if($query->num_rows == 1){
			 return false;
		}else{
				 return true;
		} 
	}
	public function poll_quest($id,$uid){	
		
		$this->db->select('p.name');
		$this->db->select('q.question');
		
		$this->db->from('poll as p');
		$this->db->where('p.id', $id);
		$this->db->where('p.user_id', $uid);

		$this->db->join('question as q','q.poll_id = p.id');
		$query = $this->db->get();
		return $query->result_array();
		
	}
	public function question_name($question_id){
		$this->db->select('q.question');
		$this->db->from('question as q');
		$this->db->where('q.id', $question_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function poll_quest_answer($poll_id){
		$this->db->select('a.answered');
		$this->db->from('answer as a');
		$this->db->where('a.poll', $poll_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function user_answer($id,$limit_start = NULL,$limit_end = NULL){

		$this->db->select('a.id,a.answered,DATE(a.date) as date,a.user_id as user_id');
		//$this->db->select('u.firstname,u.lastname');
		
		$this->db->from('answer as a');
		$this->db->where('a.poll', $id);

	//	$this->db->join('users as u','u.uid = a.user_id');
		//$this->db->join('question as q','q.poll_id = a.poll');
		if(is_numeric($limit_start) && is_numeric($limit_end)){
			$this->db->limit($limit_start,$limit_end);
		} 
		$this->db->order_by('a.id desc'); 
		$query = $this->db->get();
		return $query->result_array();
			
	}
	public function store_level_question($id,$data){
		$this->db->where('id', $id);
		$this->db->update('question', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
		
	public function quest($id){
		$this->db->select('question');
		$this->db->from('question');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_quest($id){
		$this->db->select('*');
		$this->db->from('question');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if($query->num_rows == 1){
			 return true;
		}else{
				 return false;
		} 
	}

		
	public function get_answer($poll_id){
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('poll', $poll_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_answer_user_id($poll_id){
		$this->db->select('user_id');
		$this->db->from('answer');
		$this->db->where('poll', $poll_id);
		$query = $this->db->get();
		return $query->result_array();
	}
		
	public function get_date_answer($id,$date){
		
		$this->db->select('DATE(date) as date');
		$this->db->from('answer as a');
		$this->db->where('poll', $id);
		$this->db->where('TIMESTAMPDIFF(month,a.date,NOW()) < '.$date);
		$this->db->order_by('a.date asc');
		$query = $this->db->get();
		return $query->result_array();	
	}
	public function get_path_poll_image($poll_id){
		$this->db->select('path');
		$this->db->from('poll');
		$this->db->where('id', $poll_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_poll_by_question($poll_id){
		$this->db->select('poll_id');
		$this->db->from('question');
		$this->db->where('question.poll_id', $poll_id);
		$this->db->group_by('question.poll_id');
		$query = $this->db->get();
		return $query->result_array();
	
	}

}
?>
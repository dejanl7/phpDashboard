<?php

class session extends major_class{
	public $user_id_session;
	public $username_session;
	public $login = false;
	public $message;
	

/*==================================================== 
	Start sessions 
======================================================*/
	function __construct(){
		session_start();
		$this->user_loggIn();
		$this->chack_message();
	}	

	
/*==================================================== 
	If user are logged in, $login will became "true" 
======================================================*/
	public function session_status(){
		return $this->login;
	}


/*==================================================== 
	Check out if user are logged in 
======================================================*/
	private function user_loggIn(){
		if(isset($_SESSION['user_id'])){
			$this->user_id_session = $_SESSION['user_id'];
			$this->username_session = $_SESSION['username'];
			$this->login = true;
		}
			else{
				unset($this->user_id);
				$this->login = false;
			}
	}


/*==================================================== 
	User login 
======================================================*/
	public function login($userS){
		if($userS){
			$this->user_id_session = $_SESSION['user_id'] = $userS->user_id;
			$this->username_session = $_SESSION['username'] = $userS->username;
			$this->login = true;
		}
	}


/*==================================================== 
	User logout 
======================================================*/
	public function logout($userS){
		unset($_SESSION['user_id']);
		unset($this->user_id_session);
		$this->login = false;
	}
	

/*==================================================== 
	Check Message
======================================================*/
	public function chack_message(){
		if(isset($_SESSION['message'])){
			$this->message = $_SESSION['message'];
			unset($_SESSION['poruka']);
		}
			else{
				$this->message = "";
			}
	}

	
	
}


$session = new session();
global $session;



?>
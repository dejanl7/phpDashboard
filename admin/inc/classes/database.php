<?php
	require_once("connection.php");
	
class database{
	public $database_connection;
	
	function __construct(){
		$this->open_connection();
	}
	

/*====================================================
	Open connection function. We are setting up 
	connection with database.
======================================================*/	
	public function open_connection(){
		global $database;
		$this->database_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->database_connection->set_charset("utf8");
			if($this->database_connection->connect_errno){
				die("Database connection failed badly" . mysqli_error());
			}
	}


/*====================================================
	Select specific table from database...
======================================================*/	
	public function select_table($table){
		$tbl = mysqli_query($this->database_connection, $table);
		return $tbl;
	}


/*====================================================
	While loop - fetch object from table...
======================================================*/
	public function while_loop($query){
		$all = mysqli_query($this->database_connection, $query);
		return $all;
	}


/*====================================================
	Clear string from potential mysqli injection...
======================================================*/
	public function clear_string($string){
		$clean_string = mysqli_real_escape_string($this->database_connection,$string);
		return $clean_string;
	}


/*====================================================
	Function for insert ID into table...
======================================================*/	
	public function insert_id(){
		return mysqli_insert_id($this->database_connection);
		
	}
	
	
}

	$base = new database();
	global $base;


?>
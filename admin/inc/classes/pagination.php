<?php

class pagination extends major_class{
	public $current_page;
	public $number_per_page;
	public $total_items;
	
	function __construct($current_page, $number_per_page, $total_items){
		$this->current_page = (int)$current_page;
		$this->number_per_page = (int)$number_per_page;
		$this->total_items = (int)$total_items;
	}	
	
	
/*====================================================
	Function for showing sum of pages
======================================================*/	
	public function sum_of_pages(){
		return ceil($this->total_items / $this->number_per_page);
	}


/*==================================================== 
	Function for showing next page
======================================================*/	
	public function next_page(){
		return $this->current_page + 1;
	}
	

/*==================================================== 
	Function for showing previous page
======================================================*/	
	public function previous_page(){
		return $this->current_page - 1;
	}
	

/*==================================================== 
	Show if previous page exist
======================================================*/	
	public function is_previous_page(){
		return $this->previous_page() >=1 ? true : false;
	}
	
/*==================================================== 
	Show if next page exist
======================================================*/	
	public function is_next_page(){
		return $this->next_page() <= $this->sum_of_pages() ? true : false;
	}
	
/*====================================================
	Offset per page - show defined number of items
======================================================*/	
	public function offset(){
		return ($this->current_page - 1) * $this->number_per_page;
	}
	
}


?>
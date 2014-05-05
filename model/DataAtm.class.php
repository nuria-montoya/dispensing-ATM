<?php
/*
 * Definition of ATM data
 * Nuria Montoya: 3-5-2014
 * 
 * */

class DataAtm{
	private $notes20 = 0;
	private $notes50 = 0;
	private $total = 0;
	
	//construct object
	public function __construct($int20, $int50){
		$this->setNotes20($int20);
		$this->setNotes50($int50);
		$this->setTotal();
	}
	
	//set functions
	public function setNotes20($int20){
		if($int20 >= 0) $this->notes20 = $int20;
	}
	
	public function setNotes50($int50){
		if($int50 >= 0) $this->notes50 = $int50;
	}
	
	public function setTotal(){
		$this->total = $this->notes20*20 + $this->notes50*50;
	}
	
	//get functions
	public function getNotes20(){
		return $this->notes20;
	}
	
	public function getNotes50(){
		return $this->notes50;
	}
	
	public function getTotal(){
		return $this->total;
	}
	
	//update notes quantities
	public function updateAmountAtm($num20, $num50){
		$rest20 = $this->notes20-$num20;
		$rest50 = $this->notes50-$num50;
			
		if($rest20 >= 0 and $rest50 >= 0){
			
			$this->setNotes20($rest20);
			$this->setNotes50($rest50);
			$this->setTotal();
			return false;
		}else return true; //there is an error, low provability but necessary check
	}

	
}



























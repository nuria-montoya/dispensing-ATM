<?php
/*
 * Logic of ATM Simulator
 * Nuria Montoya: 3-5-2014
 * 
 * */
include_once("model/DataAtm.class.php");

class LogicAtm{
	
	public $atm;
	
	public function __construct($int20 = 0, $int50 = 0){
		//check if amounts aren't intergers, low provability 
		//because in this case view layer has ckecked but necessary to reutilise
		$this->checkData($int20, $int50); 
		//contruct atm object
		$this->atm = new DataAtm($int20, $int50);
	}
	
	//check if the amounts are integers
	public function checkData($int20, $int50){
		if (is_int($int20) and is_int($int50) and $int20 >=0 and $int50 >= 0) return true;
		else throw new Exception('Sorry! Only positive and integer numbers allowed');
	}
	
	public function getNotes(){
		return array('notes20' => $this->atm->getNotes20(), 
					'notes50' => $this->atm->getNotes50(),
					'total' => $this->atm->getTotal());
	}
	
	//combinations of $20 notes and $50 notes
	public function combinations($amount){
		$notes = array('notes20' => 0, 'notes50' => 0);
		if ($this->checkAmount($amount)){
			//if it's possible satisfy only with notes of $50
			if ($this->multiple50($amount) and $this->enoughNotes50($amount)) 
			{$notes['notes50'] = $amount/50;
			print_r('<br> LogicAtm:- combinations: ');
			print_r($notes);
			print_r('<br>');}
			else {
				$this->howManyDiffNotes($notes, $amount);
			}
			$error = $this->atm->updateAmountAtm($notes['notes20'], $notes['notes50']);
			if ($error) throw new Exception('Just positive numbers allowed'); //there is an error
			return $notes;
		}else throw new Exception('Sorry! There aren\'t enough cash on ATM machine');
	}
	
	//different types of notes
	public function howManyDiffNotes(&$notes, $amount){
		//not multiple of 50 how many minim of $50 
		//if ($this->enoughNotes50($amount)) 
		$aux = $this->minAmount50($amount);
		//how many notes of $20 can return
		$aux2 = $this->restWith20($amount-$aux);
		
		if ($aux2){
			$notes['notes20'] = $aux2;
			$notes['notes50'] = $aux/50;
			
		}else{
			//check errors
			if(!$this->enoughNotes20($amount-$aux)) throw new Exception('Sorry! There aren\'t $20 notes');
			if(!$this->enoughNotes50($amount-$aux)) throw new Exception('Sorry! There aren\'t $50 notes');
			else throw new Exception('Sorry! There just are $20 and $50 notes');
		}
	}
	
	//return the rest that it can satisfy with notes of $50
	//rest have been >= 20
	public function minAmount50($amount){
		$aux = $this->atm->getNotes50();
		$rest = $aux*50;
		
		if ($aux >= (int)($amount/50))	$rest = (int)($amount/50)*50;
		
		$min = $amount-$rest;
		return ($aux > 0 and ($min < 20 or !$this->multiple20($min)))?$rest-50:$rest;
	}
	
	//how many notes with notes of $20
	private function restWith20($quantity){
		if ($this->multiple20($quantity) and $this->enoughNotes20($quantity)) 
			return $quantity/20;
		else return false;
	}
	
	//if amount is multiple of 20
	private function multiple20($amount){
		if ($amount%20 == 0) return true;
		else return false; 
	}
	
	//if amount is multiple of 50
	private function multiple50($amount){
		if ($amount%50 == 0) return true;
		else return false;
	}
	
	//check if there are enough notes of $20
	private function enoughNotes20($amount){
		if ($amount/20 <= $this->atm->getNotes20()) return true;
		else return false;
	}
	
	//check if there are enough notes of $50
	private function enoughNotes50($amount){
		if ($amount/50 <= $this->atm->getNotes50()) return true;
		else return false;
	}
	
	//check if atm have enough notes
	private function checkAmount($amount){
		return ($this->atm->getTotal() >= $amount)?true:false;
	}
}
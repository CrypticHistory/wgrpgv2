<?php
	
class SmallWeightGain{
	
	public function __construct(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() + 40);
	}
}

?>
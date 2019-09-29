<?php
	
class LargeWeightGain{
	
	public function __construct(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() + 120);
	}
}

?>
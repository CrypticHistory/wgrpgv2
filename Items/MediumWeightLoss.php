<?php
	
class MediumWeightLoss{
	
	public function __construct(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() * 0.8);
	}
}

?>
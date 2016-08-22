<?php
	
class SmallWeightLoss{
	
	public function SmallWeightLoss(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() * 0.9);
	}
}

?>
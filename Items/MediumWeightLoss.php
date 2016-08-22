<?php
	
class MediumWeightLoss{
	
	public function MediumWeightLoss(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() * 0.8);
	}
}

?>
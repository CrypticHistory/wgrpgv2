<?php
	
class LargeWeightLoss{
	
	public function LargeWeightLoss(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() * 0.7);
	}
}

?>
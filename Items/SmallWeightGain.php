<?php
	
class SmallWeightGain{
	
	public function SmallWeightGain(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() + 40);
	}
}

?>
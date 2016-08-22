<?php
	
class MediumWeightGain{
	
	public function MediumWeightGain(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() + 80);
	}
}

?>
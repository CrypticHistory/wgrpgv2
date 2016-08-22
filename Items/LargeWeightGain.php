<?php
	
class LargeWeightGain{
	
	public function LargeWeightGain(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->setWeight($objRPGCharacter->getWeight() + 120);
	}
}

?>
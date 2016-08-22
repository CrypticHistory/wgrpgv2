<?php
	
class Coffee{
	
	public function Coffee(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->addToStatusEffects("Caffeinated");
	}
}

?>
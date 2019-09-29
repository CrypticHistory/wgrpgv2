<?php
	
class Coffee{
	
	public function __construct(){
		
	}

	public function useItem($objRPGCharacter){
		$objRPGCharacter->addToStatusEffects("Caffeinated");
	}
}

?>
<?php

class AlwaysAttack{
	
	private $_objNPC;
	
	public function AlwaysAttack($objNPC){
		$this->_objNPC = $objNPC;
	}
	
	public function determineAction(){
		return "Attack";
	}
}

?>
<?php

include_once "RPGCombatStatusEffect.php";

class SEBleeding extends RPGCombatStatusEffect{
	
	public function __construct($objGiver, $objReceiver, $intRemainingTurns, $strEntityName){
		parent::__construct($objGiver, $objReceiver, $intRemainingTurns, $strEntityName);
	}
	
	public function trigger(){
		$intDamage = parent::getReceiver()->takeDamage(2);
		if(parent::getReceiver()->isDead()){
			parent::endEffect();
		}
		else{
			$strCombatMessage = parent::getReceiver()->getNPCName() . " suffers from " . $intDamage . " bleed damage. ";
			$_SESSION['objCombat']->writeCombatMessage(parent::getEntityName(), $strCombatMessage);
			parent::tick();
		}
	}
	
}

?>
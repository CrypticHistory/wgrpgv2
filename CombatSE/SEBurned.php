<?php

include_once "RPGCombatStatusEffect.php";

class SEBurned extends RPGCombatStatusEffect{
	
	public function __construct($objGiver, $objReceiver, $intRemainingTurns, $strEntityName){
		parent::__construct($objGiver, $objReceiver, $intRemainingTurns, $strEntityName);
	}
	
	public function trigger(){
		$intRandomBurnDmg = mt_rand(ceil(parent::getGiver()->getModifiedMagicDamage() * 0.1), ceil(parent::getGiver()->getModifiedMagicDamage() * 0.2));
		$intDamage = parent::getReceiver()->takeDamage($intRandomBurnDmg);
		if(parent::getReceiver()->isDead()){
			parent::endEffect();
		}
		else{
			$strCombatMessage = parent::getReceiver()->getNPCName() . " suffers from " . $intDamage . " burn damage. ";
			$_SESSION['objCombat']->writeCombatMessage(parent::getEntityName(), $strCombatMessage);
			parent::tick();
		}
	}
	
}

?>
<?php

require_once "Database.php";
include_once "RPGItem.php";
	
class SkillFeed{

	private $_objFood;
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		$this->loadPlayerFood($objPlayer->getRPGCharacterID());
		if($this->_objFood){
			$objNPC->forceEatItemDeadly($this->_objFood->getItemID());
			$_SESSION['objRPGCharacter']->dropItem($this->_objFood->getItemInstanceID());
			$strReturnText = $objPlayer->getNPCName() . " charges at " . $objNPC->getNPCName() . ", stuffing their mouth with a " . $this->_objFood->getItemName() . ".";
			return $strReturnText;
		}
		else{
			return "You have no food in your inventory to use this skill!";
		}
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$this->loadNPCFood($objNPC->getNPCID());
		$objPlayer->forceEatItem($this->_objFood->getItemID());
		// todo: strFeedText in tblnpcbattletext
		$strReturnText = $objNPC->getNPCName() . " charges at " . $objPlayer->getNPCName() . ", stuffing their mouth with a " . $this->_objFood->getItemName() . ".";
		return $strReturnText;
	}
	
	public function loadNPCFood($intNPCID){
		$objDB = new Database();
		$strSQL = "SELECT intItemID
					FROM tblnpcitemxr
						INNER JOIN tblitem
							USING (intItemID)
						WHERE strItemType = 'Food'
							AND intNPCID = " . $objDB->quote($intNPCID) . "
						ORDER BY RAND()
						LIMIT 1";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$objFood = new RPGItem($arrRow['intItemID']);
		$this->_objFood = $objFood;
	}
	
	public function loadPlayerFood($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblcharacteritemxr
						INNER JOIN tblitem
							USING (intItemID)
						WHERE strItemType = 'Food'
							AND intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . "
						ORDER BY RAND()
						LIMIT 1";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		if(isset($arrRow['intItemID'])){
			$objFood = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
			$this->_objFood = $objFood;
		}
		else{
			$this->_objFood = 0;
		}
	}
	
	public function getSkillSubType(){
		return "Debuff Melee";
	}
	
	public function getWaitTime(){
		return 0;
	}
}

?>
<?php

require_once "Database.php";
include_once "RPGItem.php";
	
class SkillFeed{

	private $_objFood;
	
	public function SkillFeed(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$this->loadNPCFood($objNPC->getNPCID());
		$objPlayer->forceEatItem($this->_objFood->getItemID());
		// todo: strFeedText in tblnpcbattletext
		$strReturnText = $objNPC->getNPCName() . " charges at you, stuffing your mouth with a " . $this->_objFood->getItemName() . ". You instinctively begin to chew, lest you choke on the food.";
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
	
	public function getWaitTime(){
		return 0;
	}
}

?>
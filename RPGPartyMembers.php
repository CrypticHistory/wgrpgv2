<?php

require_once "Database.php";

class RPGPartyMembers{

	private $_arrActivePartyMembers;
	private $_arrReservePartyMembers;
	
	public function __construct($arrActivePartyMembers, $arrReservePartyMembers){
		$this->_arrActivePartyMembers = $arrActivePartyMembers;
		$this->_arrReservePartyMembers = $arrReservePartyMembers;
	}
	
	public function save(){
		$objDB = new Database();
		
		$strSQL = "INSERT INTO tblpartymember (intPartyMemberID, intNPCInstanceID, strPartyObj, blnIsActive) VALUES";
		$strComma = "";
		foreach($this->getActivePartyMembers() as $strPartyObj => $objNPC){
			$strSQL .= $strComma . "(" . $objDB->quote($objNPC->getPartyMemberID()) . ", " . $objDB->quote($objNPC->getNPCInstanceID()) . ", " . $objDB->quote($strPartyObj) . ", 1)";
			$strComma = ", ";
		}
		
		foreach($this->getReservePartyMembers() as $strNPCName => $objNPC){
			$strSQL .= $strComma . "(" . $objDB->quote($objNPC->getPartyMemberID()) . ", " . $objDB->quote($objNPC->getNPCInstanceID()) . ", '', 0)";
			$strComma = ", ";
		}
		$strSQL .= " ON DUPLICATE KEY UPDATE intPartyMemberID = VALUES(intPartyMemberID), intNPCInstanceID = VALUES(intNPCInstanceID), strPartyObj = VALUES(strPartyObj), blnIsActive = VALUES(blnIsActive)";
		
		$objDB->query($strSQL);
	}
	
	public function getActivePartyMembers(){
		return $this->_arrActivePartyMembers;
	}
	
	public function setActivePartyMembers($arrActivePartyMembers){
		$this->_arrActivePartyMembers = $arrActivePartyMembers;
	}
	
	public function getReservePartyMembers(){
		return $this->_arrReservePartyMembers;
	}
	
	public function setReservePartyMembers($arrReservePartyMembers){
		$this->_arrReservePartyMembers = $arrReservePartyMembers;
	}
	
	public function setPartyOne($objNPC){
		if($objNPC != NULL){
			$this->_arrActivePartyMembers["PartyOne"] = $objNPC;
		}
	}
	
	public function setPartyTwo($objNPC){
		if($objNPC != NULL){
			$this->_arrActivePartyMembers["PartyTwo"] = $objNPC;
		}
	}
	
	public function addPartyOne($objNPC){
		
		if(array_key_exists("PartyOne", $this->_arrActivePartyMembers)){
			$objOldPartyOne = $this->_arrActivePartyMembers["PartyOne"];
			unset($this->_arrActivePartyMembers["PartyOne"]);
			$this->addReservePartyMember($objOldPartyOne);
		}
		
		$this->_arrActivePartyMembers["PartyOne"] = $objNPC;
		unset($this->_arrReservePartyMembers[$objNPC->getNPCInstanceID()]);
	}
	
	public function addPartyTwo($objNPC){
		
		if(array_key_exists("PartyTwo", $this->_arrActivePartyMembers)){
			$objOldPartyTwo = $this->_arrActivePartyMembers["PartyTwo"];
			unset($this->_arrActivePartyMembers["PartyTwo"]);
			$this->addReservePartyMember($objOldPartyTwo);
		}
		
		$this->_arrActivePartyMembers["PartyTwo"] = $objNPC;
		unset($this->_arrReservePartyMembers[$objNPC->getNPCInstanceID()]);
	}
	
	public function removePartyOne(){
		$objNPC = $this->_arrActivePartyMembers["PartyOne"];
		unset($this->_arrActivePartyMembers["PartyOne"]);
		$this->addReservePartyMember($objNPC);
	}
	
	public function removePartyTwo(){
		$objNPC = $this->_arrActivePartyMembers["PartyTwo"];
		unset($this->_arrActivePartyMembers["PartyTwo"]);
		$this->addReservePartyMember($objNPC);
	}
	
	public function getPartyOne(){
		return $this->_arrActivePartyMembers["PartyOne"];
	}
	
	public function getPartyTwo(){
		return $this->_arrActivePartyMembers["PartyTwo"];
	}
	
	public function addReservePartyMember($objNPC){
		$this->_arrReservePartyMembers[$objNPC->getNPCInstanceID()] = $objNPC;
	}
}

?>
<?php

require_once "Database.php";
include_once "RPGStatusEffect.php";

class RPGStatChange{

	private $_intStatChangeID;
	private $_intEnchantID;
	private $_strStatName;
	private $_intStatChangeMin;
	private $_intStatChangeMax;
	private $_objStatusEffect;
	
	public function RPGStatChange($intStatChangeID = null){
		if($intStatChangeID){
			$this->loadStatChangeInfo($intStatChangeID);
		}
	}
	
	private function populateVarFromRow($arrStatChangeInfo){
		$this->setStatChangeID($arrEnchantInfo['intStatChangeID']);
		$this->setEnchantID($arrEnchantInfo['intEnchantID']);
		$this->setStatName($arrEnchantInfo['strStatName']);
		$this->setStatChangeMin($arrEnchantInfo['intStatChangeMin']);
		$this->setStatChangeMax($arrEnchantInfo['intStatChangeMax']);
		$this->setStatusEffect(new RPGStatusEffect($arrStatChangeInfo['intStatusEffectID']));
	}
	
	private function loadStatChangeInfo($intStatChangeID){
		$objDB = new Database();
		$arrStatChangeInfo = array();
			$strSQL = "SELECT *
						FROM tblenchantstatchanges
							WHERE intStatChangeID = " . $objDB->quote($intStatChangeID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrStatChangeInfo['intStatChangeID'] = $arrRow['intEnchantStatChangeID'];
				$arrStatChangeInfo['intEnchantID'] = $arrRow['intEnchantID'];
				$arrStatChangeInfo['strStatName'] = $arrRow['strStatName'];
				$arrStatChangeInfo['intStatChangeMax'] = $arrRow['intStatChangeMax'];
				$arrStatChangeInfo['intStatChangeMin'] = $arrRow['intStatChangeMin'];
				$arrStatChangeInfo['intStatusEffectID'] = $arrRow['intStatusEffectID'];
			}
		$this->populateVarFromRow($arrStatChangeInfo);
	}
	
	public function getStatChangeID(){
		return $this->_intStatChangeID;
	}
	
	public function setStatChangeID($intStatChangeID){
		$this->_intStatChangeID = $intStatChangeID;
	}
	
	public function getEnchantID(){
		return $this->_intEnchantID;
	}
	
	public function setEnchantID($intEnchantID){
		$this->_intEnchantID = $intEnchantID;
	}
	
	public function getStatName(){
		return $this->_strStatName;
	}
	
	public function setStatName($strStatName){
		$this->_strStatName = $strStatName;
	}
	
	public function getStatChangeMax(){
		return $this->_intStatChangeMax;
	}
	
	public function setStatChangeMax($intStatChangeMax){
		$this->_intStatChangeMax = $intStatChangeMax;
	}
	
	public function getStatChangeMin(){
		return $this->_intStatChangeMin;
	}
	
	public function setStatChangeMin($intStatChangeMin){
		$this->_intStatChangeMin = $intStatChangeMin;
	}
	
	public function getStatusEffect(){
		return $this->_objStatusEffect;
	}
	
	public function setStatusEffect($objStatusEffect){
		$this->_objStatusEffect = $objStatusEffect;
	}
}

?>
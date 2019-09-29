<?php

require_once "Database.php";
include_once "RPGStatusEffect.php";

class RPGStatChange{

	private $_intEnchantStatChangeID;
	private $_intEnchantID;
	private $_strStatName;
	private $_intStatChangeMin;
	private $_intStatChangeMax;
	private $_objStatusEffect;
	
	public function __construct($intStatChangeID = null){
		if($intStatChangeID != null){
			$this->loadStatChangeInfo($intStatChangeID);
		}
	}
	
	private function populateVarFromRow($arrStatChangeInfo){
		$this->setEnchantStatChangeID($arrStatChangeInfo['intEnchantStatChangeID']);
		$this->setEnchantID($arrStatChangeInfo['intEnchantID']);
		$this->setStatName($arrStatChangeInfo['strStatName']);
		$this->setStatChangeMin($arrStatChangeInfo['intStatChangeMin']);
		$this->setStatChangeMax($arrStatChangeInfo['intStatChangeMax']);
		$this->setStatusEffect(new RPGStatusEffect(null, $arrStatChangeInfo['intStatusEffectID']));
	}
	
	private function loadStatChangeInfo($intStatChangeID){
		$objDB = new Database();
		$arrStatChangeInfo = array();
			$strSQL = "SELECT *
						FROM tblenchantstatchanges
							WHERE intEnchantStatChangeID = " . $objDB->quote($intStatChangeID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrStatChangeInfo['intEnchantStatChangeID'] = $arrRow['intEnchantStatChangeID'];
				$arrStatChangeInfo['intEnchantID'] = $arrRow['intEnchantID'];
				$arrStatChangeInfo['strStatName'] = $arrRow['strStatName'];
				$arrStatChangeInfo['intStatChangeMax'] = $arrRow['intStatChangeMax'];
				$arrStatChangeInfo['intStatChangeMin'] = $arrRow['intStatChangeMin'];
				$arrStatChangeInfo['intStatusEffectID'] = $arrRow['intStatusEffectID'];
			}
		$this->populateVarFromRow($arrStatChangeInfo);
	}
	
	public function getEnchantStatChangeID(){
		return $this->_intEnchantStatChangeID;
	}
	
	public function setEnchantStatChangeID($intEnchantStatChangeID){
		$this->_intEnchantStatChangeID = $intEnchantStatChangeID;
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
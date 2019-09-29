<?php

require_once "Database.php";

class RPGSkill{

	private $_intSkillID;
	private $_strSkillName;
	private $_strClassName;
	private $_txtSkillDesc;
	private $_strSkillType;
	private $_intHitCount;
	private $_intTargetCount;
	private $_blnUsableOutsideBattle;
	private $_strWeaponType;
	private $_intCooldown;
	private $_intCurrentCooldown;
	private $_intPreCooldown;
	private $_intStatusEffectID;
	private $_intRequiredLevel;
	
	public function __construct($intSkillID = null){
		if($intSkillID != null){
			$this->loadSkillInfo($intSkillID);
		}
	}
	
	private function populateVarFromRow($arrSkillInfo){
		$this->setSkillID($arrSkillInfo['intSkillID']);
		$this->setSkillName($arrSkillInfo['strSkillName']);
		$this->setClassName($arrSkillInfo['strClassName']);
		$this->setSkillDesc($arrSkillInfo['txtSkillDesc']);
		$this->setSkillType($arrSkillInfo['strSkillType']);
		$this->setHitCount($arrSkillInfo['intHitCount']);
		$this->setTargetCount($arrSkillInfo['intTargetCount']);
		$this->setUsableOutsideBattle($arrSkillInfo['blnUsableOutsideBattle']);
		$this->setWeaponType($arrSkillInfo['strWeaponType']);
		$this->setCooldown($arrSkillInfo['intCooldown']);
		$this->setPreCooldown($arrSkillInfo['intPreCooldown']);
		$this->setStatusEffectID($arrSkillInfo['intStatusEffectID']);
	}
	
	private function loadSkillInfo($intSkillID){
		$objDB = new Database();
		$arrSkillInfo = array();
			$strSQL = "SELECT *
						FROM tblskill
							WHERE intSkillID = " . $objDB->quote($intSkillID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrSkillInfo['intSkillID'] = $arrRow['intSkillID'];
				$arrSkillInfo['strSkillName'] = $arrRow['strName'];
				$arrSkillInfo['strClassName'] = $arrRow['strClassName'];
				$arrSkillInfo['txtSkillDesc'] = $arrRow['txtDescription'];
				$arrSkillInfo['strSkillType'] = $arrRow['strSkillType'];
				$arrSkillInfo['intHitCount'] = $arrRow['intHitCount'];
				$arrSkillInfo['intTargetCount'] = $arrRow['intTargetCount'];
				$arrSkillInfo['blnUsableOutsideBattle'] = $arrRow['blnUsableOutsideBattle'];
				$arrSkillInfo['strWeaponType'] = $arrRow['strWeaponType'];
				$arrSkillInfo['intCooldown'] = $arrRow['intCooldown'];
				$arrSkillInfo['intPreCooldown'] = $arrRow['intPreCooldown'];
				$arrSkillInfo['intStatusEffectID'] = $arrRow['intStatusEffectID'];
			}
		$this->populateVarFromRow($arrSkillInfo);
	}
	
	public function getSkillID(){
		return $this->_intSkillID;
	}
	
	public function setSkillID($intSkillID){
		$this->_intSkillID = $intSkillID;
	}
	
	public function getSkillName(){
		return $this->_strSkillName;
	}
	
	public function setSkillName($strSkillName){
		$this->_strSkillName = $strSkillName;
	}
	
	public function getClassName(){
		return $this->_strClassName;
	}
	
	public function setClassName($strClassName){
		$this->_strClassName = $strClassName;
	}
	
	public function getSkillDesc(){
		return $this->_txtSkillDesc;
	}
	
	public function setSkillDesc($txtSkillDesc){
		$this->_txtSkillDesc = $txtSkillDesc;
	}
	
	public function getSkillType(){
		return $this->_strSkillType;
	}
	
	public function setSkillType($strSkillType){
		$this->_strSkillType = $strSkillType;
	}
	
	public function getHitCount(){
		return $this->_intHitCount;
	}
	
	public function setHitCount($intHitCount){
		$this->_intHitCount = $intHitCount;
	}
	
	public function getTargetCount(){
		return $this->_intTargetCount;
	}
	
	public function setTargetCount($intTargetCount){
		$this->_intTargetCount = $intTargetCount;
	}
	
	public function getUsableOutsideBattle(){
		return $this->_blnUsableOutsideBattle;
	}
	
	public function setUsableOutsideBattle($blnUsableOutsideBattle){
		$this->_blnUsableOutsideBattle = $blnUsableOutsideBattle;
	}
	
	public function getWeaponType(){
		return $this->_strWeaponType;
	}
	
	public function setWeaponType($strWeaponType){
		$this->_strWeaponType = $strWeaponType;
	}
	
	public function getCooldown(){
		return $this->_intCooldown;
	}
	
	public function setCooldown($intCooldown){
		$this->_intCooldown = $intCooldown;
	}
	
	public function getPreCooldown(){
		return $this->_intPreCooldown;
	}
	
	public function setPreCooldown($intPreCooldown){
		$this->_intPreCooldown = $intPreCooldown;
	}
	
	public function getStatusEffectID(){
		return $this->_intStatusEffectID;
	}
	
	public function setStatusEffectID($intStatusEffectID){
		$this->_intStatusEffectID = $intStatusEffectID;
	}
	
	public function getCurrentCooldown(){
		return $this->_intCurrentCooldown;
	}
	
	public function setCurrentCooldown($intCurrentCooldown){
		$this->_intCurrentCooldown = $intCurrentCooldown;
	}
	
	public function resetCooldown(){
		$this->_intCurrentCooldown = $this->_intCooldown;
	}
	
	public function applyCooldown(){
		$this->_intCurrentCooldown = $this->_intCooldown;
	}
	
	public function removeCooldown(){
		$this->_intCurrentCooldown = 0;
	}
	
	public function decrementCooldown(){
		if($this->_intCurrentCooldown != 0){
			$this->_intCurrentCooldown--;
		}
	}
	
	public function isOffCooldown(){
		if($this->_intCurrentCooldown == 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getRequiredLevel(){
		return $this->_intRequiredLevel;
	}
	
	public function setRequiredLevel($intRequiredLevel){
		$this->_intRequiredLevel = $intRequiredLevel;
	}
}
?>
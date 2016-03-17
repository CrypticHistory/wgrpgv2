<?php

require_once "Database.php";
include_once "RPGEnchant.php";
include_once "RPGOutfitReader.php";

class RPGItem{

	private $_intItemInstanceID;
	private $_intItemID;
	private $_strItemName;
	private $_txtItemDesc;
	private $_intCalories;
	private $_intHPHeal;
	private $_intDamage;
	private $_intMagicDamage;
	private $_intDefence;
	private $_intMagicDefence;
	private $_strStatDamage;
	private $_strSize;
	private $_strXML;
	private $_intQuantity;
	private $_strItemType;
	private $_strHandType;
	private $_intSellPrice;
	private $_objSuffix;
	private $_objPrefix;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	
	public function RPGItem($intItemID = null, $intItemInstanceID = null){
		if($intItemInstanceID){
			$this->_intItemInstanceID = $intItemInstanceID;
		}
		if($intItemID){
			$this->loadItemInfo($intItemID);
		}
	}
	
	private function populateVarFromRow($arrItemInfo){
		$this->setItemID($arrItemInfo['intItemID']);
		$this->setItemName($arrItemInfo['strItemName']);
		$this->setItemDesc($arrItemInfo['txtItemDesc']);
		$this->setCalories($arrItemInfo['intCalories']);
		$this->setHPHeal($arrItemInfo['intHPHeal']);
		$this->setDamage($arrItemInfo['intDamage']);
		$this->setMagicDamage($arrItemInfo['intMagicDamage']);
		$this->setDefence($arrItemInfo['intDefence']);
		$this->setMagicDefence($arrItemInfo['intMagicDefence']);
		$this->setStatDamage($arrItemInfo['strStatDamage']);
		$this->setItemType($arrItemInfo['strItemType']);
		$this->setHandType($arrItemInfo['strHandType']);
		$this->setSellPrice($arrItemInfo['intSellPrice']);
		$this->setCreatedOn($arrItemInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrItemInfo['strCreatedBy']);
		$this->setModifiedOn($arrItemInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrItemInfo['strModifiedBy']);
		$this->setPrefix(null);
		$this->setSuffix(null);
	}
	
	private function loadItemInfo($intItemID){
		$objDB = new Database();
		$arrItemInfo = array();
			$strSQL = "SELECT *
						FROM tblitem
							WHERE intItemID = " . $objDB->quote($intItemID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrItemInfo['intItemID'] = $arrRow['intItemID'];
				$arrItemInfo['strItemName'] = $arrRow['strItemName'];
				$arrItemInfo['txtItemDesc'] = $arrRow['txtItemDesc'];
				$arrItemInfo['intCalories'] = $arrRow['intCalories'];
				$arrItemInfo['intHPHeal'] = $arrRow['intHPHeal'];
				$arrItemInfo['intDamage'] = $arrRow['intDamage'];
				$arrItemInfo['intMagicDamage'] = $arrRow['intMagicDamage'];
				$arrItemInfo['intDefence'] = $arrRow['intDefence'];
				$arrItemInfo['intMagicDefence'] = $arrRow['intMagicDefence'];
				$arrItemInfo['strStatDamage'] = $arrRow['strStatDamage'];
				$arrItemInfo['strItemType'] = $arrRow['strItemType'];
				$arrItemInfo['strHandType'] = $arrRow['strHandType'];
				$arrItemInfo['intSellPrice'] = $arrRow['intSellPrice'];
				$arrItemInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrItemInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrItemInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrItemInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrItemInfo);
		if(isset($this->_intItemInstanceID)){
			$this->loadEnchants();
			$arrItemType = explode(":", $this->getItemType());
			if($arrItemType[0] == 'Armour'){
				$this->_strSize = $this->loadSize();
				$this->_strXML = $this->loadXMLName();
			}
		}
	}
	
	private function loadEnchants(){
		$objDB = new Database();
		$strSQL = "SELECT intSuffixEnchantID, intPrefixEnchantID
					FROM tbliteminstanceenchant
						WHERE intItemInstanceID = " . $objDB->quote($this->_intItemInstanceID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		if(isset($arrRow['intPrefixEnchantID'])){
			$this->_objPrefix = new RPGEnchant($arrRow['intPrefixEnchantID']);
		}
		if(isset($arrRow['intSuffixEnchantID'])){
			$this->_objSuffix = new RPGEnchant($arrRow['intSuffixEnchantID']);
		}
	}
	
	private function loadXMLName(){
		$objDB = new Database();
		$strSQL = "SELECT strXML
					FROM tblclothingdesc
						WHERE intItemID = " . $objDB->quote($this->_intItemID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return $arrRow['strXML'];
	}
		
	private function loadSize(){
		$objDB = new Database();
		$strSQL = "SELECT strSize
					FROM tblcharacteritemxr
						WHERE intItemInstanceID = " . $objDB->quote($this->_intItemInstanceID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return $arrRow['strSize'];
	}
	
	public function saveEnchants(){
		$objDB = new Database();
		$strSQL = "SELECT intItemInstanceID FROM tbliteminstanceenchant
					WHERE intItemInstanceID = " . $objDB->quote($this->_intItemInstanceID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		if(isset($arrRow['intItemInstanceID'])){
			$strSQL = "UPDATE tbliteminstanceenchant SET intPrefixEnchantID = " . $objDB->quote($this->_objPrefix->getEnchantID()) . ", intSuffixEnchantID = " . $objDB->quote($this->_objSuffix->getEnchantID()) . "
						WHERE intItemInstanceID = " . $objDB->quote($this->_intItemInstanceID);
			$objDB->query($strSQL);
		}
		else{
			$strSQL = "INSERT INTO tbliteminstanceenchant (intItemInstanceID, intPrefixEnchantID, intSuffixEnchantID)
						VALUES (" . $objDB->quote($this->_intItemInstanceID) . ", " . $objDB->quote($this->_objPrefix->getEnchantID()) . ", " . $objDB->quote($this->_objSuffix->getEnchantID()) . ")";
			$objDB->query($strSQL);
		}
	}
	
	public function setPrefix($objPrefix){
		$this->_objPrefix = $objPrefix;
	}
	
	public function setSuffix($objSuffix){
		$this->_objSuffix = $objSuffix;
	}
	
	public function getPrefix(){
		return $this->_objPrefix;
	}
	
	public function getSuffix(){
		return $this->_objSuffix;
	}
	
	public function removePrefix(){
		$this->_objPrefix = null;
	}
	
	public function removeSuffix(){
		$this->_objSuffix = null;
	}
	
	public function removeEnchants(){
		$this->_objPrefix = null;
		$this->_objSuffix = null;
	}
	
	public function equip(){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET blnEquipped = 1
					WHERE intItemInstanceID = " . $objDB->quote($this->_intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function unequip() {
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET blnEquipped = 0
					WHERE intItemInstanceID = " . $objDB->quote($this->_intItemInstanceID);
		$objDB->query($strSQL);
        foreach ($this as $key => $value) {
            $this->$key = null;  //set to null instead of unsetting
        }
    }
	
	public function getItemID(){
		return $this->_intItemID;
	}
	
	public function setItemID($intItemID){
		$this->_intItemID = $intItemID;
	}
	
	public function getItemInstanceID(){
		return $this->_intItemInstanceID;
	}
	
	public function setItemInstanceID($intItemInstanceID){
		$this->_intItemInstanceID = $intItemInstanceID;
	}
	
	public function getItemName(){
		return $this->_strItemName;
	}
	
	public function setItemName($strItemName){
		$this->_strItemName = $strItemName;
	}
	
	public function getItemDesc(){
		return $this->_txtItemDesc;
	}
	
	public function setItemDesc($txtItemDesc){
		$this->_txtItemDesc = $txtItemDesc;
	}
	
	public function getCalories(){
		return $this->_intCalories;
	}
	
	public function setCalories($intCalories){
		$this->_intCalories = $intCalories;
	}
	
	public function getHPHeal(){
		return $this->_intHPHeal;
	}
	
	public function setHPHeal($intHPHeal){
		$this->_intHPHeal = $intHPHeal;
	}
	
	public function getDamage(){
		return $this->_intDamage;
	}
	
	public function setDamage($intDamage){
		$this->_intDamage = $intDamage;
	}
		
	public function getMagicDamage(){
		return $this->_intMagicDamage;
	}
	
	public function setMagicDamage($intMagicDamage){
		$this->_intMagicDamage = $intMagicDamage;
	}
	
	public function getDefence(){
		return $this->_intDefence;
	}
	
	public function setDefence($intDefence){
		$this->_intDefence = $intDefence;
	}
	
	public function getMagicDefence(){
		return $this->_intMagicDefence;
	}
	
	public function setMagicDefence($intMagicDefence){
		$this->_intMagicDefence = $intMagicDefence;
	}
	
	public function getSellPrice(){
		return $this->_intSellPrice;
	}
	
	public function setSellPrice($intSellPrice){
		$this->_intSellPrice = $intSellPrice;
	}
	
	public function getStatDamage(){
		return $this->_strStatDamage;
	}
	
	public function setStatDamage($strStatDamage){
		$this->_strStatDamage = $strStatDamage;
	}
	
	public function getSize(){
		return $this->_strSize;
	}
	
	public function setSize($strSize){
		$this->_strSize = $strSize;
	}
	
	public function getQuantity(){
		return $this->_intQuantity;
	}
	
	public function setQuantity($intQuantity){
		$this->_intQuantity = $intQuantity;
	}
	
	public function getItemType(){
		return $this->_strItemType;
	}
	
	public function setItemType($strItemType){
		$this->_strItemType = $strItemType;
	}
	
	public function getHandType(){
		return $this->_strHandType;
	}
	
	public function setHandType($strHandType){
		$this->_strHandType = $strHandType;
	}
	
	public function getAppearanceText(){
		return $this->_arrAppearanceText;
	}
	
	public function setAppearanceText($arrAppearanceText){
		$this->_arrAppearanceText = $arrAppearanceText;
	}
	
	public function getResponseText(){
		return $this->_arrResponseText;
	}
	
	public function setResponseText($arrResponseText){
		$this->_arrResponseText = $arrResponseText;
	}
	
	public function getEquipText(){
		return $this->_arrEquipText;
	}
	
	public function setEquipText($arrEquipText){
		$this->_arrEquipText = $arrEquipText;
	}
	
	public function getCreatedOn(){
		return $this->_dtmCreatedOn;
	}
	
	public function setCreatedOn($dtmCreatedOn){
		$this->_dtmCreatedOn = $dtmCreatedOn;
	}
	
	public function getCreatedBy(){
		return $this->_strCreatedBy;
	}
	
	public function setCreatedBy($strCreatedBy){
		$this->_strCreatedBy = $strCreatedBy;
	}
	
	public function getModifiedOn(){
		return $this->_dtmModifiedOn;
	}
	
	public function setModifiedOn($dtmModifiedOn){
		$this->_dtmModifiedOn = $dtmModifiedOn;
	}
	
	public function getModifiedBy(){
		return $this->_strModifiedBy;
	}
	
	public function setModifiedBy($strModifiedBy){
		$this->_strModifiedBy = $strModifiedBy;
	}
	
	public function getXML(){
		return $this->_strXML;
	}
	
	public function setXML($strXML){
		$this->_strXML = $strXML;
	}
}

?>
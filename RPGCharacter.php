<?php

require_once "Database.php";
include_once "RPGItem.php";
include_once "RPGTime.php";
include_once "RPGStats.php";
include_once "RPGStatusEffect.php";
include_once "RPGXMLReader.php";
include_once "RPGOutfitReader.php";
include_once "constants.php";

class RPGCharacter{
	
	private $_intRPGCharacterID;
	private $_strUserID;
	private $_strRPGCharacterName;
	private $_intHeight;
	private $_dblWeight;
	private $_intDigestionRate;
	private $_intFloorID;
	private $_intCurrentFloorID;
	private $_intDay;
	private $_strTime;
	private $_intEventID;
	private $_intEventNodeID;
	private $_intStateID;
	private $_intTownID;
	private $_intLocationID;
	private $_intArmourRipLevel;
	private $_strGender;
	private $_strOrientation;
	private $_strPersonality;
	private $_strFatStance;
	private $_strHairColour;
	private $_strHairLength;
	private $_strEyeColour;
	private $_strEthnicity;
	private $_objStats;
	private $_objEquippedWeapon;
	private $_objEquippedSecondary;
	private $_objEquippedArmour;
	private $_intCurrentHP;
	private $_intExperience;
	private $_intRequiredExperience;
	private $_intLevel;
	private $_intStatPoints;
	private $_intGold;
	private $_arrCombat;
	private $_arrStatusEffectList;
	private $_arrStatModifiers;
	private $_strEquipClothingText;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	
	public function RPGCharacter($intRPGCharacterID = null){
		if($intRPGCharacterID){
			$this->loadRPGCharacterInfo($intRPGCharacterID);
		}
	}
	
	private function populateVarFromRow($arrCharacterInfo){
		$this->setRPGCharacterID($arrCharacterInfo['intRPGCharacterID']);
		$this->setUserID($arrCharacterInfo['strUserID']);
		$this->setRPGCharacterName($arrCharacterInfo['strRPGCharacterName']);
		$this->setHeight($arrCharacterInfo['intHeight']);
		$this->setWeight($arrCharacterInfo['dblWeight']);
		$this->setDigestionRate($arrCharacterInfo['intDigestionRate']);
		$this->setFloor($arrCharacterInfo['intFloorID']);
		$this->setCurrentFloorID($arrCharacterInfo['intCurrentFloorID']);
		$this->setDay($arrCharacterInfo['intDay']);
		$this->setTime($arrCharacterInfo['strTime']);
		$this->setEventID($arrCharacterInfo['intEventID']);
		$this->setEventNodeID($arrCharacterInfo['intEventNodeID']);
		$this->setStateID($arrCharacterInfo['intStateID']);
		$this->setTownID($arrCharacterInfo['intTownID']);
		$this->setLocationID($arrCharacterInfo['intLocationID']);
		$this->setArmourRipLevel($arrCharacterInfo['intArmourRipLevel']);
		$this->setGender($arrCharacterInfo['strGender']);
		$this->setOrientation($arrCharacterInfo['strOrientation']);
		$this->setPersonality($arrCharacterInfo['strPersonality']);
		$this->setFatStance($arrCharacterInfo['strFatStance']);
		$this->setHairColour($arrCharacterInfo['strHairColour']);
		$this->setHairLength($arrCharacterInfo['strHairLength']);
		$this->setEyeColour($arrCharacterInfo['strEyeColour']);
		$this->setEthnicity($arrCharacterInfo['strEthnicity']);
		$this->setCurrentHP($arrCharacterInfo['intCurrentHP']);
		$this->setExperience($arrCharacterInfo['intExperience']);
		$this->setLevel($arrCharacterInfo['intLevel']);
		$this->setStatPoints($arrCharacterInfo['intStatPoints']);
		$this->setGold($arrCharacterInfo['intGold']);
		$this->setCreatedOn($arrCharacterInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrCharacterInfo['strCreatedBy']);
		$this->setModifiedOn($arrCharacterInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrCharacterInfo['strModifiedBy']);
	}
	
	private function loadRPGCharacterInfo($intRPGCharacterID, $blnNewStats = false){
		$objDB = new Database();
		$arrCharacterInfo = array();
			$strSQL = "SELECT *
						FROM tblrpgcharacter
							WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrCharacterInfo['intRPGCharacterID'] = $arrRow['intRPGCharacterID'];
				$arrCharacterInfo['strUserID'] = $arrRow['strUserID'];
				$arrCharacterInfo['strRPGCharacterName'] = $arrRow['strRPGCharacterName'];
				$arrCharacterInfo['intHeight'] = $arrRow['intHeight'];
				$arrCharacterInfo['dblWeight'] = $arrRow['dblWeight'];
				$arrCharacterInfo['intDigestionRate'] = $arrRow['intDigestionRate'];
				$arrCharacterInfo['intFloorID'] = $arrRow['intFloorID'];
				$arrCharacterInfo['intCurrentFloorID'] = $arrRow['intCurrentFloorID'];
				$arrCharacterInfo['intDay'] = $arrRow['intDay'];
				$arrCharacterInfo['strTime'] = $arrRow['strTime'];
				$arrCharacterInfo['intEventID'] = $arrRow['intEventID'];
				$arrCharacterInfo['intEventNodeID'] = $arrRow['intEventNodeID'];
				$arrCharacterInfo['intStateID'] = $arrRow['intStateID'];
				$arrCharacterInfo['intTownID'] = $arrRow['intTownID'];
				$arrCharacterInfo['intLocationID'] = $arrRow['intLocationID'];
				$arrCharacterInfo['intArmourRipLevel'] = $arrRow['intArmourRipLevel'];
				$arrCharacterInfo['strGender'] = $arrRow['strGender'];
				$arrCharacterInfo['strOrientation'] = $arrRow['strOrientation'];
				$arrCharacterInfo['strPersonality'] = $arrRow['strPersonality'];
				$arrCharacterInfo['strFatStance'] = $arrRow['strFatStance'];
				$arrCharacterInfo['strHairColour'] = $arrRow['strHairColour'];
				$arrCharacterInfo['strHairLength'] = $arrRow['strHairLength'];
				$arrCharacterInfo['strEyeColour'] = $arrRow['strEyeColour'];
				$arrCharacterInfo['strEthnicity'] = $arrRow['strEthnicity'];
				$arrCharacterInfo['intCurrentHP'] = $arrRow['intCurrentHP'];
				$arrCharacterInfo['intExperience'] = $arrRow['intExperience'];
				$arrCharacterInfo['intLevel'] = $arrRow['intLevel'];
				$arrCharacterInfo['intStatPoints'] = $arrRow['intStatPoints'];
				$arrCharacterInfo['intGold'] = $arrRow['intGold'];
				$arrCharacterInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrCharacterInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrCharacterInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrCharacterInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrCharacterInfo);
		$this->_objEquippedArmour = $this->loadEquippedArmour();
		$this->_objEquippedWeapon = $this->loadEquippedWeapon();
		$this->_objEquippedSecondary = $this->loadEquippedSecondary();
		$this->_objStats = new RPGStats($intRPGCharacterID);
		if($blnNewStats == true){
			$this->_objStats->createNewEntry();
			$this->setTownID(0);
		}
		$this->_objStats->loadBaseStats();
		$this->_objStats->loadAbilityStats();
		if(!isset($_SESSION['objUISettings'])){
			$_SESSION['objUISettings'] = new UISettings($this->_intRPGCharacterID);
			$_SESSION['objUISettings']->loadOverrides();
		}
		$this->loadStatusEffects();
		$this->_intRequiredExperience = $this->loadRequiredExperience();
	}
	
	public function save(){
		$objDB = new Database();
		$strSQL = "UPDATE tblrpgcharacter
					SET intHeight = " . $objDB->quote($this->_intHeight) . ",
						dblWeight = " . $objDB->quote($this->_dblWeight) . ",
						intFloorID = " . $objDB->quote($this->_intFloorID) . ",
						intCurrentFloorID = " . $objDB->quote($this->_intCurrentFloorID) . ",
						intDigestionRate = " . $objDB->quote($this->_intDigestionRate) . ",
						intDay = " . $objDB->quote($this->_intDay) . ",
						strTime = " . $objDB->quote($this->_strTime) . ",
						intEventID = " . $objDB->quote($this->_intEventID) . ",
						intEventNodeID = " . $objDB->quote($this->_intEventNodeID) . ",
						intStateID = " . $objDB->quote($this->_intStateID) . ",
						intTownID = " . $objDB->quote($this->_intTownID) . ",
						intLocationID = " . $objDB->quote($this->_intLocationID) . ",
						intArmourRipLevel = " . $objDB->quote($this->_intArmourRipLevel) . ",
						strGender = " . $objDB->quote($this->_strGender) . ",
						strOrientation = " . $objDB->quote($this->_strOrientation) . ",
						strPersonality = " . $objDB->quote($this->_strPersonality) . ",
						strFatStance = " . $objDB->quote($this->_strFatStance) . ",
						strHairColour = " . $objDB->quote($this->_strHairColour) . ",
						strHairLength = " . $objDB->quote($this->_strHairLength) . ",
						strEyeColour = " . $objDB->quote($this->_strEyeColour) . ",
						strEthnicity = " . $objDB->quote($this->_strEthnicity) . ",
						intCurrentHP = " . $objDB->quote($this->_intCurrentHP) . ",
						intExperience = " . $objDB->quote($this->_intExperience) . ",
						intLevel = " . $objDB->quote($this->_intLevel) . ",
						intStatPoints = " . $objDB->quote($this->_intStatPoints) . ",
						intGold = " . $objDB->quote($this->_intGold) . "
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$objDB->query($strSQL);
		foreach($this->_arrStatusEffectList as $key => $objStatusEffect){
			$objStatusEffect->save($this->_intRPGCharacterID);
		}
		$this->_objStats->saveAll();
	}
	
	public function createNewCharacter($strUserID, $strRPGCharacterName, $dblWeight, $intHeight, $strGender, $strOrientation, $strPersonality, $strFatStance, $strHairColour, $strHairLength, $strEyeColour, $strEthnicity){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblrpgcharacter
					(strUserID, strRPGCharacterName, dblWeight, intHeight, strGender, strOrientation, strPersonality, strFatStance, strHairColour, strHairLength, strEyeColour, strEthnicity, intStateID, intEventID, intLocationID, intCurrentFloorID, dtmCreatedOn, strCreatedBy)
						VALUES
					(" . $objDB->quote($strUserID) . ", " . $objDB->quote($strRPGCharacterName) . ", " . $objDB->quote($dblWeight) . ", " . $objDB->quote($intHeight) . ", " . $objDB->quote($strGender) . ", " . $objDB->quote($strOrientation) . ", " . $objDB->quote($strPersonality) . ", " . $objDB->quote($strFatStance) . ", " . $objDB->quote($strHairColour) . ", " . $objDB->quote($strHairLength) . ", " . $objDB->quote($strEyeColour) . ", " . $objDB->quote($strEthnicity) . ", 8, 2, 0, 1, '" . date('Y-m-d H:i:s') . "', 'system')";
		$objDB->query($strSQL);
		$intRPGCharacterID = $objDB->lastInsertID();
		$this->loadRPGCharacterInfo($intRPGCharacterID, true);
	}
	
	public function addToCharacterEventLog($intEventID){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharactereventxr
						(intRPGCharacterID, intEventID, dtmDateAdded)
					VALUES
						(" . $objDB->quote($this->getRPGCharacterID()) . ", " . $objDB->quote($intEventID) . ", NOW())";
		$objDB->query($strSQL);
	}
	
	public function hasViewedEvent($intEventID){
		$objDB = new Database();
		$strSQL = "SELECT intEventID FROM tblcharactereventxr
					WHERE intEventID = " . $objDB->quote($intEventID) . " AND
							intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return (isset($arrRow['intEventID']) ? true : false);
	}
	
	public function setViewedEvent($intEventID){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharactereventxr
					(intEventID, intRPGCharacterID, dtmDateAdded) VALUES
					(" . $objDB->quote($intEventID) . ", " . $objDB->quote($this->_intRPGCharacterID) . ", NOW())";
		$rsResult = $objDB->query($strSQL);
	}
	
	public function loadEquippedArmour(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Armour:%'
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$objArmour = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
		return $objArmour;
	}
	
	public function loadEquippedWeapon(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Weapon:%'
						AND (strHandType = 'Primary' OR strHandType = 'Both')
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$objWeapon = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
		return $objWeapon;
	}
	
	public function loadEquippedSecondary(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Weapon:%'
						AND strHandType = 'Secondary'
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$objSecondary = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
		return $objSecondary;
	}
	
	public function loadStatusEffects(){
		$objDB = new Database();
		$this->_arrStatusEffectList = array();
		$strSQL = "SELECT intCharacterStatusEffectXRID, strStatusEffectName, tblstatuseffect.intStatusEffectID as intStatusEffectID, intItemInstanceID, intTimeRemaining, tblstatuseffectstatchange.intOverrideID as intOverrideID
					FROM tblcharacterstatuseffectxr
						INNER JOIN tblstatuseffect
							USING (intStatusEffectID)
						INNER JOIN tblstatuseffectstatchange
							USING (intStatusEffectID)
						WHERE intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID());
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$objStatusEffect = new RPGStatusEffect($arrRow['strStatusEffectName']);
			$objStatusEffect->setTimeRemaining($arrRow['intTimeRemaining']);
			$objStatusEffect->setItemInstanceID($arrRow['intItemInstanceID']);
			$objStatusEffect->setCharacterStatusEffectXRID($arrRow['intCharacterStatusEffectXRID']);
			$this->_arrStatusEffectList[$objStatusEffect->getStatusEffectName()] = $objStatusEffect;
			if(isset($arrRow['intOverrideID'])){
				$this->addOverride($arrRow['intOverrideID']);
			}
		}
	}
	
	public function addToStatusEffects($strStatusEffectName){
		$objStatusEffect = new RPGStatusEffect($strStatusEffectName);
		$this->_arrStatusEffectList[$strStatusEffectName] = $objStatusEffect;
		$this->_arrStatusEffectList[$strStatusEffectName]->create($this->_intRPGCharacterID, $objStatusEffect->getItemInstanceID());
		if($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID() != NULL){
			$this->addOverride($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID());
		}
	}
	
	public function removeFromStatusEffects($strStatusEffectName){
		if($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID() != NULL){
			$this->removeOverride($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID());
		}
		$this->_arrStatusEffectList[$strStatusEffectName]->remove($this->_intRPGCharacterID);
		unset($this->_arrStatusEffectList[$strStatusEffectName]);
	}
	
	public function giveItem($intItemID, $strClothingSize = null){
		$objDB = new Database();
		$objItem = new RPGItem($intItemID);
		$strSQL = "INSERT INTO tblcharacteritemxr
						(intRPGCharacterID, intItemID, intCaloriesRemaining, strSize, dtmDateAdded)
					VALUES
						(" . $objDB->quote($this->getRPGCharacterID()) . ", " . $objDB->quote($intItemID) . ", " . $objDB->quote($objItem->getCalories()) . ", " . $objDB->quote($strClothingSize) . ", NOW())";
		$objDB->query($strSQL);
		return $objDB->lastInsertID();
	}
	
	public function giveItemWithSetEnchants($intItemID, $strClothingSize = null, $intPrefixID = null, $intSuffixID = null){
		$objDB = new Database();
		$objItem = new RPGItem($intItemID);
		$strSQL = "INSERT INTO tblcharacteritemxr
						(intRPGCharacterID, intItemID, intCaloriesRemaining, strSize, dtmDateAdded)
					VALUES
						(" . $objDB->quote($this->getRPGCharacterID()) . ", " . $objDB->quote($intItemID) . ", " . $objDB->quote($objItem->getCalories()) . ", " . $objDB->quote($strClothingSize) . ", NOW())";
		$objDB->query($strSQL);
		$itemInstanceID = $objDB->lastInsertID();
		
		$strSQL = "INSERT INTO tbliteminstanceenchant
						(intItemInstanceID, intPrefixEnchantID, intSuffixEnchantID)
					VALUES
						(" . $objDB->quote($itemInstanceID) . ", " . $objDB->quote($intPrefixID) . ", " . $objDB->quote($intSuffixID) . ")";
		$objDB->query($strSQL);
		$this->addOverride(3);
	}
	
	public function removeEnchantsFromEquippedArmour(){
		$intItemInstanceID = $this->getEquippedArmour()->getItemInstanceID();
		$this->statusEffectCheck("_objEquippedArmour", "removeFromStatusEffects");
		$this->getEquippedArmour()->setPrefix(null);
		$this->getEquippedArmour()->setSuffix(null);
		$objDB = new Database();
		$strSQL = "DELETE FROM tbliteminstanceenchant
						WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function tickStatusEffects(){
		foreach($this->_arrStatusEffectList as $key => $objStatusEffect){
			if(!$objStatusEffect->getInfinite()){
				$objStatusEffect->tickStatusEffect();
			}
			$strStatName = $objStatusEffect->getStatName();
			$intStatMin = $objStatusEffect->getStatChangeMin();
			$intStatMax = $objStatusEffect->getStatChangeMax();
			$intStatChange = mt_rand($intStatMin, $intStatMax);
			$strFunctionNameSet = "set" . $strStatName;
			$strFunctionNameGet = "get" . $strStatName;
			if($objStatusEffect->getIncremental()){
				$this->$strFunctionNameSet($this->$strFunctionNameGet() + $intStatChange);
			}
			else{
				$this->_arrStatModifiers[$strStatName] = $intStatChange;
			}
		}
	}
	
	public function getStatusEffectList(){
		return $this->_arrStatusEffectList;
	}
	
	public function eatItem($intItemInstanceID, $intHPHeal){
		$this->healHP($intHPHeal);
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET blnDigesting = 1
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function dropItem($intItemInstanceID){
		$objDB = new Database();
		$strSQL = "DELETE FROM tblcharacteritemxr
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function forceEatItem($intItemID){
		$intItemInstanceID = $this->giveItem($intItemID);
		$objItem = new RPGItem($intItemID);
		$this->healHP($objItem->getHPHeal());
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET blnDigesting = 1
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function hasItem($intItemInstanceID){
		$objDB = new Database();
		$strSQL = "SELECT intItemInstanceID FROM tblcharacteritemxr
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return isset($arrRow['intItemInstanceID']) ? true : false;
	}
	
	public function healHP($intHPHeal){
		$this->setCurrentHP(min($this->getModifiedMaxHP(), ($this->getCurrentHP() + $intHPHeal)));
	}
	
	public function equipArmour($intItemInstanceID, $intItemID){
		$this->unequipArmour();
		$this->_objEquippedArmour = new RPGItem($intItemID, $intItemInstanceID);
		$this->statusEffectCheck("_objEquippedArmour", "addToStatusEffects");
		if($this->equipClothingCheck()){
			$this->_objEquippedArmour->equip();
		}
		else{
			$this->unequipArmour();
		}
	}
	
	public function equipWeapon($intItemInstanceID, $intItemID){
		$this->unequipWeapon();
		$this->_objEquippedWeapon = new RPGItem($intItemID, $intItemInstanceID);
		$this->_objEquippedWeapon->equip();
		if($this->_objEquippedWeapon->getHandType() == 'Both'){
			$this->unequipSecondary();
		}
		$this->statusEffectCheck("_objEquippedWeapon", "addToStatusEffects");
	}
	
	public function equipSecondary($intItemInstanceID, $intItemID){
		if($this->getEquippedWeapon()->getHandType() != "Both"){
			$this->unquipSecondary();
			$this->_objEquippedSecondary = new RPGItem($intItemID, $intItemInstanceID);
			$this->_objEquippedSecondary->equip();
			$this->statusEffectCheck("_objEquippedSecondary", "addToStatusEffects");
		}
	}
	
	public function addOverride($intOverrideID){
		$_SESSION['objUISettings']->addToOverrides($intOverrideID);
	}
	
	public function removeOverride($intOverrideID){
		$_SESSION['objUISettings']->removeFromOverrides($intOverrideID);
	}
	
	public function equipClothingCheck(){
		global $arrClothingSizes;
		$intClothingBMI = $arrClothingSizes[$this->_objEquippedArmour->getSize()];
		$intCharacterBMI = $this->getBMI();
		$intBMIDifference = round($intCharacterBMI - $intClothingBMI);
		
		if(isset($_SESSION['objUISettings']->getOverrides()[2]) || $this->_objEquippedArmour->getSize() == 'Stretch'){
			$intBMIDifference = 0;
		}
		
		$objXML = new RPGOutfitReader($this->getEquippedArmour()->getXML());
		$node = $objXML->findNodeBetweenBMI('equip', $intBMIDifference);
		$this->setEquipClothingText(strval($node[0]->text));
		if($node[0]->wearable == 'true'){
			$blnReturn = true;
			$this->setArmourRipLevel(intval($node[0]->responseBMI));
		}
		else{
			$blnReturn = false;
		}
		
		return $blnReturn;
	}
	
	public function ripClothingCheck(){
		if($this->getEquippedArmour()->getXML() == null){
			return "";
		}
		else{
			global $arrClothingSizes;
			$objXML = new RPGOutfitReader($this->getEquippedArmour()->getXML());
			$intClothingBMI = $arrClothingSizes[$this->_objEquippedArmour->getSize()];
			$intCharacterBMI = $this->getBMI();
			
			$intPrevArmourRipLevel = $this->getArmourRipLevel();
			$intBMIDifference = round($intCharacterBMI - $intClothingBMI);
			
			if(isset($_SESSION['objUISettings']->getOverrides()[2]) || $this->_objEquippedArmour->getSize() == 'Stretch'){
				$intBMIDifference = 0;
			}
			
			$node = $objXML->findNodeBetweenBMI('equip', $intBMIDifference);
			$blnChange = false;
			
			if($intPrevArmourRipLevel != $node[0]->responseBMI){
				$this->setArmourRipLevel(intval($node[0]->responseBMI));
				$blnChange = true;
			}
			
			if($blnChange){
				$node = $objXML->findNodeAtBMI('response', $this->getArmourRipLevel());
				if(isset($node[0]->effect) && ($node[0]->effect == 'rip' || $node[0]->effect == 'fall')){
					$this->unequipArmour();
				}
				return "<br/><br/>" . $node[0]->text;
			}
			else{
				return "";
			}
		}
	}
	
	public function getEquippedArmour(){
		return $this->_objEquippedArmour;
	}
	
	public function setEquippedArmour($objArmour){
		$this->_objEquippedArmour = $objArmour;
	}
	
	public function getEquippedWeapon(){
		return $this->_objEquippedWeapon;
	}
	
	public function setEquippedWeapon($objWeapon){
		$this->_objEquippedWeapon = $objWeapon;
	}
	
	public function getEquippedSecondary(){
		return $this->_objEquippedSecondary;
	}
	
	public function setEquippedSecondary($objSecondary){
		$this->_objEquippedSecondary = $objSecondary;
	}
	
	public function setEquipClothingText($strText){
		$this->_strEquipClothingText = $strText;
	}
	
	public function getEquipClothingText(){
		return $this->_strEquipClothingText;
	}
	
	public function statusEffectCheck($strGearType, $strAction){
		if($this->$strGearType->getPrefix() !== null){
			foreach($this->$strGearType->getPrefix()->getStatChanges() as $key => $objStatChange){
				$this->$strAction($objStatChange->getStatusEffect()->getStatusEffectName());
			}
		}
		if($this->$strGearType->getSuffix() !== null){
			foreach($this->$strGearType->getSuffix()->getStatChanges() as $key => $objStatChange){
				$this->$strAction($objStatChange->getStatusEffect()->getStatusEffectName());
			}
		}
		
	}
	
	public function unequipArmour(){
		$this->statusEffectCheck("_objEquippedArmour", "removeFromStatusEffects");
		$this->_objEquippedArmour->unequip();
		$this->setArmourRipLevel(NULL);
	}
	
	public function unequipWeapon(){
		$this->statusEffectCheck("_objEquippedWeapon", "removeFromStatusEffects");
		if($this->_objEquippedWeapon->getHandType() == 'Both'){
			$this->unequipSecondary();
		}
		$this->_objEquippedWeapon->unequip();
	}
	
	public function unequipSecondary(){
		$this->statusEffectCheck("_objEquippedSecondary", "removeFromStatusEffects");
		$this->_objEquippedSecondary->unequip();
	}
	
	public function isEquipped($intItemInstanceID){
		$objDB = new Database();
		$strSQL = "SELECT intItemInstanceID
					FROM tblcharacteritemxr
					WHERE blnEquipped = 1
					AND intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return $arrRow == false ? false : true;
	}
	
	public function digestItems($intHours = 0.25){
		$objDB = new Database();
		
		$strSQL = "SELECT intItemInstanceID, intCaloriesRemaining
					FROM tblcharacteritemxr
						WHERE blnDigesting = 1
							AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$intNewCalories = $arrRow['intCaloriesRemaining'] - ($this->getDigestionRate() * ($intHours * 4));
			$blnDelete = $intNewCalories <= 0 ? 1 : 0;
			
			if($blnDelete){
				$this->setWeight($this->getWeight() + ($arrRow['intCaloriesRemaining'] / intCALORIES_PER_POUND));
				$strSQL = "DELETE FROM tblcharacteritemxr
							WHERE intItemInstanceID = " . $objDB->quote($arrRow['intItemInstanceID']);
				$objDB->query($strSQL);
			}
			else{
				$this->setWeight($this->getWeight() + ($this->getDigestionRate() / intCALORIES_PER_POUND));
				$strSQL = "UPDATE tblcharacteritemxr
							SET intCaloriesRemaining = " . $objDB->quote($intNewCalories) . "
							WHERE intItemInstanceID = " . $objDB->quote($arrRow['intItemInstanceID']);
				$objDB->query($strSQL);
			}
		}
	}
	
	public function getBMI(){
		return ($this->getWeight() / dblLBS_PER_KG) / pow($this->getHeight() / 100, 2);
	}
	
	public function getHeightInFeet(){
		$dblFeet = $this->getHeight() / dblCM_PER_FOOT;
		$whole = floor($dblFeet);
		$fraction = $dblFeet - $whole;
		$intInches = round($fraction * intFEET_PER_INCH);
		if($intInches == 12){
			$whole++;
			$intInches = 0;
		}
		return strval($whole) . "'" . strval($intInches) . "\"";
	}
	
	public function checkEndOfEvent(){
		global $arrStateValues;
		$blnEndOfEvent = false;
		$objEvent = new RPGEvent($this->getEventID());
		$objXML = new RPGXMLReader($objEvent->getXML());
		if((in_array($this->getEventNodeID(), (array)$objXML->getEndNodes())) || $objXML->getEndNodes() == 'any'){
			if(!$this->hasViewedEvent($this->getEventID())){
				$this->addToCharacterEventLog($this->getEventID());
			}	
			$this->removeOverride(3);
			if(isset($_SESSION['objEnemy'])){
				unset($_SESSION['objEnemy']);
			}
			$blnEndOfEvent = true;
		}
		return $blnEndOfEvent;
	}
	
	public function takeDamage($intDamage){
		$intDamage = max(0, $intDamage);
		$this->setCurrentHP($this->getCurrentHP() - $intDamage);
		return $intDamage;
	}
	
	public function isDead(){
		return intval($this->getCurrentHP()) <= 0 ? 1 : 0;
	}
	
	public function reviveCharacter(){
		$this->setCurrentHP($this->getModifiedMaxHP());
	}
	
	public function getRPGCharacterID(){
		return $this->_intRPGCharacterID;
	}
		
	public function setRPGCharacterID($intRPGCharacterID){
		$this->_intRPGCharacterID = $intRPGCharacterID;
	}
	
	public function getUserID(){
		return $this->_strUserID;
	}
	
	public function setUserID($strUserID){
		$this->_strUserID = $strUserID;
	}
	
	public function getRPGCharacterName(){
		return $this->_strRPGCharacterName;
	}
	
	public function setRPGCharacterName($strRPGCharacterName){
		$this->_strRPGCharacterName = $strRPGCharacterName;
	}
	
	public function getHeight(){
		return $this->_intHeight;
	}
	
	public function setHeight($intHeight){
		$this->_intHeight = $intHeight;
	}
	
	public function getWeight(){
		return $this->_dblWeight;
	}
	
	public function setWeight($dblWeight){
		$this->_dblWeight = $dblWeight;
	}
	
	public function getDigestionRate(){
		return $this->_intDigestionRate;
	}
	
	public function setDigestionRate($intDigestionRate){
		$this->_intDigestionRate = $intDigestionRate;
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
	
	public function getFloor(){
		return $this->_intFloorID;
	}
	
	public function setFloor($intFloorID){
		$this->_intFloorID = $intFloorID;
	}
	
	public function getDay(){
		return $this->_intDay;
	}
	
	public function setDay($intDay){
		$this->_intDay = $intDay;
	}
	
	public function getTime(){
		return $this->_strTime;
	}
	
	public function setTime($strTime){
		$this->_strTime = $strTime;
	}
	
	public function getGender(){
		return $this->_strGender;
	}
	
	public function setGender($strGender){
		$this->_strGender = $strGender;
	}
	
	public function getOrientation(){
		return $this->_strOrientation;
	}
	
	public function setOrientation($strOrientation){
		$this->_strOrientation = $strOrientation;
	}
	
	public function getPersonality(){
		return $this->_strPersonality;
	}
	
	public function setPersonality($strPersonality){
		$this->_strPersonality = $strPersonality;
	}
	
	public function getFatStance(){
		return $this->_strFatStance;
	}
	
	public function setFatStance($strFatStance){
		$this->_strFatStance = $strFatStance;
	}
	
	public function getHairColour(){
		return $this->_strHairColour;
	}
	
	public function setHairColour($strHairColour){
		$this->_strHairColour = $strHairColour;
	}
	
	public function getHairLength(){
		return $this->_strHairLength;
	}
	
	public function setHairLength($strHairLength){
		$this->_strHairLength = $strHairLength;
	}
	
	public function getEyeColour(){
		return $this->_strEyeColour;
	}
	
	public function setEyeColour($strEyeColour){
		$this->_strEyeColour = $strEyeColour;
	}
	
	public function getEthnicity(){
		return $this->_strEthnicity;
	}
	
	public function setEthnicity($strEthnicity){
		$this->_strEthnicity = $strEthnicity;
	}
	
	public function getExperience(){
		return $this->_intExperience;
	}
	
	public function setExperience($intExperience){
		$this->_intExperience = $intExperience;
	}
	
	public function getRequiredExperience(){
		return $this->_intRequiredExperience;
	}
	
	public function setRequiredExperience($intRequiredExperience){
		$this->_intRequiredExperience = $intRequiredExperience;
	}
	
	public function getLevel(){
		return $this->_intLevel;
	}
	
	public function setLevel($intLevel){
		$this->_intLevel = $intLevel;
	}
	
	public function getStatPoints(){
		return $this->_intStatPoints;
	}
	
	public function setStatPoints($intStatPoints){
		$this->_intStatPoints = $intStatPoints;
	}
	
	public function getEventID(){
		return $this->_intEventID;
	}
	
	public function setEventID($intEventID){
		$this->_intEventID = $intEventID;
	}
	
	public function getEventNodeID(){
		return $this->_intEventNodeID;
	}
	
	public function setEventNodeID($intEventNodeID){
		$this->_intEventNodeID = $intEventNodeID;
	}
	
	public function getArmourRipLevel(){
		return $this->_intArmourRipLevel;
	}
	
	public function setArmourRipLevel($intArmourRipLevel){
		$this->_intArmourRipLevel = $intArmourRipLevel;
	}
	
	public function setCombat($intNPCID, $strFirstTurn){
		global $arrStateValues;
		$this->setStateID($arrStateValues["Combat"]);
		$this->_arrCombat[0] = $intNPCID;
		$this->_arrCombat[1] = $strFirstTurn;
		if(isset($_SESSION['objUISettings']->getOverrides()[3])){
			$this->removeOverride(3);
		}
	}
	
	public function gainExperience($intExpGain){
		if($this->getLevel() != 10){
			$this->_intExperience += $intExpGain;
		}
		if($this->_intExperience >= $this->_intRequiredExperience){
			$this->levelUp();
		}
	}
	
	public function levelUp(){
		$this->_intLevel++;
		$this->_intExperience = 0;
		$this->_intRequiredExperience = $this->loadRequiredExperience();
		$this->setStatPoints($this->getStatPoints() + 5);
		$this->setCurrentHP($this->getModifiedMaxHP());
		$this->save();
	}
	
	public function loadRequiredExperience(){
		$objDB = new Database();
		$strSQL = "SELECT intExpToLvl
					FROM tblexperiencechart
					WHERE intLevelID = " . $objDB->quote($this->_intLevel);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return $arrRow['intExpToLvl'];
	}
	
	public function getCurrentHP(){
		return $this->_intCurrentHP;
	}
	
	public function setCurrentHP($intCurrentHP){
		$this->_intCurrentHP = $intCurrentHP;
	}
	
	public function getModifiedMaxHP(){
		return round($this->_objStats->getBaseStats()['intMaxHP'] + ($this->_objStats->getCombinedStats('intVitality') / 2));
	}
	
	public function getCombat(){
		return $this->_arrCombat;
	}
	
	public function getStats(){
		return $this->_objStats;
	}
	
	public function getWaitTime($strWaitType){
		if($strWaitType == 'Standard'){
			// standard attack
			return round(250 - ($this->_objStats->getCombinedStats('intAgility') / 2) + (250 * $this->getImmobilityFactor()));
		}
		// skills will add on or decrease wait time by some amount
	}
	
	public function getModifiedDamage(){
		return round(($this->_objStats->getCombinedStats('intStrength') / 2) + $this->getEquippedWeapon()->getDamage());
	}
	
	public function getModifiedMagicDamage(){
		return round(($this->_objStats->getCombinedStats('intIntelligence') / 2) + $this->getEquippedWeapon()->getMagicDamage());
	}
	
	public function getModifiedDefence(){
		return round(($this->_objStats->getCombinedStats('intVitality') / 4) + $this->getEquippedArmour()->getDefence());
	}
	
	public function getModifiedMagicDefence(){
		return round(($this->_objStats->getCombinedStats('intIntelligence') / 4) + $this->getEquippedArmour()->getMagicDefence());
	}
	
	public function getModifiedBlockRate(){
		return round($this->_objStats->getCombinedStats('intAgility') / 4);
	}
	
	public function getModifiedBlock(){
		return 0.6;
	}
	
	public function getModifiedCritRate(){
		return round($this->_objStats->getCombinedStats('intDexterity') / 4);
	}
	
	public function getModifiedCritDamage(){
		return 1.5;
	}
	
	public function getImmobilityFactor(){
		return max(0, ((($this->getBMI() / 40) / 10) - (($this->_objStats->getCombinedStats('intStrength') / 2) / 100)));
	}
	
	public function receiveGold($intGold){
		$this->_intGold += $intGold;
	}
	
	public function getGold(){
		return $this->_intGold;
	}
	
	public function setGold($intGold){
		$this->_intGold = $intGold;
	}
	
	public function getStateID(){
		return $this->_intStateID;
	}
	
	public function setStateID($intStateID){
		$this->_intStateID = $intStateID;
	}
	
	public function getTownID(){
		return $this->_intTownID;
	}
	
	public function setTownID($intTownID){
		$this->_intTownID = $intTownID;
	}
	
	public function getLocationID(){
		return $this->_intLocationID;
	}
	
	public function setLocationID($intLocationID){
		$this->_intLocationID = $intLocationID;
	}
	
	public function enterFloor($intFloorID){
		global $arrStateValues;
		$this->setTownID(0);
		$this->setLocationID(NULL);
		$this->setCurrentFloorID($intFloorID);
		$this->setStateID($arrStateValues['Field']);
		$this->setEventID(1);
		$this->setEventNodeID(0);
	}
	
	public function exitFloor($intLocationID){
		global $arrStateValues;
		$this->setTownID(1);
		$this->setLocationID($intLocationID);
		$this->setCurrentFloorID(NULL);
		$this->setStateID($arrStateValues['Town']);
	}
	
	public function getSleep($intHours){
		$this->setTime(RPGTime::addHoursToTime($_SESSION['objRPGCharacter']->getTime(), $intHours));
		$this->digestItems($intHours);
	}
	
	public function getCurrentFloorID(){
		return $this->_intCurrentFloorID;
	}
	
	public function setCurrentFloorID($intCurrentFloorID){
		$this->_intCurrentFloorID = $intCurrentFloorID;
	}
}

?>
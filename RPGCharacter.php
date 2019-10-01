<?php

require_once "Database.php";
include_once "RPGItem.php";
include_once "RPGCharacterBody.php";
include_once "RPGPlayerQuests.php";
include_once "RPGRelationship.php";
include_once "RPGNPC.php";
include_once "RPGTime.php";
include_once "RPGFloor.php";
include_once "RPGStats.php";
include_once "RPGSkill.php";
include_once "RPGClass.php";
include_once "RPGPlayerClasses.php";
include_once "RPGCheckpoint.php";
include_once "RPGEvent.php";
include_once "RPGStatusEffect.php";
include_once "RPGXMLReader.php";
include_once "RPGOutfitReader.php";
include_once "constants.php";
include_once "common.php";

class RPGCharacter{
	
	private $_intRPGCharacterID;
	private $_strUserID;
	private $_strRPGCharacterName;
	private $_intHeight;
	private $_dblWeight;
	private $_objBody;
	private $_intDigestionRate;
	private $_intFloorID;
	private $_objCurrentFloor;
	private $_intDay;
	private $_strTime;
	private $_objEvent;
	private $_intStateID;
	private $_intTownID;
	private $_intLocationID;
	private $_strGender;
	private $_strOrientation;
	private $_strPersonality;
	private $_blnLikesFatSelf;
	private $_blnLikesFatOthers;
	private $_strHairColour;
	private $_strHairLength;
	private $_strEyeColour;
	private $_strEthnicity;
	private $_objStats;
	private $_objEquippedWeapon;
	private $_objEquippedSecondary;
	private $_objEquippedArmour;
	private $_objEquippedTop;
	private $_objEquippedBottom;
	private $_intCurrentHP;
	private $_intExperience;
	private $_intRequiredExperience;
	private $_intLevel;
	private $_intStatPoints;
	private $_intGold;
	private $_intCurrentHunger;
	private $_intTicksStuffed;
	private $_intHungerRate;
	private $_arrCombat;
	private $_objPotentialEnemy;
	private $_arrStatusEffectList;
	private $_arrStatModifiers;
	private $_strEquipClothingText;
	private $_strErrorText;
	private $_strHungerText;
	private $_strReviveText;
	private $_arrRelationships;
	private $_objClassList;
	private $_arrCheckpoints;
	private $_objQuestList;
	private $_objParty;
	private $_arrKillBuffs;
	private $_blnLastRoll;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	
	public function __construct($intRPGCharacterID = null){
		if($intRPGCharacterID != null){
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
		$this->setCurrentFloor($arrCharacterInfo['intCurrentFloorID']);
		$this->setDay($arrCharacterInfo['intDay']);
		$this->setTime($arrCharacterInfo['strTime']);
		$this->setStateID($arrCharacterInfo['intStateID']);
		$this->setTownID($arrCharacterInfo['intTownID']);
		$this->setLocationID($arrCharacterInfo['intLocationID']);
		$this->setGender($arrCharacterInfo['strGender']);
		$this->setOrientation($arrCharacterInfo['strOrientation']);
		$this->setPersonality($arrCharacterInfo['strPersonality']);
		$this->setLikesFatSelf($arrCharacterInfo['blnLikesFatSelf']);
		$this->setLikesFatOthers($arrCharacterInfo['blnLikesFatOthers']);
		$this->setHairColour($arrCharacterInfo['strHairColour']);
		$this->setHairLength($arrCharacterInfo['strHairLength']);
		$this->setEyeColour($arrCharacterInfo['strEyeColour']);
		$this->setEthnicity($arrCharacterInfo['strEthnicity']);
		$this->setCurrentHP($arrCharacterInfo['intCurrentHP']);
		$this->setExperience($arrCharacterInfo['intExperience']);
		$this->setLevel($arrCharacterInfo['intLevel']);
		$this->setStatPoints($arrCharacterInfo['intStatPoints']);
		$this->setGold($arrCharacterInfo['intGold']);
		$this->setCurrentHunger($arrCharacterInfo['intCurrentHunger']);
		$this->setTicksStuffed($arrCharacterInfo['intTicksStuffed']);
		$this->setHungerRate($arrCharacterInfo['intHungerRate']);
		$this->setCreatedOn($arrCharacterInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrCharacterInfo['strCreatedBy']);
		$this->setModifiedOn($arrCharacterInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrCharacterInfo['strModifiedBy']);
	}
	
	private function loadRPGCharacterInfo($intRPGCharacterID, $blnNewStats = false, $intFace = null, $intBelly = null, $intBreasts = null, $intArms = null, $intLegs = null, $intButt = null){
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
				$arrCharacterInfo['intStateID'] = $arrRow['intStateID'];
				$arrCharacterInfo['intTownID'] = $arrRow['intTownID'];
				$arrCharacterInfo['intLocationID'] = $arrRow['intLocationID'];
				$arrCharacterInfo['strGender'] = $arrRow['strGender'];
				$arrCharacterInfo['strOrientation'] = $arrRow['strOrientation'];
				$arrCharacterInfo['strPersonality'] = $arrRow['strPersonality'];
				$arrCharacterInfo['blnLikesFatSelf'] = $arrRow['blnLikesFatSelf'];
				$arrCharacterInfo['blnLikesFatOthers'] = $arrRow['blnLikesFatOthers'];
				$arrCharacterInfo['strHairColour'] = $arrRow['strHairColour'];
				$arrCharacterInfo['strHairLength'] = $arrRow['strHairLength'];
				$arrCharacterInfo['strEyeColour'] = $arrRow['strEyeColour'];
				$arrCharacterInfo['strEthnicity'] = $arrRow['strEthnicity'];
				$arrCharacterInfo['intCurrentHP'] = $arrRow['intCurrentHP'];
				$arrCharacterInfo['intExperience'] = $arrRow['intExperience'];
				$arrCharacterInfo['intLevel'] = $arrRow['intLevel'];
				$arrCharacterInfo['intStatPoints'] = $arrRow['intStatPoints'];
				$arrCharacterInfo['intGold'] = $arrRow['intGold'];
				$arrCharacterInfo['intCurrentHunger'] = $arrRow['intCurrentHunger'];
				$arrCharacterInfo['intTicksStuffed'] = $arrRow['intTicksStuffed'];
				$arrCharacterInfo['intHungerRate'] = $arrRow['intHungerRate'];
				$arrCharacterInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrCharacterInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrCharacterInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrCharacterInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrCharacterInfo);
		$this->_objClassList = new RPGPlayerClasses($this->_intRPGCharacterID);
		$this->_arrCheckpoints = array();
		$this->_arrKillBuffs = array();
		$this->loadCheckpoints();
		$this->_arrRelationships = array();
		$this->loadRelationships();
		$this->_objEquippedArmour = $this->loadEquippedArmour();
		$this->_objEquippedTop = $this->loadEquippedTop();
		$this->_objEquippedBottom = $this->loadEquippedBottom();
		$this->_objEquippedWeapon = $this->loadEquippedWeapon();
		$this->_objEquippedSecondary = $this->loadEquippedSecondary();
		$this->_objStats = new RPGStats($intRPGCharacterID);
		if($blnNewStats == true){
			$this->_objStats->createNewEntry();
			$this->_objBody = new RPGCharacterBody();
			$this->_objBody->create($intRPGCharacterID, $intFace, $intBelly, $intBreasts, $intArms, $intLegs, $intButt);
			$this->setTownID(0);
		}
		else{
			$this->_objBody = new RPGCharacterBody($this->_intRPGCharacterID);
		}
		$this->_objStats->loadBaseStats();
		$this->_objStats->loadAbilityStats();
		$this->_objStats->loadStatusEffectStats();
		$this->loadStatusEffects();
		$this->_intRequiredExperience = $this->loadRequiredExperience();
		if($this->_objCurrentFloor->getFloorID() != 0 && $this->_objCurrentFloor->getFloorID() != NULL){
			$this->_objCurrentFloor->loadMaze($this->_objCurrentFloor->getDimension(), $this->_intRPGCharacterID);
		}
		$this->_objQuestList = new RPGPlayerQuests($this->_intRPGCharacterID);
	}
	
	public function save(){
		$objDB = new Database();
		$strSQL = "UPDATE tblrpgcharacter
					SET intHeight = " . $objDB->quote($this->_intHeight) . ",
						dblWeight = " . $objDB->quote($this->_dblWeight) . ",
						intFloorID = " . $objDB->quote($this->_intFloorID) . ",
						intCurrentFloorID = " . $objDB->quote($this->_objCurrentFloor->getFloorID()) . ",
						intDigestionRate = " . $objDB->quote($this->_intDigestionRate) . ",
						intDay = " . $objDB->quote($this->_intDay) . ",
						strTime = " . $objDB->quote($this->_strTime) . ",
						intStateID = " . $objDB->quote($this->_intStateID) . ",
						intTownID = " . $objDB->quote($this->_intTownID) . ",
						intLocationID = " . $objDB->quote($this->_intLocationID) . ",
						strGender = " . $objDB->quote($this->_strGender) . ",
						strOrientation = " . $objDB->quote($this->_strOrientation) . ",
						strPersonality = " . $objDB->quote($this->_strPersonality) . ",
						blnLikesFatSelf = " . $objDB->quote($this->_blnLikesFatSelf) . ",
						blnLikesFatOthers = " . $objDB->quote($this->_blnLikesFatOthers) . ",
						strHairColour = " . $objDB->quote($this->_strHairColour) . ",
						strHairLength = " . $objDB->quote($this->_strHairLength) . ",
						strEyeColour = " . $objDB->quote($this->_strEyeColour) . ",
						strEthnicity = " . $objDB->quote($this->_strEthnicity) . ",
						intCurrentHP = " . $objDB->quote($this->_intCurrentHP) . ",
						intExperience = " . $objDB->quote($this->_intExperience) . ",
						intLevel = " . $objDB->quote($this->_intLevel) . ",
						intStatPoints = " . $objDB->quote($this->_intStatPoints) . ",
						intGold = " . $objDB->quote($this->_intGold) . ",
						intCurrentHunger = " . $objDB->quote($this->_intCurrentHunger) . ",
						intTicksStuffed = " . $objDB->quote($this->_intTicksStuffed) . ",
						intHungerRate = " . $objDB->quote($this->_intHungerRate) . "
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$objDB->query($strSQL);
		foreach($this->_arrStatusEffectList as $key => $objStatusEffect){
			$objStatusEffect->save($this->_intRPGCharacterID);
		}
		$this->_objStats->saveAll();
		$this->_objBody->save();
	}
	
	public function createNewCharacter($strUserID, $strRPGCharacterName, $dblWeight, $intHeight, $strGender, $strOrientation, $strPersonality, $blnLikesFatSelf, $blnLikesFatOthers, $strHairColour, $strHairLength, $strEyeColour, $strEthnicity, $intFace, $intBelly, $intBreasts, $intArms, $intLegs, $intButt){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblrpgcharacter
					(strUserID, strRPGCharacterName, dblWeight, intHeight, strGender, strOrientation, strPersonality, blnLikesFatSelf, blnLikesFatOthers, strHairColour, strHairLength, strEyeColour, strEthnicity, intStateID, intLocationID, intCurrentFloorID, dtmCreatedOn, strCreatedBy)
						VALUES
					(" . $objDB->quote($strUserID) . ", " . $objDB->quote($strRPGCharacterName) . ", " . $objDB->quote($dblWeight) . ", " . $objDB->quote($intHeight) . ", " . $objDB->quote($strGender) . ", " . $objDB->quote($strOrientation) . ", " . $objDB->quote($strPersonality) . ", " . $objDB->quote($blnLikesFatSelf) . ", " . $objDB->quote($blnLikesFatOthers) . ", " . $objDB->quote($strHairColour) . ", " . $objDB->quote($strHairLength) . ", " . $objDB->quote($strEyeColour) . ", " . $objDB->quote($strEthnicity) . ", 8, 0, 1, NOW(), 'system')";
		$objDB->query($strSQL);
		$intRPGCharacterID = $objDB->lastInsertID();
		$this->loadRPGCharacterInfo($intRPGCharacterID, true, $intFace, $intBelly, $intBreasts, $intArms, $intLegs, $intButt);
		$objTutorialEvent = new RPGEvent(2, $this->_intRPGCharacterID);
		$this->setEvent($objTutorialEvent);
		$this->_objParty = new RPGPlayerTeam($this);
	}
	
	public function loadCheckpoints(){
		$objDB = new Database();
		$strSQL = "SELECT * FROM tblcharactercheckpointxr
					WHERE intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID());
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$objCheckpoint = new RPGCheckpoint($arrRow['intCheckpointID'], $this->_intRPGCharacterID, true);
			$this->_arrCheckpoints[$arrRow['intCheckpointID']] = $objCheckpoint;
		}
	}
	
	public function loadRelationships(){
		$objDB = new Database();
		$strSQL = "SELECT * FROM tblnpcinstance
					WHERE intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						ORDER BY intRelationshipLevel DESC";
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$objRelationship = new RPGRelationship($arrRow['intNPCID'], $arrRow['intRPGCharacterID']);
			$this->_arrRelationships[$arrRow['intNPCID']] = $objRelationship;
		}
	}
	
	public function getRelationships(){
		return $this->_arrRelationships;
	}
	
	public function getRelLevelFromID(){
		if(!isset($this->_arrRelationships[$this->getEvent()->getNPCID()])){
			return -1;
		}
		else{
			return $this->_arrRelationships[$this->getEvent()->getNPCID()]->getRelationshipLevel();
		}
	}
	
	public function setRelationship($objRelationship){
		$this->_arrRelationships[$objRelationship->getNPCID()] = $objRelationship;
	}
	
	public function getQuests(){
		return $this->_objQuestList;
	}
	
	public function getClasses(){
		return $this->_objClassList;
	}
	
	public function addToClasses($intClassID){
		$this->_objClassList->addToClassList($intClassID);
	}
	
	public function getCurrentClass(){
		return $this->_objClassList->getCurrentClass();
	}
	
	public function setCurrentClass($intClassID){
		$this->_objClassList->setCurrentClass($intClassID);
	}
	
	public function turnInQuest($intQuestID, $intCheckpointID = NULL, $intClassID = NULL){
		if($this->_objQuestList->isQuestCompleted($intQuestID)){
			$this->_objQuestList->turnInQuest($intQuestID, $this);
			
			if($intCheckpointID != NULL){
				$this->viewCheckpoint($intCheckpointID);
			}
			
			if($intClassID != NULL){
				$this->addToClasses($intClassID);
			}
		}
		else{
			$this->_strErrorText = "The quest you are trying to turn in has not been completed yet.";
		}
	}
	
	public function startNewQuest($intQuestID){
		$this->_objQuestList->startNewQuest($intQuestID);
	}
	
	public function isQuestCompleted($intQuestID){
		return $this->_objQuestList->isQuestCompleted($intQuestID);
	}
	
	public function loadEquippedArmour(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Armour:Armour'
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		if($rsResult->rowCount() > 0){
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			$objArmour = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
			return $objArmour;
		}
		else{
			$objArmour = new RPGItem();
			$objArmour->setWaitTime(0);
			return $objArmour;
		}
	}
	
	public function loadEquippedTop(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Armour:Top'
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		if($rsResult->rowCount() > 0){
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			$objArmour = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
			return $objArmour;
		}
		else{
			$objArmour = new RPGItem();
			$objArmour->setWaitTime(0);
			return $objArmour;
		}
	}
	
	public function loadEquippedBottom(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Armour:Bottom'
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		if($rsResult->rowCount() > 0){
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			$objArmour = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
			return $objArmour;
		}
		else{
			$objArmour = new RPGItem();
			$objArmour->setWaitTime(0);
			return $objArmour;
		}
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
		if($rsResult->rowCount() > 0){
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			$objWeapon = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
			return $objWeapon;
		}
		else{
			$objWeapon = new RPGItem();
			$objWeapon->setWaitTime(0);
			return $objWeapon;
		}
	}
	
	public function loadEquippedSecondary(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intItemInstanceID
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
					WHERE strItemType LIKE 'Secondary:%'
						AND strHandType = 'Secondary'
						AND intRPGCharacterID = " . $objDB->quote($this->getRPGCharacterID()) . "
						AND blnEquipped = 1";
		$rsResult = $objDB->query($strSQL);
		if($rsResult->rowCount() > 0){
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			$objSecondary = new RPGItem($arrRow['intItemID'], $arrRow['intItemInstanceID']);
			return $objSecondary;
		}
		else{
			$objSecondary = new RPGItem();
			$objSecondary->setWaitTime(0);
			return $objSecondary;
		}
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
			if($objStatusEffect->getStatusEffectName() == "Hungry"){
				$this->_objStats->activateHunger();
			}
			else if($objStatusEffect->getStatusEffectName() == "Full"){
				$this->_objStats->activateFull();
			}
			else if($objStatusEffect->getStatusEffectName() == "Stuffed"){
				$this->_objStats->activateStuffed();
			}
			else if($objStatusEffect->getStatusEffectName() == "Starving"){
				$this->_objStats->activateStarving();
			}
			
			if($objStatusEffect->getStatName() != NULL && !$objStatusEffect->getIncremental() && !$objStatusEffect->getKillBuff()){
				$this->getStats()->addToStats("Status Effect", $objStatusEffect->getStatName(), $objStatusEffect->getStatChangeMax(), $arrRow['strStatusEffectName']);
			}
			
			$objStatusEffect->setTimeRemaining($arrRow['intTimeRemaining']);
			$objStatusEffect->setItemInstanceID($arrRow['intItemInstanceID']);
			$objStatusEffect->setCharacterStatusEffectXRID($arrRow['intCharacterStatusEffectXRID']);
			$this->_arrStatusEffectList[$objStatusEffect->getStatusEffectName()] = $objStatusEffect;
			if(isset($arrRow['intOverrideID'])){
				$this->addOverride($arrRow['intOverrideID']);
			}
		}
	}
	
	public function incrementKillBuffs(){
		foreach($this->getStatusEffectList() as $strStatusEffectName => $objStatusEffect){
			if($objStatusEffect->getKillBuff()){
				if($this->_arrKillBuffs[$objStatusEffect->getStatusEffectName()] != $objStatusEffect->getStatChangeMax()){
					$this->_arrKillBuffs[$objStatusEffect->getStatusEffectName()] = $this->_arrKillBuffs[$objStatusEffect->getStatusEffectName()] + $objStatusEffect->getStatChangeMin();
					$this->_objStats->setStatusEffectStats($objStatusEffect->getStatName(), $objStatusEffect->getStatChangeMin(), $objStatusEffect->getStatusEffectName(), true);
				}
			}
		}
	}
	
	public function removeKillBuffs(){
		foreach($this->getStatusEffectList() as $strStatusEffectName => $objStatusEffect){
			if($objStatusEffect->getKillBuff()){
				unset($this->_arrKillBuffs[$strStatusEffectName]);
				$this->removeFromStatusEffects($objStatusEffect->getStatusEffectName());
				$this->_objStats->removeStatusEffect($objStatusEffect->getStatName(), $objStatusEffect->getStatusEffectName());
			}
		}
	}
	
	public function addToStatusEffects($strStatusEffectName){
		$objStatusEffect = new RPGStatusEffect($strStatusEffectName);
		if($objStatusEffect->getStatName() != NULL && !$objStatusEffect->getIncremental() && !$objStatusEffect->getKillBuff()){
			$this->_objStats->setStatusEffectStats($objStatusEffect->getStatName(), $objStatusEffect->getStatChangeMax(), $objStatusEffect->getStatusEffectName());
		}
		else if($objStatusEffect->getStatName() != NULL && !$objStatusEffect->getIncremental() && $objStatusEffect->getKillBuff()){
			$this->_objStats->setStatusEffectStats($objStatusEffect->getStatName(), $objStatusEffect->getStatChangeMin(), $objStatusEffect->getStatusEffectName(), true);
			$this->_arrKillBuffs[$strStatusEffectName] = 1;
		}
		$this->_arrStatusEffectList[$strStatusEffectName] = $objStatusEffect;
		$this->_arrStatusEffectList[$strStatusEffectName]->create($this->_intRPGCharacterID, $objStatusEffect->getItemInstanceID());
		if($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID() != NULL){
			$this->addOverride($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID());
		}
	}
	
	public function removeFromStatusEffects($strStatusEffectName){
		if($this->_arrStatusEffectList[$strStatusEffectName]->getStatName() != NULL && !$this->_arrStatusEffectList[$strStatusEffectName]->getIncremental() && !$this->_arrStatusEffectList[$strStatusEffectName]->getKillBuff()){
			$this->_objStats->removeStatusEffect($this->_arrStatusEffectList[$strStatusEffectName]->getStatName(), $this->_arrStatusEffectList[$strStatusEffectName]->getStatusEffectName());
		}
		else if($this->_arrStatusEffectList[$strStatusEffectName]->getStatName() != NULL && !$this->_arrStatusEffectList[$strStatusEffectName]->getIncremental() && $this->_arrStatusEffectList[$strStatusEffectName]->getKillBuff()){
			unset($this->_arrKillBuffs[$strStatusEffectName]);
			$this->_objStats->removeStatusEffect($this->_arrStatusEffectList[$strStatusEffectName]->getStatName(), $this->_arrStatusEffectList[$strStatusEffectName]->getStatusEffectName());
		}
		if($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID() != NULL){
			$this->removeOverride($this->_arrStatusEffectList[$strStatusEffectName]->getOverrideID());
		}
		$this->_arrStatusEffectList[$strStatusEffectName]->remove($this->_intRPGCharacterID);
		unset($this->_arrStatusEffectList[$strStatusEffectName]);
	}
	
	public function hasStatusEffect($strStatusEffectName){
		if(array_key_exists($strStatusEffectName, $this->_arrStatusEffectList)){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function checkGiveItem($intItemID, $blnUniqueGift){
		if($blnUniqueGift){
			if(!$this->getEvent()->hasObtainedUniqueItem($intItemID)){
				$this->getEvent()->obtainUniqueItem($intItemID);
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return true;
		}
	}
	
	public function giveItem($intItemID, $strClothingSize = null, $blnUniqueGift = false){
		global $arrClothingSizes;
		$blnGiveItem = $this->checkGiveItem($intItemID, $blnUniqueGift);
		if($blnGiveItem){
			if($strClothingSize == null){
				$strClothingSize = array_search(getClosest($this->getBMI(), array_values($arrClothingSizes)), $arrClothingSizes);
			}
			$objDB = new Database();
			$objItem = new RPGItem($intItemID);
			$strSQL = "INSERT INTO tblcharacteritemxr
							(intRPGCharacterID, intItemID, intCaloriesRemaining, strSize, dtmDateAdded)
						VALUES
							(" . $objDB->quote($this->getRPGCharacterID()) . ", " . $objDB->quote($intItemID) . ", " . $objDB->quote($objItem->getCalories()) . ", " . $objDB->quote($strClothingSize) . ", NOW())";
			$objDB->query($strSQL);
			return $objDB->lastInsertID();
		}
	}
	
	public function giveItemMulti($intItemID, $intAmount, $blnUniqueGift = false){
		$blnGiveItem = $this->checkGiveItem($intItemID, $blnUniqueGift);
		if($blnGiveItem){
			$objDB = new Database();
			for($i=0;$i<$intAmount;$i++){
				$objItem = new RPGItem($intItemID);
				$strSQL = "INSERT INTO tblcharacteritemxr
								(intRPGCharacterID, intItemID, intCaloriesRemaining, strSize, dtmDateAdded)
							VALUES
								(" . $objDB->quote($this->getRPGCharacterID()) . ", " . $objDB->quote($intItemID) . ", " . $objDB->quote($objItem->getCalories()) . ", NULL, NOW())";
				$objDB->query($strSQL);
			}
		}
	}
	
	public function giveItemWithSetEnchants($intItemID, $strClothingSize = null, $intPrefixID = null, $intSuffixID = null, $blnUniqueGift = false){
		$blnGiveItem = $this->checkGiveItem($intItemID, $blnUniqueGift);
		if($blnGiveItem){
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
							(" . $objDB->quote($itemInstanceID) . ", " . $intPrefixID . ", " . $intSuffixID . ")";
			$objDB->query($strSQL);
			// this is a hack for being able to equip the cuirass during the tutorial
			if($intItemID == 6){
				$this->addOverride(3);
			}
		}
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
	
	public function tickStatusEffects($intTicks = 1){
		for($i=0;$i<$intTicks;$i++){
			foreach($this->_arrStatusEffectList as $key => $objStatusEffect){
				if(!$this->_arrStatusEffectList[$key]->getInfinite()){
					$this->_arrStatusEffectList[$key]->tickStatusEffect();
					$this->_arrStatusEffectList[$key]->save($this->_intRPGCharacterID);
					if($this->_arrStatusEffectList[$key]->getTimeRemaining() <= 0){
						$this->removeFromStatusEffects($key);
						break;
					}
				}
				$strStatName = $this->_arrStatusEffectList[$key]->getStatName();
				if($strStatName !== null){
					$intStatMin = $this->_arrStatusEffectList[$key]->getStatChangeMin();
					$intStatMax = $this->_arrStatusEffectList[$key]->getStatChangeMax();
					$intStatChange = mt_rand($intStatMin, $intStatMax);
					$strFunctionNameSet = "set" . $strStatName;
					$strFunctionNameGet = "get" . $strStatName;
					if($this->_arrStatusEffectList[$key]->getIncremental()){
						$this->$strFunctionNameSet($this->$strFunctionNameGet() + $intStatChange);
					}
				}
			}		
		}
	}
	
	public function tickStatusEffect($strStatusEffectName){
		$this->_arrStatusEffectList[$strStatusEffectName]->tickStatusEffect();
		if($this->_arrStatusEffectList[$strStatusEffectName]->getTimeRemaining() <= 0){
			$this->removeFromStatusEffects($strStatusEffectName);
		}
	}
	
	public function tickHunger($intTicks = 1){
		for($i=0;$i<$intTicks;$i++){
			$this->_intCurrentHunger = max(0, round($this->_intCurrentHunger - ($this->_intHungerRate + ($this->getBMI() / 3))));
		}
		
		$dblHungerFactor = $this->_intCurrentHunger / $this->_objStats->getCombinedStatsSecondary('intMaxHunger');
		
		// if hunger is 0%
		if($dblHungerFactor == 0 && !$this->hasStatusEffect("Starving")){
			// give the starving status effect
			$this->addToStatusEffects("Starving");
			$this->getStats()->activateStarving();
			$this->adjustMaxHP();
			$this->setHungerText("You are now starving! You must find something to eat.");
		}
		else if($dblHungerFactor > 0 && $this->hasStatusEffect("Starving")){
			// remove the starving status effect
			$this->removeFromStatusEffects("Starving");
			$this->getStats()->deactivateStarving();
			$this->adjustMaxHP();
		}
		else if($this->hasStatusEffect("Starving")){
			// passive weight loss when hungry
			for($i=0;$i<$intTicks;$i++){
				$this->setWeight($this->getWeight() * 0.9995);
			}
			// random hp loss when starving
			$intHPLossRoll = mt_rand(0, 100);
			$intHPPercentageRoll = mt_rand(1,8);
			$intNewHPModifier = ((100 - $intHPPercentageRoll) / 100);
			if($intHPLossRoll >= 90){
				$this->setCurrentHP(max(1, floor($this->getCurrentHP() * $intNewHPModifier)));
				$this->setHungerText("You double over, clutching your stomach in pain. Continually starving yourself like this will seriously affect your health!");
			}
			$this->getStats()->activateStarving();
		}
		
		
		// if hunger between 1% and 20%
		if($dblHungerFactor > 0 && $dblHungerFactor <= 0.2 && !$this->hasStatusEffect("Hungry")){
			// give the hungry status effect
			$this->addToStatusEffects("Hungry");
			$this->getStats()->activateHunger();
			$this->adjustMaxHP();
			$this->setHungerText("Your stomach growls. You've grown hungry. Better find something to eat!");
		}
		else if(($dblHungerFactor > 0.2 || $dblHungerFactor == 0) && $this->hasStatusEffect("Hungry")){
			// remove the hungry status effect
			$this->removeFromStatusEffects("Hungry");
			$this->getStats()->deactivateHunger();
			$this->adjustMaxHP();
		}
		else if($this->hasStatusEffect("Hungry")){
			// passive weight loss when hungry
			for($i=0;$i<$intTicks;$i++){
				$this->setWeight($this->getWeight() * 0.9995);
			}
			$this->getStats()->activateHunger();
		}
		
		// if hunger between 100 and 150%
		if(($dblHungerFactor >= 1 && $dblHungerFactor < 1.5) && !$this->hasStatusEffect("Full")){
			// give the full status effect
			$this->addToStatusEffects("Full");
			$this->getStats()->activateFull();
			$this->adjustMaxHP();
			$this->setHungerText("You pat your tummy happily, satisfied with how full you are.");
		}
		else if(($dblHungerFactor < 1 || $dblHungerFactor >= 1.5) && $this->hasStatusEffect("Full")){
			// remove the full status effect
			$this->removeFromStatusEffects("Full");
			$this->getStats()->deactivateFull();
			$this->adjustMaxHP();
		}
		else if($this->hasStatusEffect("Full")){
			$this->getStats()->activateFull();
		}
		
		// if hunger above 150%
		if($dblHungerFactor >= 1.5 && !$this->hasStatusEffect("Stuffed")){
			// give the stuffed status effect
			$this->addToStatusEffects("Stuffed");
			$this->getStats()->activateStuffed();
			$this->adjustMaxHP();
			$this->setHungerText("You rub your stuffed belly gingerly and moan. You've ate more than your limit and it clearly shows in your distended midsection.");
			$this->_intTicksStuffed = 1;
		}
		else if($dblHungerFactor < 1.5 && $this->hasStatusEffect("Stuffed")){
			// remove the stuffed status effect
			$this->removeFromStatusEffects("Stuffed");
			$this->getStats()->deactivateStuffed();
			$this->adjustMaxHP();
			$this->_intTicksStuffed = 0;
		}
		else if($this->hasStatusEffect("Stuffed")){
			$this->getStats()->activateStuffed();
			$this->_intTicksStuffed++;
			if($this->_intTicksStuffed >= 8){
				$this->getStats()->setBaseStats('intMaxHunger', ($this->getStats()->getBaseStats()['intMaxHunger'] + 5));
				$this->_intTicksStuffed = 0;
			}
		}
	}
	
	public function getStatusEffectList(){
		return $this->_arrStatusEffectList;
	}
	
	public function eatItem($intItemID, $intItemInstanceID, $intHPHeal, $intFullness = 1){
		$objItem = new RPGItem($intItemID);
		$objItem->useItem($this);
		$this->healHP($intHPHeal);
		$this->_intCurrentHunger = min(($this->getStats()->getCombinedStatsSecondary('intMaxHunger') * 2), ($this->_intCurrentHunger + $intFullness));
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
		$this->_intCurrentHunger = min(($this->getStats()->getCombinedStatsSecondary('intMaxHunger') * 2), ($this->_intCurrentHunger + $objItem->getFullness()));
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET blnDigesting = 1
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function forceEatItemMulti($intItemID, $intAmount){
		for($i=0;$i<$intAmount;$i++){
			$intItemInstanceID = $this->giveItem($intItemID);
			$objItem = new RPGItem($intItemID);
			$this->healHP($objItem->getHPHeal());
			$this->_intCurrentHunger = min(($this->getStats()->getCombinedStatsSecondary('intMaxHunger') * 2), ($this->_intCurrentHunger + $objItem->getFullness()));
			$objDB = new Database();
			$strSQL = "UPDATE tblcharacteritemxr
						SET blnDigesting = 1
						WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
			$objDB->query($strSQL);
		}
	}
	
	public function hasItem($intItemInstanceID){
		$objDB = new Database();
		$strSQL = "SELECT intItemInstanceID FROM tblcharacteritemxr
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID) . "
						AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return isset($arrRow['intItemInstanceID']) ? true : false;
	}
	
	public function disenchantItem($intItemInstanceID, $strEnchantType, $strItemType){
		$objDB = new Database();
		$strItemTypeFunc = "_objEquipped" . $strItemType;
		$strEquippedFunc = "getEquipped" . $strItemType;
		
		if($this->isEquipped($intItemInstanceID)){
			$blnEquipped = true;
		}
		else{
			$blnEquipped = false;
		}
		
		if($strEnchantType == 'Prefix'){
			$strSQL = "UPDATE tbliteminstanceenchant
						SET intPrefixEnchantID = NULL
							WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
			if($blnEquipped){
				$this->statusEffectCheck($strItemTypeFunc, "removeFromStatusEffects", true, false);
				$this->$strEquippedFunc()->setPrefix(NULL);
			}
		}
		else if($strEnchantType == 'Suffix'){
			$strSQL = "UPDATE tbliteminstanceenchant
						SET intSuffixEnchantID = NULL
							WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
			if($blnEquipped){
				$this->statusEffectCheck($strItemTypeFunc, "removeFromStatusEffects", false, true);
				$this->$strEquippedFunc()->setSuffix(NULL);
			}
		}
		$objDB->query($strSQL);
	}
	
	public function healHP($intHPHeal){
		$this->setCurrentHP(min($this->getModifiedMaxHP(), ($this->getCurrentHP() + $intHPHeal)));
	}
	
	public function equipArmour($intItemInstanceID, $intItemID){
		$this->unequipArmour();
		$this->unequipTop();
		$this->unequipBottom();
		$this->_objEquippedArmour = new RPGItem($intItemID, $intItemInstanceID);
		$this->statusEffectCheck("_objEquippedArmour", "addToStatusEffects");
		if($this->equipClothingCheck('Armour')){
			$this->_objEquippedArmour->equip();
		}
		else{
			$this->unequipArmour();
		}
	}
	
	public function equipTop($intItemInstanceID, $intItemID){
		$this->unequipArmour();
		$this->unequipTop();
		$this->_objEquippedTop = new RPGItem($intItemID, $intItemInstanceID);
		$this->statusEffectCheck("_objEquippedTop", "addToStatusEffects");
		if($this->equipClothingCheck('Top')){
			$this->_objEquippedTop->equip();
		}
		else{
			$this->unequipTop();
		}
	}
	
	public function equipBottom($intItemInstanceID, $intItemID){
		$this->unequipArmour();
		$this->unequipBottom();
		$this->_objEquippedBottom = new RPGItem($intItemID, $intItemInstanceID);
		$this->statusEffectCheck("_objEquippedBottom", "addToStatusEffects");
		if($this->equipClothingCheck('Bottom')){
			$this->_objEquippedBottom->equip();
		}
		else{
			$this->unequipBottom();
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
			$this->unequipSecondary();
			$this->_objEquippedSecondary = new RPGItem($intItemID, $intItemInstanceID);
			$this->_objEquippedSecondary->equip();
			$this->statusEffectCheck("_objEquippedSecondary", "addToStatusEffects");
		}
		else{
			$this->unequipWeapon();
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
	
	public function equipClothingCheck($strClothingType){
		global $arrClothingSizes;
		global $arrArmourBodyParts;
		global $arrTopBodyParts;
		global $arrBottomBodyParts;
		if($strClothingType == 'Armour'){
			$arrBodyParts = $arrArmourBodyParts;
		}
		else if($strClothingType == 'Top'){
			$arrBodyParts = $arrTopBodyParts;
		}
		else{
			$arrBodyParts = $arrBottomBodyParts;
		}
		
		$strGetClothingFunc = "getEquipped" . $strClothingType;
		
		if($this->$strGetClothingFunc()->getRipped()){
			$this->setEquipClothingText("The clothing you are trying to put on is ripped! You should get it fixed at the tailor first.");
			return false;
		}
		else{
			$intClothingBMI = $arrClothingSizes[$this->$strGetClothingFunc()->getSize()];
			$intCharacterBMI = $this->getBMI();
			$objXML = new RPGOutfitReader($this->$strGetClothingFunc()->getXML());
			
			$blnReturn = true;
			foreach($arrBodyParts as $strBodyPart){
				$strBodyPartLC = strtolower($strBodyPart);
				$strGetFunction = "get" . $strBodyPart;
				$strSetFunction = "set" . $strBodyPart . "RipLevel";
				$intBMIDifference = round(($intCharacterBMI + $this->getBody()->$strGetFunction()) - $intClothingBMI);
				
				if(isset($_SESSION['objUISettings']->getOverrides()[2]) || $this->$strGetClothingFunc()->getSize() == 'Stretch'){
					$intBMIDifference = 0;
				}
				
				$node = $objXML->findNodeBetweenBMI('equip', $intBMIDifference);
				
				if(!isset($node[0]->$strBodyPartLC->text)){
					continue;
				}
				
				$this->setEquipClothingText($this->getEquipClothingText() . strval($node[0]->$strBodyPartLC->text . " "));
				
				if($node[0]->$strBodyPartLC->wearable == 'false'){
					$blnReturn = false;
					break;
				}
			}
			
			if($blnReturn == true){
				foreach($arrBodyParts as $strBodyPart){
					$strSetFunction = "set" . $strBodyPart . "RipLevel";
					$strGetFunction = "get" . $strBodyPart;
					$intBMIDifference = round(($intCharacterBMI + $this->getBody()->$strGetFunction()) - $intClothingBMI);
					$node = $objXML->findNodeBetweenBMI('equip', $intBMIDifference);
					$this->getBody()->$strSetFunction(intval($node[0]->responseBMI));
				}
			}
			
			return $blnReturn;
		}
	}
	
	public function ripClothingCheck($strClothingType){
		$strGetClothingFunc = "getEquipped" . $strClothingType;
		if($this->$strGetClothingFunc()->getXML() == null){
			return "";
		}
		else{
			global $arrClothingSizes;
			global $arrArmourBodyParts;
			global $arrTopBodyParts;
			global $arrBottomBodyParts;
			if($strClothingType == 'Armour'){
				$arrBodyParts = $arrArmourBodyParts;
			}
			else if($strClothingType == 'Top'){
				$arrBodyParts = $arrTopBodyParts;
			}
			else{
				$arrBodyParts = $arrBottomBodyParts;
			}
			$strUnequipFunc = "unequip" . $strClothingType;
			$strReturn = "";
			$objXML = new RPGOutfitReader($this->$strGetClothingFunc()->getXML());
			$intClothingBMI = $arrClothingSizes[$this->$strGetClothingFunc()->getSize()];
			$intCharacterBMI = $this->getBMI();
			
			foreach($arrBodyParts as $strBodyPart){
				$strBodyPartLC = strtolower($strBodyPart);
				$strGetFunction = "get" . $strBodyPart;
				$strSetFunction = "set" . $strBodyPart . "RipLevel";
				$strGetRipFunction = "get" . $strBodyPart . "RipLevel";
				$intBMIDifference = round(($intCharacterBMI + $this->getBody()->$strGetFunction()) - $intClothingBMI);
				$intPrevArmourRipLevel = $this->getBody()->$strGetRipFunction();
				
				if(isset($_SESSION['objUISettings']->getOverrides()[2]) || $this->$strGetClothingFunc()->getSize() == 'Stretch'){
					$intBMIDifference = 0;
				}
				
				$node = $objXML->findNodeBetweenBMI('equip', $intBMIDifference);
				$blnChange = false;
				
				if($intPrevArmourRipLevel != $node[0]->responseBMI){
					$this->getBody()->$strSetFunction(intval($node[0]->responseBMI));
					$this->getBody()->save();
					$blnChange = true;
				}
				
				if($blnChange){
					$node = $objXML->findNodeAtBMI('response', $this->getBody()->$strGetRipFunction());
					if(isset($node[0]->$strBodyPartLC->effect) && $node[0]->$strBodyPartLC->effect == 'fall'){
						$this->$strUnequipFunc();
						$strReturn .= $node[0]->$strBodyPartLC->text . " ";
						break;
					}
					else if(isset($node[0]->$strBodyPartLC->effect) && $node[0]->$strBodyPartLC->effect == 'rip'){
						$strGetEquipFunction = "getEquipped" . $strClothingType;
						$this->$strGetEquipFunction()->setRipped(1);
						$this->$strGetEquipFunction()->save();
						$this->$strUnequipFunc();
						$strReturn .= $node[0]->$strBodyPartLC->text . " ";
						break;
					}
					else{
						$strReturn .= $node[0]->$strBodyPartLC->text . " ";
					}
				}
			}
			
			return $strReturn;
		}
	}
	
	public function repairItem($intItemInstanceID){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET blnRipped = 0
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function resizeItem($intItemInstanceID, $strSize){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacteritemxr
					SET strSize = " . $objDB->quote($strSize) . "
					WHERE intItemInstanceID = " . $objDB->quote($intItemInstanceID);
		$objDB->query($strSQL);
	}
	
	public function getEquippedArmour(){
		return $this->_objEquippedArmour;
	}
	
	public function setEquippedArmour($objArmour){
		$this->_objEquippedArmour = $objArmour;
	}
	
	public function getEquippedTop(){
		return $this->_objEquippedTop;
	}
	
	public function setEquippedTop($objTop){
		$this->_objEquippedTop = $objTop;
	}
	
	public function getEquippedBottom(){
		return $this->_objEquippedBottom;
	}
	
	public function setEquippedBottom($objBottom){
		$this->_objEquippedBottom = $objBottom;
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
	
	public function statusEffectCheck($strGearType, $strAction, $blnPrefix = true, $blnSuffix = true){
		if($this->$strGearType->getPrefix() !== null && $blnPrefix){
			foreach($this->$strGearType->getPrefix()->getStatChanges() as $key => $objStatChange){
				$this->$strAction($objStatChange->getStatusEffect()->getStatusEffectName());
			}
		}
		if($this->$strGearType->getSuffix() !== null && $blnSuffix){
			foreach($this->$strGearType->getSuffix()->getStatChanges() as $key => $objStatChange){
				$this->$strAction($objStatChange->getStatusEffect()->getStatusEffectName());
			}
		}
		
	}
	
	public function unequipArmour(){
		$this->statusEffectCheck("_objEquippedArmour", "removeFromStatusEffects");
		$this->_objEquippedArmour->unequip();
	}
	
	public function unequipTop(){
		$this->statusEffectCheck("_objEquippedTop", "removeFromStatusEffects");
		$this->_objEquippedTop->unequip();
	}
	
	public function unequipBottom(){
		$this->statusEffectCheck("_objEquippedBottom", "removeFromStatusEffects");
		$this->_objEquippedBottom->unequip();
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
	
	public function takeDamage($intDamage){
		$intDamage = max(0, $intDamage);
		$this->setCurrentHP($this->getCurrentHP() - $intDamage);
		return $intDamage;
	}
	
	public function takeDamageNoDeath($intDamage){
		$this->setCurrentHP(max(1, ($this->getCurrentHP() - $intDamage)));
	}
	
	public function isDead(){
		return intval($this->getCurrentHP()) <= 0 ? 1 : 0;
	}
	
	public function reviveCharacter($intWeightGain = 0, $intEventID = NULL){
		global $arrStateValues;
		$this->setCurrentHP($this->getModifiedMaxHP());
		$this->setWeight($this->getWeight() + $intWeightGain);
		$this->setCurrentHunger($this->getStats()->getBaseStats()['intMaxHunger']);
		if($intWeightGain > 0){
			$this->setReviveText("You awake in your bed feeling heavier than before...");
		}
		$this->removeKillBuffs();
		$this->setTownID(1);
		// home location ID
		$this->setLocationID(6);
		$this->setCurrentFloor(NULL);
		$this->setStateID($arrStateValues['Town']);
		if($intEventID != NULL){
			$objEvent = new RPGEvent($intEventID, $this->_intRPGCharacterID);
			if(!$objEvent->hasViewedEvent()){
				$this->setEvent($objEvent);
				$this->setStateID($arrStateValues["Event"]);
			}
		}
	}
	
	public function stuffCharacter($intFullness, $intWeight, $intHPHeal){
		$this->setCurrentHunger(min(($this->getStats()->getCombinedStatsSecondary('intMaxHunger') * 2), $this->getCurrentHunger() + $intFullness));
		$this->setWeight($this->getWeight() + $intWeight);
		$this->healHP($intHPHeal);
	}
	
	public function stuffCharacterDeadly($intFullness, $intWeight){
		if(($this->getCurrentHunger() + $intFullness) >= ($this->getStats()->getCombinedStatsSecondary('intMaxHunger') * 2)){
			$this->setCurrentHP(0);
			$this->setCurrentHunger(min(($this->getStats()->getCombinedStatsSecondary('intMaxHunger') * 2), $this->getCurrentHunger() + $intFullness));
		}
		else{
			$this->setCurrentHunger($this->getCurrentHunger() + $intFullness);
		}
		$this->setWeight($this->getWeight() + $intWeight);
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
	
	public function getNPCName(){
		return $this->_strRPGCharacterName;
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
	
	public function getLikesFatSelf(){
		return $this->_blnLikesFatSelf;
	}
	
	public function setLikesFatSelf($blnLikesFatSelf){
		$this->_blnLikesFatSelf = $blnLikesFatSelf;
	}
	
	public function getLikesFatOthers(){
		return $this->_blnLikesFatOthers;
	}
	
	public function setLikesFatOthers($blnLikesFatOthers){
		$this->_blnLikesFatOthers = $blnLikesFatOthers;
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
	
	public function getEvent(){
		return $this->_objEvent;
	}
	
	public function setEvent($objEvent){
		$this->_objEvent = $objEvent;
	}
	
	public function setEventWithinEvent($intEventID, $intNodeID = 0){
		$this->_objEvent = new RPGEvent($intEventID, $this->_intRPGCharacterID);
		$this->_objEvent->setEventNodeID($intNodeID);
		unset($_SESSION['objRelationship']);
	}
	
	public function hasViewedEvent($intEventID){
		$objEvent = new RPGEvent($intEventID, $this->_intRPGCharacterID);
		return $objEvent->hasViewedEvent();
	}
	
	public function getParty(){
		return $this->_objParty;
	}
	
	public function setParty($objParty){
		$this->_objParty = $objParty;
	}
	
	public function setCombat($intLeaderID, $intEnemyOne = null, $intEnemyTwo = null, $strFirstTurn = "Calculate", $blnNPCInstance = false){
		if($intEnemyOne == "NULL"){
			$intEnemyOne = null;
		}
		if($intEnemyTwo == "NULL"){
			$intEnemyTwo = null;
		}
		global $arrStateValues;
		$this->setStateID($arrStateValues["Combat"]);
		
		$this->_arrCombat["EnemyTeam"] = new RPGEnemyTeam();
		
		// set enemy leader
		if($intLeaderID == 0){
			$this->_arrCombat["EnemyTeam"]->setLeader($this->_objPotentialEnemy->getLeader());
			$this->_arrCombat["EnemyTeam"]->setEnemyOne($this->_objPotentialEnemy->getEnemyOne());
			$this->_arrCombat["EnemyTeam"]->setEnemyTwo($this->_objPotentialEnemy->getEnemyTwo());
		}
		else if($blnNPCInstance && $intLeaderID > 0){
			$this->_arrCombat["EnemyTeam"]->setLeader($_SESSION['objRelationship']);
			if($intEnemyOne != null){
				$this->_arrCombat["EnemyTeam"]->setEnemyOne(new RPGNPC($intEnemyOne));
			}
			if($intEnemyTwo != null){
				$this->_arrCombat["EnemyTeam"]->setEnemyTwo(new RPGNPC($intEnemyTwo));
			}
		}
		else if(!$blnNPCInstance && $intLeaderID > 0){
			$this->_arrCombat["EnemyTeam"]->setLeader(new RPGNPC($intLeaderID));
			if($intEnemyOne != null){
				$this->_arrCombat["EnemyTeam"]->setEnemyOne(new RPGNPC($intEnemyOne));
			}
			if($intEnemyTwo != null){
				$this->_arrCombat["EnemyTeam"]->setEnemyTwo(new RPGNPC($intEnemyTwo));
			}
		}
		
		$this->_arrCombat["FirstTurn"] = $strFirstTurn;
		if(isset($_SESSION['objUISettings']->getOverrides()[3])){
			$this->removeOverride(3);
		}
	}
	
	public function clearCombat(){
		$this->_arrCombat["EnemyTeam"] = null;
		$this->_arrCombat["FirstTurn"] = null;
		// remove poison debuff after battle ends
		if($this->hasStatusEffect('Poisoned')){
			$this->removeFromStatusEffects('Poisoned');
		}
	}
	
	public function getEnemyStartText(){
		return $this->getPotentialEnemy()->getLeader()->getStartText();
	}
	
	public function getEnemyForceStartText(){
		return $this->getPotentialEnemy()->getLeader()->getForceStartText();
	}
	
	public function getEnemyFleeText(){
		return $this->getPotentialEnemy()->getLeader()->getFleeText();
	}
	
	public function getEnemyFailFleeText(){
		return $this->getPotentialEnemy()->getLeader()->getFailFleeText();
	}
	
	public function getEnemyEndText(){
		return $this->getPotentialEnemy()->getLeader()->getEndText();
	}
	
	public function getEnemyDefeatText(){
		return $this->getPotentialEnemy()->getLeader()->getDefeatText();
	}
	
	public function gainExperience($intExpGain){
		if($this->getLevel() != 20){
			$this->_intExperience += $intExpGain;
		}
		if($this->_intExperience >= $this->_intRequiredExperience){
			$this->levelUp();
		}
		$this->_objClassList->gainExperience($intExpGain);
	}
	
	public function levelUp(){
		$intExpDiff = $this->_intExperience - $this->loadRequiredExperience(); 
		$this->_intLevel++;
		$this->setExperience(0);
		$this->_intRequiredExperience = $this->loadRequiredExperience();
		$this->setStatPoints($this->getStatPoints() + 5);
		$this->setCurrentHP($this->getModifiedMaxHP());
		$this->save();
		$this->gainExperience($intExpDiff);
	}
	
	public function loadRequiredExperience(){
		return pow(($this->_intLevel + 1) * 2, 2) * 100;
	}
	
	public function getCurrentHP(){
		return $this->_intCurrentHP;
	}
	
	public function setCurrentHP($intCurrentHP){
		$this->_intCurrentHP = $intCurrentHP;
	}
	
	public function getModifiedAgilityDamage(){
		return round(($this->_objStats->getCombinedStats('intAgility') / 2) + $this->getEquippedWeapon()->getDamage());
	}
	
	public function getModifiedMaxHP(){
		return round($this->_objStats->getBaseStats()['intMaxHP'] + $this->getLevel() + ($this->_objStats->getCombinedStats('intVitality') / 2));
	}
	
	public function getCombat(){
		return $this->_arrCombat;
	}
	
	public function getStats(){
		return $this->_objStats;
	}
	
	public function getWaitTime($udfWaitType){
		$intGearWait = $this->_objEquippedWeapon->getWaitTime() + $this->_objEquippedSecondary->getWaitTime() + $this->_objEquippedArmour->getWaitTime() + $this->_objEquippedTop->getWaitTime() + $this->_objEquippedBottom->getWaitTime();
		if($udfWaitType == 'Standard'){
			// standard attack
			return round(250 + $intGearWait - ($this->_objStats->getCombinedStats('intAgility') / 2) + (250 * $this->getImmobilityFactor()));
		}
		else{
			// skills will add on or decrease wait time by some amount defined by udfWaitType variable
			return round(250 + $udfWaitType + $intGearWait - ($this->_objStats->getCombinedStats('intAgility') / 2) + (250 * $this->getImmobilityFactor()));
		}
	}
	
	public function getModifiedDamage(){
		return round(($this->_objStats->getCombinedStats('intStrength') / 2) + $this->getEquippedWeapon()->getDamage());
	}
	
	public function getModifiedMagicDamage(){
		return round(($this->_objStats->getCombinedStats('intIntelligence') / 2) + $this->getEquippedWeapon()->getMagicDamage());
	}
	
	public function getModifiedDefence(){
		return round(($this->_objStats->getCombinedStats('intVitality') / 3) + $this->getEquippedArmour()->getDefence() + $this->getEquippedTop()->getDefence() + $this->getEquippedBottom()->getDefence() + $this->getEquippedSecondary()->getDefence());
	}
	
	public function getModifiedMagicDefence(){
		return round(($this->_objStats->getCombinedStats('intIntelligence') / 3) + $this->getEquippedArmour()->getMagicDefence() + $this->getEquippedTop()->getMagicDefence() + $this->getEquippedBottom()->getMagicDefence() + $this->getEquippedSecondary()->getMagicDefence());
	}
	
	public function getModifiedBlockRate(){
		return round($this->_objStats->getCombinedStatsSecondary('intBlockRate'));
	}
	
	public function getModifiedBlock(){
		return min((0.5 + ($this->_objStats->getCombinedStatsSecondary('intBlockReduction') / 100)), 1.0);
	}
	
	public function getStatusEffectResistance(){
		return round($this->_objStats->getCombinedStats('intWillpower') * 2);
	}
	
	public function getStatusEffectSuccessRate(){
		return round($this->_objStats->getCombinedStats('intWillpower') * 1);
	}
	
	public function getModifiedCritRate(){
		return round($this->_objStats->getCombinedStats('intDexterity') * 2);
	}
	
	public function getAdditionalDamage(){
		return $this->getLevel() + round($this->_objStats->getCombinedStats('intWillpower') / 4);
	}
	
	public function getModifiedCritDamage(){
		return 1.5;
	}
	
	public function getModifiedCritResistance(){
		return round($this->_objStats->getCombinedStats('intDexterity') * 1);
	}
	
	public function getModifiedFleeRate(){
		return round($this->_objStats->getCombinedStats('intAgility') * 2);
	}
	
	public function getModifiedFleeResistance(){
		return round($this->_objStats->getCombinedStats('intAgility') * 2);
	}
	
	public function getModifiedEvasion(){
		return round(($this->_objStats->getCombinedStats('intAgility') * 2) + $this->_objStats->getCombinedStatsSecondary('intEvasion'));
	}
	
	public function getModifiedPierceRate(){
		return round($this->_objStats->getCombinedStatsSecondary('intPierce'));
	}
	
	public function getModifiedAccuracy(){
		return round(($this->_objStats->getCombinedStats('intDexterity') * 2) + $this->_objStats->getCombinedStatsSecondary('intAccuracy'));
	}
	
	public function getImmobilityFactor(){
		return max(0, ((($this->getBMI() / 40) / 10) - (($this->_objStats->getCombinedStats('intStrength') / 2) / 100)));
	}
	
	public function getModifiedWillpower(){
		return $this->_objStats->getCombinedStats('intWillpower') + $this->getEquippedArmour()->getEnchantStats('Willpower') + $this->getEquippedWeapon()->getEnchantStats('Willpower') + $this->getEquippedSecondary()->getEnchantStats('Willpower') + $this->_objEquippedBottom->getEnchantStats('Willpower') + $this->_objEquippedTop->getEnchantStats('Willpower');
	}
	
	public function getModifiedStrength(){
		return $this->_objStats->getCombinedStats('intStrength') + $this->getEquippedArmour()->getEnchantStats('Strength') + $this->getEquippedWeapon()->getEnchantStats('Strength') + $this->getEquippedSecondary()->getEnchantStats('Strength') + $this->_objEquippedBottom->getEnchantStats('Strength') + $this->_objEquippedTop->getEnchantStats('Strength');
	}
	
	public function getModifiedIntelligence(){
		return $this->_objStats->getCombinedStats('intIntelligence') + $this->getEquippedArmour()->getEnchantStats('Intelligence') + $this->getEquippedWeapon()->getEnchantStats('Intelligence')+ $this->getEquippedSecondary()->getEnchantStats('Intelligence') + $this->_objEquippedBottom->getEnchantStats('Intelligence') + $this->_objEquippedTop->getEnchantStats('Intelligence');
	}
	
	public function getModifiedAgility(){
		return $this->_objStats->getCombinedStats('intAgility') + $this->getEquippedArmour()->getEnchantStats('Agility') + $this->getEquippedWeapon()->getEnchantStats('Agility') + $this->getEquippedSecondary()->getEnchantStats('Agility') + $this->_objEquippedBottom->getEnchantStats('Agility') + $this->_objEquippedTop->getEnchantStats('Agility');
	}
	
	public function getModifiedVitality(){
		return $this->_objStats->getCombinedStats('intVitality') + $this->getEquippedArmour()->getEnchantStats('Vitality') + $this->getEquippedWeapon()->getEnchantStats('Vitality') + $this->getEquippedSecondary()->getEnchantStats('Vitality') + $this->_objEquippedBottom->getEnchantStats('Vitality') + $this->_objEquippedTop->getEnchantStats('Vitality');
	}
	
	public function getModifiedDexterity(){
		return $this->_objStats->getCombinedStats('intDexterity') + $this->getEquippedArmour()->getEnchantStats('Dexterity') + $this->getEquippedWeapon()->getEnchantStats('Dexterity') + $this->getEquippedSecondary()->getEnchantStats('Dexterity') + $this->_objEquippedBottom->getEnchantStats('Dexterity') + $this->_objEquippedTop->getEnchantStats('Dexterity');
	}
	
	public function getEquipmentStats($strStatName){
		return $this->getEquippedArmour()->getEnchantStats($strStatName) + $this->getEquippedWeapon()->getEnchantStats($strStatName) + $this->getEquippedSecondary()->getEnchantStats($strStatName);
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
		unset($_SESSION['objEnemy']);
		unset($_SESSION['objRelationship']);
		$objPartyOne = new RPGNPC(2, $this->_intRPGCharacterID);
		$this->_objParty = new RPGPlayerTeam($this, $objPartyOne);
		$this->setTownID(0);
		$this->setLocationID(NULL);
		$this->setCurrentFloor($intFloorID);
		$objStartEvent = $this->getCurrentFloor()->getStartEvent($this->_intRPGCharacterID);
		$objStandStillEvent = $this->getCurrentFloor()->getStandstill($this->_intRPGCharacterID);
		if($objStartEvent != NULL){
			$this->setEvent($objStartEvent);
			$this->setStateID($arrStateValues["Event"]);
		}
		else{
			$this->setEvent($objStandStillEvent);
			$this->setStateID($arrStateValues['Field']);
		}
		$this->_objCurrentFloor->loadMaze($this->_objCurrentFloor->getDimension(), $this->_intRPGCharacterID);
	}
	
	public function exitFloor($intLocationID){
		global $arrStateValues;
		unset($this->_objParty);
		$this->removeKillBuffs();
		$this->setTownID(1);
		$this->setLocationID($intLocationID);
		$this->setCurrentFloor(NULL);
		$this->setStateID($arrStateValues['Town']);
	}
	
	public function ascendFloor(){
		if($this->getCurrentFloor()->getFloorID() != 3){
			global $arrStateValues;
			unset($_SESSION['objEnemy']);
			unset($_SESSION['objRelationship']);
			$intPreviousFloor = $this->getCurrentFloor()->getFloorID();
			$intNextFloor = $intPreviousFloor + 1;
			$this->_intFloorID = max($this->_intFloorID, $intNextFloor);
			$this->setCurrentFloor($intNextFloor);
			$objStartEvent = $this->getCurrentFloor()->getStartEvent($this->_intRPGCharacterID);
			$objStandStillEvent = $this->getCurrentFloor()->getStandstill($this->_intRPGCharacterID);
			if($objStartEvent != NULL){
				$this->setEvent($objStartEvent);
				$this->setStateID($arrStateValues["Event"]);
			}
			else{
				$this->setEvent($objStandStillEvent);
				$this->setStateID($arrStateValues["Field"]);
			}
			$this->_objCurrentFloor->loadMaze($this->_objCurrentFloor->getDimension(), $this->_intRPGCharacterID);
		}
	}
	
	public function increaseFloor(){
		if($this->getCurrentFloor()->getFloorID() != 3){
			unset($_SESSION['objEnemy']);
			unset($_SESSION['objRelationship']);
			$intPreviousFloor = $this->getCurrentFloor()->getFloorID();
			$intNextFloor = $intPreviousFloor + 1;
			$this->_intFloorID = max($this->_intFloorID, $intNextFloor);
		}
	}
	
	public function descendFloor(){
		global $arrStateValues;
		unset($_SESSION['objEnemy']);
		unset($_SESSION['objRelationship']);
		$intPreviousFloor = $this->getCurrentFloor()->getFloorID();
		$intNextFloor = $intPreviousFloor - 1;
		$this->setCurrentFloor($intNextFloor);
		$objStartEvent = $this->getCurrentFloor()->getStartEvent($this->_intRPGCharacterID);
		$objStandStillEvent = $this->getCurrentFloor()->getStandstill($this->_intRPGCharacterID);
		if($objStartEvent != NULL){
			$this->setEvent($objStartEvent);
			$this->setStateID($arrStateValues["Event"]);
		}
		else{
			$this->setEvent($objStandStillEvent);
			$this->setStateID($arrStateValues["Field"]);
		}
		$this->_objCurrentFloor->loadMaze($this->_objCurrentFloor->getDimension(), $this->_intRPGCharacterID);
	}
	
	public function resetStats($intCost){
		if($this->getGold() >= $intCost){
			$this->setGold($this->getGold() - $intCost);
			$intTotalStatPoints = $this->_objStats->resetStats();
			$this->setStatPoints($this->getStatPoints() + $intTotalStatPoints);	
			$this->setCurrentHP($this->getModifiedMaxHP());
		}
		else{
			$this->_strErrorText = "You do not have enough gold for this purchase.";
		}
	}
	
	public function getSleep($intHours){
		$this->setTime(RPGTime::addHoursToTime($_SESSION['objRPGCharacter']->getTime(), $intHours));
		$this->digestItems($intHours);
		$this->tickStatusEffects($intHours * 4);
		$this->tickHunger($intHours * 4);
		$this->healHP(round($this->getModifiedMaxHP() * ($intHours / 10)));
	}
	
	public function getCurrentFloor(){
		return $this->_objCurrentFloor;
	}
	
	public function setCurrentFloor($intCurrentFloorID){
		$this->_objCurrentFloor = new RPGFloor($intCurrentFloorID);
	}
	
	public function getBody(){
		return $this->_objBody;
	}
	
	public function getBreasts(){
		return $this->_objBody->getBreasts() + $this->getBMI();
	}
	
	public function getBelly(){
		return $this->_objBody->getBelly() + $this->getBMI();
	}
	
	public function getArms(){
		return $this->_objBody->getArms() + $this->getBMI();
	}
	
	public function getLegs(){
		return $this->_objBody->getLegs() + $this->getBMI();
	}
	
	public function getFace(){
		return $this->_objBody->getFace() + $this->getBMI();
	}
	
	public function getButt(){
		return $this->_objBody->getButt() + $this->getBMI();
	}
	
	public function growButt($intAmount){
		$this->_objBody->setButt($this->_objBody->getButt() + $intAmount);
		$this->_objBody->save();
	}
	
	public function growBelly($intAmount){
		$this->_objBody->setBelly($this->_objBody->getBelly() + $intAmount);
		$this->_objBody->save();
	}
	
	public function growLegs($intAmount){
		$this->_objBody->setLegs($this->_objBody->getLegs() + $intAmount);
		$this->_objBody->save();
	}
	
	public function growArms($intAmount){
		$this->_objBody->setArms($this->_objBody->getArms() + $intAmount);
		$this->_objBody->save();
	}
	
	public function growBreasts($intAmount){
		$this->_objBody->setBreasts($this->_objBody->getBreasts() + $intAmount);
		$this->_objBody->save();
	}
	
	public function growFace($intAmount){
		$this->_objBody->setFace($this->_objBody->getFace() + $intAmount);
		$this->_objBody->save();
	}
	
	public function shrinkButt($intAmount){
		$this->_objBody->setButt(max(0, ($this->_objBody->getButt() - $intAmount)));
		$this->_objBody->save();
	}
	
	public function shrinkBelly($intAmount){
		$this->_objBody->setBelly(max(0, ($this->_objBody->getBelly() - $intAmount)));
		$this->_objBody->save();
	}
	
	public function shrinkLegs($intAmount){
		$this->_objBody->setLegs(max(0, ($this->_objBody->getLegs() - $intAmount)));
		$this->_objBody->save();
	}
	
	public function shrinkArms($intAmount){
		$this->_objBody->setArms(max(0, ($this->_objBody->getArms() - $intAmount)));
		$this->_objBody->save();
	}
	
	public function shrinkBreasts($intAmount){
		$this->_objBody->setBreasts(max(0, ($this->_objBody->getBreasts() - $intAmount)));
		$this->_objBody->save();
	}
	
	public function shrinkFace($intAmount){
		$this->_objBody->setFace(max(0, ($this->_objBody->getFace() - $intAmount)));
		$this->_objBody->save();
	}
	
	public function decreaseHeight(){
		$this->_intHeight = max(121, $this->_intHeight - 3);
	}
	
	public function increaseHeight(){
		$this->_intHeight = min(214, $this->_intHeight + 3);
	}
	
	public function gainRandomWeight($intMin, $intMax){
		$intRand = mt_rand($intMin, $intMax);
		$this->setWeight($this->getWeight() + $intRand);
	}
	
	public function loseRandomWeight($intMin, $intMax){
		$intRand = mt_rand($intMin, $intMax);
		$this->setWeight($this->getWeight() - $intRand);
	}
	
	public function getErrorText(){
		return $this->_strErrorText;
	}
	
	public function setErrorText($strErrorText){
		$this->_strErrorText = $strErrorText;
	}
	
	public function getPotentialEnemy(){
		return $this->_objPotentialEnemy;
	}
	
	public function setPotentialEnemy($objEnemy){
		$this->_objPotentialEnemy = $objEnemy;
	}
	
	public function getCurrentHunger(){
		return $this->_intCurrentHunger;
	}
	
	public function setCurrentHunger($intCurrentHunger){
		$this->_intCurrentHunger = $intCurrentHunger;
	}
	
	public function getHungerRate(){
		return $this->_intHungerRate;
	}
	
	public function setHungerRate($intHungerRate){
		$this->_intHungerRate = $intHungerRate;
	}
	
	public function getTicksStuffed(){
		return $this->_intTicksStuffed;
	}
	
	public function setTicksStuffed($intTicksStuffed){
		$this->_intTicksStuffed = $intTicksStuffed;
	}
	
	public function adjustMaxHP(){
		if($this->_intCurrentHP > $this->getModifiedMaxHP()){
			$this->_intCurrentHP = $this->getModifiedMaxHP();
		}
	}
	
	public function getHungerText(){
		return $this->_strHungerText;
	}
	
	public function setHungerText($strHungerText){
		$this->_strHungerText = $strHungerText;
	}
	
	public function getReviveText(){
		return $this->_strReviveText;
	}
	
	public function setReviveText($strReviveText){
		$this->_strReviveText = $strReviveText;
	}
	
	public function getLastRoll(){
		return $this->_blnLastRoll;
	}
	
	public function setLastRoll($blnRoll){
		$this->_blnLastRoll = $blnRoll;
	}
	
	public function getKillBuffs(){
		return $this->_arrKillBuffs;
	}
	
	public function viewCheckpoint($intCheckpointID){
		if(isset($this->_arrCheckpoints[$intCheckpointID])){
			$this->_arrCheckpoints[$intCheckpointID]->viewCheckpoint();
		}
		else{
			$objCheckpoint = new RPGCheckpoint($intCheckpointID, $this->_intRPGCharacterID, false);
			$objCheckpoint->viewCheckpoint();
			$this->_arrCheckpoints[$intCheckpointID] = $objCheckpoint;
		}
	}
	
	public function hasViewedCheckpoint($intCheckpointID){
		if(isset($this->_arrCheckpoints[$intCheckpointID])){
			return true;
		}
		else{
			return false;
		}
	}
	
}

?>
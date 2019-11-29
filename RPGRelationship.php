<?php

require_once "Database.php";
include_once "RPGNPC.php";
include_once "RPGNPCStats.php";
include_once "RPGNPCGrowth.php";

class RPGRelationship extends RPGNPC {

	private $_intNPCInstanceID;
	private $_intNPCID;
	private $_intRPGCharacterID;
	private $_intLevel;
	private $_intExperience;
	private $_intRelationshipLevel;
	private $_intRelationshipEXP;
	private $_intConversationLevel;
	private $_dblWeight;
	private $_intCurrentHunger;
	private $_intHungerRate;
	private $_intCurrentHP;
	private $_intDigestionRate;
	private $_arrSkillList;
	private $_arrActiveSkillList;
	private $_objStats;
	private $_objGrowth;
	
	public function __construct($intNPCID = null, $intRPGCharacterID = null, $blnNewRelationship = false){
		if($intNPCID != null && $intRPGCharacterID != null && $blnNewRelationship == false){
			parent::__construct($intNPCID);
			$this->loadRelationshipInfo($intNPCID, $intRPGCharacterID);
		}
		else if($intNPCID != null && $intRPGCharacterID != null && $blnNewRelationship == true){
			parent::__construct($intNPCID);
			$this->create($intNPCID, $intRPGCharacterID);
		}
	}
	
	private function populateVarFromRow($arrNPCInfo){
		$this->setNPCInstanceID($arrNPCInfo['intNPCInstanceID']);
		$this->setRPGCharacterID($arrNPCInfo['intRPGCharacterID']);
		$this->setNPCID($arrNPCInfo['intNPCID']);
		$this->setLevel($arrNPCInfo['intLevel']);
		$this->setWeight($arrNPCInfo['dblWeight']);
		$this->setExperience($arrNPCInfo['intExperience']);
		$this->setRelationshipLevel($arrNPCInfo['intRelationshipLevel']);
		$this->setRelationshipEXP($arrNPCInfo['intRelationshipEXP']);
		$this->setConversationLevel($arrNPCInfo['intConversationLevel']);
		$this->setCurrentHunger($arrNPCInfo['intCurrentHunger']);
		$this->setCurrentHP($arrNPCInfo['intCurrentHP']);
		$this->setHungerRate($arrNPCInfo['intHungerRate']);
		$this->setDigestionRate($arrNPCInfo['intDigestionRate']);
	}
	
	private function loadRelationshipInfo($intNPCID, $intRPGCharacterID){
		$objDB = new Database();
		$arrNPCInfo = array();
			$strSQL = "SELECT *
						FROM tblnpcinstance
							WHERE intNPCID = " . $objDB->quote($intNPCID) . "
								AND intRPGCharacterID = " . $objDB->quote($intRPGCharacterID);
			$rsResult = $objDB->query($strSQL);
			$i = 0;
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrNPCInfo['intNPCID'] = $arrRow['intNPCID'];
				$arrNPCInfo['intNPCInstanceID'] = $arrRow['intNPCInstanceID'];
				$arrNPCInfo['intRPGCharacterID'] = $arrRow['intRPGCharacterID'];
				$arrNPCInfo['dblWeight'] = $arrRow['dblWeight'];
				$arrNPCInfo['intLevel'] = $arrRow['intLevel'];
				$arrNPCInfo['intExperience'] = $arrRow['intExperience'];
				$arrNPCInfo['intRelationshipLevel'] = $arrRow['intRelationshipLevel'];
				$arrNPCInfo['intRelationshipEXP'] = $arrRow['intRelationshipEXP'];
				$arrNPCInfo['intConversationLevel'] = $arrRow['intConversationLevel'];
				$arrNPCInfo['intCurrentHunger'] = $arrRow['intCurrentHunger'];
				$arrNPCInfo['intHungerRate'] = $arrRow['intHungerRate'];
				$arrNPCInfo['intCurrentHP'] = $arrRow['intCurrentHP'];
				$arrNPCInfo['intDigestionRate'] = $arrRow['intDigestionRate'];
				$i++;
			}
		if($i > 0){
			$this->populateVarFromRow($arrNPCInfo);
			$this->loadStats();
			$this->loadGrowth();
			$this->loadSkills();
		}
	}
	
	public function save(){
		$objDB = new Database();
		$strSQL = "UPDATE tblnpcinstance
					SET dblWeight = " . $objDB->quote($this->_dblWeight) . ",
						intExperience = " . $objDB->quote($this->_intExperience) . ",
						intRelationshipLevel = " . $objDB->quote($this->_intRelationshipLevel) . ",
						intRelationshipEXP = " . $objDB->quote($this->_intRelationshipEXP) . ",
						intConversationLevel = " . $objDB->quote($this->_intConversationLevel) . ",
						intCurrentHunger = " . $objDB->quote($this->_intCurrentHunger) . ",
						intHungerRate = " . $objDB->quote($this->_intHungerRate) . ",
						intCurrentHP = " . $objDB->quote($this->_intCurrentHP) . ",
						intDigestionRate = " . $objDB->quote($this->_intDigestionRate) . "
							WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
								AND intNPCID = " . $objDB->quote($this->_intNPCID);
		$objDB->query($strSQL);
	}
	
	public function create($intNPCID, $intRPGCharacterID){
		$objDB = new Database();
		$objStats = parent::getStats();
		$strSQL = "INSERT INTO tblnpcinstance (intNPCID, intRPGCharacterID, dblWeight, intCurrentHP, intConversationLevel)
					VALUES (" . $objDB->quote($intNPCID) . ", " . $objDB->quote($intRPGCharacterID) . ", " . $objDB->quote($this->getWeight()) . ", " . $objDB->quote(parent::getModifiedMaxHP()) . ", -1)";
		$objDB->query($strSQL);
		$strSQL = "INSERT INTO tblnpcinstancestats (intNPCID, intRPGCharacterID, intMaxHP, intStrength, intIntelligence, intAgility, intWillpower, intDexterity, intVitality, intAccuracy, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction, intMaxHunger)
					VALUES (" . $objDB->quote($intNPCID) . ", " . $objDB->quote($intRPGCharacterID) . ", " . $objDB->quote($objStats->getCombinedStats('intMaxHP')) . ", " . $objDB->quote($objStats->getCombinedStats('intStrength')) . ", " . $objDB->quote($objStats->getCombinedStats('intIntelligence')) . ", " . $objDB->quote($objStats->getCombinedStats('intAgility')) . ", " . $objDB->quote($objStats->getCombinedStats('intWillpower')) . ", " . $objDB->quote($objStats->getCombinedStats('intDexterity')) . ", " . $objDB->quote($objStats->getCombinedStats('intVitality')) . ", " . $objDB->quote($objStats->getCombinedStats('intAccuracy')) . ", " . $objDB->quote($objStats->getCombinedStats('intEvasion')) . ", " . $objDB->quote($objStats->getCombinedStats('intCritDamage')) . ", " . $objDB->quote($objStats->getCombinedStats('intPierce')) . ", " . $objDB->quote($objStats->getCombinedStats('intBlockRate')) . ", " . $objDB->quote($objStats->getCombinedStats('intBlockReduction')) . ", 1000)";
		$objDB->query($strSQL);
		$this->loadRelationshipInfo($intNPCID, $intRPGCharacterID);
	}
	
	public function loadSkills(){
		$objDB = new Database();
		$this->_arrSkillList = array();
		$strSQL = "SELECT intSkillID, strSkillType
					FROM tblnpcskillxr
						INNER JOIN tblskill
							USING (intSkillID)
						WHERE intNPCID = " . $objDB->quote($this->getNPCID()) . "
							AND intReqLevel = " . $objDB->quote($this->getLevel());
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrSkillList[$arrRow['strSkillType']][] = new RPGSkill($arrRow['intSkillID']);
		}
	}
	
	public function loadStats(){
		$this->_objStats = new RPGNPCStats($this->_intNPCID, $this->_intRPGCharacterID);
		$this->_objStats->loadBaseInstanceStats();
	}
	
	public function loadGrowth(){
		$this->_objGrowth = new RPGNPCGrowth($this->_intNPCID);
		$this->_objGrowth->loadGrowthRates();
	}
	
	public function takeDamage($intDamage){
		$intDamage = max(0, $intDamage);
		$this->setCurrentHP($this->getCurrentHP() - $intDamage);
		return $intDamage;
	}
	
	public function isDead(){
		return intval($this->getCurrentHP()) <= 0 ? 1 : 0;
	}

	public function loadActiveSkillList(){
		$this->_arrActiveSkillList = $this->_arrSkillList;
		foreach($this->_arrActiveSkillList as $strSkillType => $arrSkillList){
			foreach($arrSkillList as $key => $objSkill){
				$this->_arrActiveSkillList[$strSkillType][$key]->setCurrentCooldown(0);
			}
		}
	}

	public function incrementRelationshipLevel(){
		$this->_intRelationshipLevel++;
	}
	
	public function incrementConversationLevel(){
		$this->_intConversationLevel++;
	}
	
	public function getNPCInstanceID(){
		return $this->_intNPCInstanceID;
	}
	
	public function setNPCInstanceID($intNPCInstanceID){
		$this->_intNPCInstanceID = $intNPCInstanceID;
	}
	
	public function getNPCID(){
		return $this->_intNPCID;
	}
	
	public function setNPCID($intNPCID){
		$this->_intNPCID = $intNPCID;
	}
	
	public function getRPGCharacterID(){
		return $this->_intRPGCharacterID;
	}
	
	public function setRPGCharacterID($intRPGCharacterID){
		$this->_intRPGCharacterID = $intRPGCharacterID;
	}
	
	public function getLevel(){
		return $this->_intLevel;
	}
	
	public function setLevel($intLevel){
		$this->_intLevel = $intLevel;
	}
	
	public function getExperience(){
		return $this->_intExperience;
	}
	
	public function setExperience($intExperience){
		$this->_intExperience = $intExperience;
	}
	
	public function getRelationshipLevel(){
		return $this->_intRelationshipLevel;
	}
	
	public function setRelationshipLevel($intRelationshipLevel){
		$this->_intRelationshipLevel = $intRelationshipLevel;
	}
	
	public function getRelationshipEXP(){
		return $this->_intRelationshipEXP;
	}
	
	public function setRelationshipEXP($intRelationshipEXP){
		$this->_intRelationshipEXP = $intRelationshipEXP;
	}
	
	public function getConversationLevel(){
		return $this->_intConversationLevel;
	}
	
	public function setConversationLevel($intConversationLevel){
		$this->_intConversationLevel = $intConversationLevel;
	}
	
	public function getWeight(){
		return $this->_dblWeight;
	}
	
	public function setWeight($dblWeight){
		$this->_dblWeight = $dblWeight;
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
	
	public function getCurrentHP(){
		return $this->_intCurrentHP;
	}
	
	public function setCurrentHP($intCurrentHP){
		$this->_intCurrentHP = $intCurrentHP;
	}
	
	public function getDigestionRate(){
		return $this->_intDigestionRate;
	}
	
	public function setDigestionRate($intDigestionRate){
		$this->_intDigestionRate = $intDigestionRate;
	}
	
	// public function getModifiedMaxHP(){
		// return round($this->_objStats->getCombinedStats('intMaxHP') + ($this->_objStats->getCombinedStats('intVitality') / 2));
	// }
	
	// public function getModifiedDamage(){
		// return round(($this->_objStats->getCombinedStats('intStrength') / 2) + $this->getEquippedWeapon()->getDamage());
	// }
	
	// public function getModifiedMagicDamage(){
		// return round(($this->_objStats->getCombinedStats('intIntelligence') / 2) + $this->getEquippedWeapon()->getMagicDamage());
	// }
	
	// public function getModifiedDefence(){
		// return round(($this->_objStats->getCombinedStats('intVitality') / 4) + $this->getEquippedArmour()->getDefence() + $this->getEquippedSecondary()->getDefence());
	// }
	
	// public function getModifiedMagicDefence(){
		// return round(($this->_objStats->getCombinedStats('intIntelligence') / 4) + $this->getEquippedArmour()->getMagicDefence() + $this->getEquippedSecondary()->getMagicDefence());
	// }
	
	// public function getModifiedBlockRate(){
		// return round($this->_objStats->getCombinedStatsSecondary('intBlockRate'));
	// }
	
	// public function getModifiedBlock(){
		// return min((0.5 + ($this->_objStats->getCombinedStatsSecondary('intBlockReduction') / 100)), 1.0);
	// }
	
	// public function getStatusEffectResistance(){
		// return round($this->_objStats->getCombinedStats('intWillpower') * 2);
	// }
	
	// public function getStatusEffectSuccessRate(){
		// return round($this->_objStats->getCombinedStats('intWillpower') * 1);
	// }
	
	// public function getModifiedCritRate(){
		// return round($this->_objStats->getCombinedStats('intDexterity') * 2);
	// }
	
	// public function getAdditionalDamage(){
		// return round($this->_objStats->getCombinedStats('intWillpower') / 4);
	// }
	
	// public function getModifiedCritDamage(){
		// return 1.5;
	// }
	
	// public function getModifiedCritResistance(){
		// return round($this->_objStats->getCombinedStats('intDexterity') * 1);
	// }
	
	// public function getModifiedFleeRate(){
		// return round($this->_objStats->getCombinedStats('intAgility') / 4);
	// }
	
	// public function getModifiedFleeResistance(){
		// return round($this->_objStats->getCombinedStatsSecondary('intFleeResistance'));
	// }
	
	// public function getModifiedEvasion(){
		// return round(($this->_objStats->getCombinedStats('intAgility') * 2) + $this->_objStats->getCombinedStatsSecondary('intEvasion'));
	// }
	
	// public function getModifiedPierceRate(){
		// return round($this->_objStats->getCombinedStatsSecondary('intPierce'));
	// }
	
	// public function getModifiedAccuracy(){
		// return round(($this->_objStats->getCombinedStats('intDexterity') * 2) + $this->_objStats->getCombinedStatsSecondary('intAccuracy'));
	// }
	
	// public function getWaitTime($udfWaitType){
		// $intGearWait = $this->_objEquippedWeapon->getWaitTime() + $this->_objEquippedSecondary->getWaitTime() + $this->_objEquippedArmour->getWaitTime() + $this->_objEquippedTop->getWaitTime() + $this->_objEquippedBottom->getWaitTime();
		// if($udfWaitType == 'Standard'){
			//standard attack
			// return round(250 + $intGearWait - ($this->_objStats->getCombinedStats('intAgility') / 2) + (250 * $this->getImmobilityFactor()));
		// }
		// else{
			//skills will add on or decrease wait time by some amount defined by udfWaitType variable
			// return round(250 + $udfWaitType + $intGearWait - ($this->_objStats->getCombinedStats('intAgility') / 2) + (250 * $this->getImmobilityFactor()));
		// }
	// }
	
	public function getStats(){
		return $this->_objStats;
	}
	
	public function getGrowth(){
		return $this->_objGrowth;
	}
	
	// public function getImmobilityFactor(){
		// return max(0, ((($this->getBMI() / 40) / 10) - (($this->_objStats->getCombinedStats('intStrength') / 4) / 100)));
	// }
	
	public function getRelationshipBMI(){
		return ($this->getWeight() / dblLBS_PER_KG) / pow($this->getHeight() / 100, 2);
	}

	public function RelationshipGainWeight($intAmount){
		$this->setWeight($this->getWeight() + $intAmount);
	}
	
	public function RelationshipGainRelationshipEXP($intAmount){
		$this->setRelationshipEXP($this->getRelationshipEXP() + $intAmount);
		if($this->getRelationshipEXP() >= 100){
			$this->incrementRelationshipLevel();
			$this->setRelationshipEXP(0);
		}
	}
	
	public function RelationshipLoseRelationshipEXP($intAmount){
		$this->setRelationshipEXP($this->getRelationshipEXP() - $intAmount);
	}
	
	public function getSkillList($strSkillType){
		return $this->_arrSkillList[$strSkillType];
	}
	
	public function getActiveSkillList($strSkillType){
		return $this->_arrActiveSkillList[$strSkillType];
	}
}

?>
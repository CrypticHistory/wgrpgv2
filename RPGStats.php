<?php

	include_once "Database.php";

	class RPGStats{
	
		private $_arrBaseStats;
		private $_arrSkillStats;
		private $_arrStatusEffectStats;
		private $_arrAbilityStats;
		private $_intRPGCharacterID;

		public function __construct($intRPGCharacterID){
			$this->_intRPGCharacterID = $intRPGCharacterID;
		}
		
		public function loadBaseStats(){
			$this->_arrBaseStats = array();
			$objDB = new Database();
			$strSQL = "SELECT intMaxHP, intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction, intMaxHunger, intAccuracy
						FROM tblcharacterstats
							WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$this->_arrBaseStats['intMaxHP'] = $arrRow['intMaxHP'];
				$this->_arrBaseStats['intStrength'] = $arrRow['intStrength'];
				$this->_arrBaseStats['intIntelligence'] = $arrRow['intIntelligence'];
				$this->_arrBaseStats['intAgility'] = $arrRow['intAgility'];
				$this->_arrBaseStats['intVitality'] = $arrRow['intVitality'];
				$this->_arrBaseStats['intWillpower'] = $arrRow['intWillpower'];
				$this->_arrBaseStats['intDexterity'] = $arrRow['intDexterity'];
				$this->_arrBaseStats['intEvasion'] = $arrRow['intEvasion'];
				$this->_arrBaseStats['intAccuracy'] = $arrRow['intAccuracy'];
				$this->_arrBaseStats['intCritDamage'] = $arrRow['intCritDamage'];
				$this->_arrBaseStats['intPierce'] = $arrRow['intPierce'];
				$this->_arrBaseStats['intBlockRate'] = $arrRow['intBlockRate'];
				$this->_arrBaseStats['intBlockReduction'] = $arrRow['intBlockReduction'];
				$this->_arrBaseStats['intMaxHunger'] = $arrRow['intMaxHunger'];
			}
		}
		
		public function saveBaseStats(){
			$objDB = new Database();
			$strSQL = "UPDATE tblcharacterstats
						SET intMaxHP = " . $objDB->quote($this->_arrBaseStats['intMaxHP']) . ",
							intStrength = " . $objDB->quote($this->_arrBaseStats['intStrength']) . ",
							intIntelligence = " . $objDB->quote($this->_arrBaseStats['intIntelligence']) . ",
							intAgility = " . $objDB->quote($this->_arrBaseStats['intAgility']) . ",
							intVitality = " . $objDB->quote($this->_arrBaseStats['intVitality']) . ",
							intWillpower = " . $objDB->quote($this->_arrBaseStats['intWillpower']) . ",
							intDexterity = " . $objDB->quote($this->_arrBaseStats['intDexterity']) . ",
							intEvasion = " . $objDB->quote($this->_arrBaseStats['intEvasion']) . ",
							intAccuracy = " . $objDB->quote($this->_arrBaseStats['intAccuracy']) . ",
							intCritDamage = " . $objDB->quote($this->_arrBaseStats['intCritDamage']) . ",
							intPierce = " . $objDB->quote($this->_arrBaseStats['intPierce']) . ",
							intBlockRate = " . $objDB->quote($this->_arrBaseStats['intBlockRate']) . ",
							intBlockReduction = " . $objDB->quote($this->_arrBaseStats['intBlockReduction']) . ",
							intMaxHunger = " . $objDB->quote($this->_arrBaseStats['intMaxHunger']) . "
							WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
			$objDB->query($strSQL);
		}
		
		public function saveAbilityStats(){
			$objDB = new Database();
			$strSQL = "UPDATE tblcharacterabilitystats
						SET intStrength = " . $objDB->quote($this->_arrAbilityStats['intStrength']) . ",
							intIntelligence = " . $objDB->quote($this->_arrAbilityStats['intIntelligence']) . ",
							intAgility = " . $objDB->quote($this->_arrAbilityStats['intAgility']) . ",
							intVitality = " . $objDB->quote($this->_arrAbilityStats['intVitality']) . ",
							intWillpower = " . $objDB->quote($this->_arrAbilityStats['intWillpower']) . ",
							intDexterity = " . $objDB->quote($this->_arrAbilityStats['intDexterity']) . "
							WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
			$objDB->query($strSQL);
		}
		
		public function saveAll(){
			$this->saveBaseStats();
			$this->saveAbilityStats();
		}
		
		public function loadSkillStats(){
			
		}
		
		public function loadStatusEffectStats(){
			$this->_arrStatusEffectStats = array();
			$this->_arrStatusEffectStats['intStrength']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intIntelligence']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intAgility']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intVitality']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intWillpower']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intDexterity']['Hungry'] = 0;
			
			$this->_arrStatusEffectStats['intStrength']['Full'] = 0;
			$this->_arrStatusEffectStats['intIntelligence']['Full'] = 0;
			$this->_arrStatusEffectStats['intAgility']['Full'] = 0;
			$this->_arrStatusEffectStats['intVitality']['Full'] = 0;
			$this->_arrStatusEffectStats['intWillpower']['Full'] = 0;
			$this->_arrStatusEffectStats['intDexterity']['Full'] = 0;
			
			$this->_arrStatusEffectStats['intStrength']['Stuffed'] = 0;
			$this->_arrStatusEffectStats['intIntelligence']['Stuffed'] = 0;
			$this->_arrStatusEffectStats['intAgility']['Stuffed'] = 0;
			$this->_arrStatusEffectStats['intVitality']['Stuffed'] = 0;
			$this->_arrStatusEffectStats['intWillpower']['Stuffed'] = 0;
			$this->_arrStatusEffectStats['intDexterity']['Stuffed'] = 0;
			
			$this->_arrStatusEffectStats['intMaxHP']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intAccuracy']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intEvasion']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intCritDamage']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intPierce']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intBlockRate']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intBlockReduction']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intFleeResistance']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intMaxHunger']['Hungry'] = 0;
		}
		
		public function loadAbilityStats(){
			$this->_arrAbilityStats = array();
			$objDB = new Database();
			$strSQL = "SELECT intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity
						FROM tblcharacterabilitystats
							WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$this->_arrAbilityStats['intStrength'] = $arrRow['intStrength'];
				$this->_arrAbilityStats['intIntelligence'] = $arrRow['intIntelligence'];
				$this->_arrAbilityStats['intAgility'] = $arrRow['intAgility'];
				$this->_arrAbilityStats['intVitality'] = $arrRow['intVitality'];
				$this->_arrAbilityStats['intWillpower'] = $arrRow['intWillpower'];
				$this->_arrAbilityStats['intDexterity'] = $arrRow['intDexterity'];
			}
		}
		
		public function createNewEntry(){
			$objDB = new Database();
			$strSQL = "INSERT INTO tblcharacterstats
						(intRPGCharacterID, intMaxHP, intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity, intAccuracy, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction, intMaxHunger)
						VALUES
						(" . $objDB->quote($this->_intRPGCharacterID) . ", 10, 5, 5, 5, 5, 5, 5, 0, 0, 150, 0, 0, 10, 1000)";
			$objDB->query($strSQL);
			
			$strSQL = "INSERT INTO tblcharacterabilitystats
						(intRPGCharacterID)
						VALUES
						(" . $objDB->quote($this->_intRPGCharacterID) . ")";
			$objDB->query($strSQL);
		}
		
		public function removeStatusEffect($strStatName, $strStatusEffectName){
			$this->_arrStatusEffectStats[$strStatName][$strStatusEffectName] = 0;
		}
		
		public function addToStats($strStatArrayName, $strStatName, $intStatAmount, $strStatusEffectName = NULL){
			if($strStatArrayName == 'Base'){
				$this->_arrBaseStats[$strStatName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Skill'){
				$this->_arrSkillStats[$strStatName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Status Effect'){
				$this->_arrStatusEffectStats[$strStatName][$strStatusEffectName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Ability'){
				$this->_arrAbilityStats[$strStatName] += $intStatAmount;
			}
		}
		
		public function removeFromStats($strStatArrayName, $strStatName, $intStatAmount, $strStatusEffectName = NULL){
			if($strStatArrayName == 'Base'){
				$this->_arrBaseStats[$strStatName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Skill'){
				$this->_arrSkillStats[$strStatName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Status Effect'){
				$this->_arrStatusEffectStats[$strStatName][$strStatusEffectName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Ability'){
				$this->_arrAbilityStats[$strStatName] -= $intStatAmount;
			}
		}
		
		public function getBaseStats(){
			return $this->_arrBaseStats;
		}
		
		public function setBaseStats($strIndex, $intValue){
			$this->_arrBaseStats[$strIndex] = $intValue;
		}
		
		public function getAbilityStats(){
			return $this->_arrAbilityStats;
		}
		
		public function setAbilityStats($strIndex, $intValue){
			$this->_arrAbilityStats[$strIndex] = $intValue;
		}
		
		public function setStatusEffectStats($strIndex, $intValue, $strStatusEffectName, $blnKillBuff = false){
			if($blnKillBuff){
				$this->_arrStatusEffectStats[$strIndex][$strStatusEffectName] += $intValue;
			}
			else{
				$this->_arrStatusEffectStats[$strIndex][$strStatusEffectName] = $intValue;
			}
		}
		
		public function getStatusEffectStats($strIndex, $strStatusEffectName){
			return $this->_arrStatusEffectStats[$strIndex][$strStatusEffectName];
		}
		
		public function getStatusEffectStatsAll($strIndex){
			
			$intStatTotal = 0;
			foreach($this->_arrStatusEffectStats[$strIndex] as $key => $intStatVal){
				$intStatTotal += $intStatVal;
			}
			
			return $intStatTotal;
			
		}
		
		public function getCombinedStats($strIndex){
			
			$intSEStatTotal = 0;
			foreach($this->_arrStatusEffectStats[$strIndex] as $key => $intStatVal){
				$intSEStatTotal += $intStatVal;
			}
			
			return $this->_arrBaseStats[$strIndex] + $this->_arrAbilityStats[$strIndex] + $intSEStatTotal;
		}
		
		public function getCombinedStatsNoSE($strIndex){
			return $this->_arrBaseStats[$strIndex] + $this->_arrAbilityStats[$strIndex];
		}
		
		public function getCombinedStatsSecondary($strIndex){
			$intSEStatTotal = 0;
			foreach($this->_arrStatusEffectStats[$strIndex] as $key => $intStatVal){
				$intSEStatTotal += $intStatVal;
			}
			
			return $this->_arrBaseStats[$strIndex] + $intSEStatTotal;
		}
		
		public function resetStats(){
			$intTotalStatPoints = 0;
			$intTotalStatPoints = $this->_arrAbilityStats['intStrength']
			+ $this->_arrAbilityStats['intIntelligence']
			+ $this->_arrAbilityStats['intWillpower']
			+ $this->_arrAbilityStats['intDexterity']
			+ $this->_arrAbilityStats['intVitality']
			+ $this->_arrAbilityStats['intAgility'];
			
			$this->_arrAbilityStats['intStrength'] = 0;
			$this->_arrAbilityStats['intIntelligence'] = 0;
			$this->_arrAbilityStats['intWillpower'] = 0;
			$this->_arrAbilityStats['intDexterity'] = 0;
			$this->_arrAbilityStats['intVitality'] = 0;
			$this->_arrAbilityStats['intAgility'] = 0;
			$this->saveAbilityStats();
			return $intTotalStatPoints;
		}
		
		public function activateStarving(){
			$intNewStrength = round($this->getCombinedStatsNoSE("intStrength") * 0.2);
			$intNewIntelligence = round($this->getCombinedStatsNoSE("intIntelligence") * 0.2);
			$intNewAgility = round($this->getCombinedStatsNoSE("intAgility") * 0.2);
			$intNewVitality = round($this->getCombinedStatsNoSE("intVitality") * 0.2);
			$intNewDexterity = round($this->getCombinedStatsNoSE("intDexterity") * 0.2);
			$intNewWillpower = round($this->getCombinedStatsNoSE("intWillpower") * 0.2);
			
			$this->setStatusEffectStats("intStrength", ($intNewStrength * -1), "Starving");
			$this->setStatusEffectStats("intIntelligence", ($intNewIntelligence * -1), "Starving");
			$this->setStatusEffectStats("intAgility", ($intNewAgility * -1), "Starving");
			$this->setStatusEffectStats("intVitality", ($intNewVitality * -1), "Starving");
			$this->setStatusEffectStats("intDexterity", ($intNewDexterity * -1), "Starving");
			$this->setStatusEffectStats("intWillpower", ($intNewWillpower * -1), "Starving");
		}
		
		public function deactivateStarving(){
			$this->setStatusEffectStats("intStrength", 0, "Starving");
			$this->setStatusEffectStats("intIntelligence", 0, "Starving");
			$this->setStatusEffectStats("intAgility", 0, "Starving");
			$this->setStatusEffectStats("intVitality", 0, "Starving");
			$this->setStatusEffectStats("intWillpower", 0, "Starving");
			$this->setStatusEffectStats("intDexterity", 0, "Starving");
		}
		
		public function activateHunger(){
			$intNewStrength = round($this->getCombinedStatsNoSE("intStrength") * 0.1);
			$intNewIntelligence = round($this->getCombinedStatsNoSE("intIntelligence") * 0.1);
			$intNewAgility = round($this->getCombinedStatsNoSE("intAgility") * 0.1);
			$intNewVitality = round($this->getCombinedStatsNoSE("intVitality") * 0.1);
			$intNewDexterity = round($this->getCombinedStatsNoSE("intDexterity") * 0.1);
			$intNewWillpower = round($this->getCombinedStatsNoSE("intWillpower") * 0.1);
			
			$this->setStatusEffectStats("intStrength", ($intNewStrength * -1), "Hungry");
			$this->setStatusEffectStats("intIntelligence", ($intNewIntelligence * -1), "Hungry");
			$this->setStatusEffectStats("intAgility", ($intNewAgility * -1), "Hungry");
			$this->setStatusEffectStats("intVitality", ($intNewVitality * -1), "Hungry");
			$this->setStatusEffectStats("intDexterity", ($intNewDexterity * -1), "Hungry");
			$this->setStatusEffectStats("intWillpower", ($intNewWillpower * -1), "Hungry");
		}
		
		public function deactivateHunger(){
			$this->setStatusEffectStats("intStrength", 0, "Hungry");
			$this->setStatusEffectStats("intIntelligence", 0, "Hungry");
			$this->setStatusEffectStats("intAgility", 0, "Hungry");
			$this->setStatusEffectStats("intVitality", 0, "Hungry");
			$this->setStatusEffectStats("intWillpower", 0, "Hungry");
			$this->setStatusEffectStats("intDexterity", 0, "Hungry");
		}
		
		public function activateFull(){
			$intNewStrength = round($this->getCombinedStatsNoSE("intStrength") * 0.15);
			$intNewIntelligence = round($this->getCombinedStatsNoSE("intIntelligence") * 0.15);
			$intNewAgility = round($this->getCombinedStatsNoSE("intAgility") * 0.15);
			$intNewVitality = round($this->getCombinedStatsNoSE("intVitality") * 0.15);
			$intNewDexterity = round($this->getCombinedStatsNoSE("intDexterity") * 0.15);
			$intNewWillpower = round($this->getCombinedStatsNoSE("intWillpower") * 0.15);
			
			$this->setStatusEffectStats("intStrength", $intNewStrength, "Full");
			$this->setStatusEffectStats("intIntelligence", $intNewIntelligence, "Full");
			$this->setStatusEffectStats("intAgility", $intNewAgility, "Full");
			$this->setStatusEffectStats("intVitality", $intNewVitality, "Full");
			$this->setStatusEffectStats("intDexterity", $intNewDexterity, "Full");
			$this->setStatusEffectStats("intWillpower", $intNewWillpower, "Full");
		}
		
		public function deactivateFull(){
			$this->setStatusEffectStats("intStrength", 0, "Full");
			$this->setStatusEffectStats("intIntelligence", 0, "Full");
			$this->setStatusEffectStats("intAgility", 0, "Full");
			$this->setStatusEffectStats("intVitality", 0, "Full");
			$this->setStatusEffectStats("intWillpower", 0, "Full");
			$this->setStatusEffectStats("intDexterity", 0, "Full");
		}
		
		public function activateStuffed(){
			$intNewAgility = round($this->getCombinedStatsNoSE("intAgility") * 0.1);
			$intNewDexterity = round($this->getCombinedStatsNoSE("intDexterity") * 0.1);
			$intNewWillpower = round($this->getCombinedStatsNoSE("intWillpower") * 0.1);
			$intNewVitality = round($this->getCombinedStatsNoSE("intVitality") * 0.2);
			
			$this->setStatusEffectStats("intAgility", ($intNewAgility * -1), "Stuffed");
			$this->setStatusEffectStats("intDexterity", ($intNewDexterity * -1), "Stuffed");
			$this->setStatusEffectStats("intWillpower", ($intNewWillpower * -1), "Stuffed");
			$this->setStatusEffectStats("intVitality", $intNewVitality, "Stuffed");
		}
		
		public function deactivateStuffed(){
			$this->setStatusEffectStats("intAgility", 0, "Stuffed");
			$this->setStatusEffectStats("intWillpower", 0, "Stuffed");
			$this->setStatusEffectStats("intDexterity", 0, "Stuffed");
			$this->setStatusEffectStats("intVitality", 0, "Stuffed");
		}
		
	}

?>
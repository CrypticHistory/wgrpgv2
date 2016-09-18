<?php

	include_once "Database.php";

	class RPGNPCStats{
	
		private $_arrBaseStats;
		private $_intNPCID;
		private $_intRPGCharacterID;

		public function RPGNPCStats($intNPCID, $intRPGCharacterID = null){
			$this->_intNPCID = $intNPCID;
			if($intRPGCharacterID != null){
				$this->_intRPGCharacterID = $intRPGCharacterID;
			}
		}
		
		public function loadBaseStats(){
			$this->_arrBaseStats = array();
			$objDB = new Database();
			$strSQL = "SELECT intMaxHP, intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity, intAccuracy, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction, intFleeResistance
						FROM tblnpcstats
							WHERE intNPCID = " . $objDB->quote($this->_intNPCID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$this->_arrBaseStats['intMaxHP'] = $arrRow['intMaxHP'];
				$this->_arrBaseStats['intStrength'] = $arrRow['intStrength'];
				$this->_arrBaseStats['intIntelligence'] = $arrRow['intIntelligence'];
				$this->_arrBaseStats['intAgility'] = $arrRow['intAgility'];
				$this->_arrBaseStats['intVitality'] = $arrRow['intVitality'];
				$this->_arrBaseStats['intWillpower'] = $arrRow['intWillpower'];
				$this->_arrBaseStats['intDexterity'] = $arrRow['intDexterity'];
				$this->_arrBaseStats['intAccuracy'] = $arrRow['intAccuracy'];
				$this->_arrBaseStats['intEvasion'] = $arrRow['intEvasion'];
				$this->_arrBaseStats['intCritDamage'] = $arrRow['intCritDamage'];
				$this->_arrBaseStats['intPierce'] = $arrRow['intPierce'];
				$this->_arrBaseStats['intBlockRate'] = $arrRow['intBlockRate'];
				$this->_arrBaseStats['intBlockReduction'] = $arrRow['intBlockReduction'];
				$this->_arrBaseStats['intFleeResistance'] = $arrRow['intFleeResistance'];
			}
		}
		
		public function loadBaseInstanceStats(){
			$this->_arrBaseStats = array();
			$objDB = new Database();
			$strSQL = "SELECT b.intMaxHP, b.intStrength, b.intIntelligence, b.intAgility, b.intVitality, b.intWillpower, b.intDexterity, b.intAccuracy, b.intEvasion, b.intCritDamage, b.intPierce, b.intBlockRate, b.intBlockReduction, a.intFleeResistance, b.intMaxHunger
						FROM tblnpcstats a
							INNER JOIN tblnpcinstancestats b
								USING (intNPCID) 
							WHERE intNPCID = " . $objDB->quote($this->_intNPCID) . "
								AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$this->_arrBaseStats['intMaxHP'] = $arrRow['intMaxHP'];
				$this->_arrBaseStats['intStrength'] = $arrRow['intStrength'];
				$this->_arrBaseStats['intIntelligence'] = $arrRow['intIntelligence'];
				$this->_arrBaseStats['intAgility'] = $arrRow['intAgility'];
				$this->_arrBaseStats['intVitality'] = $arrRow['intVitality'];
				$this->_arrBaseStats['intWillpower'] = $arrRow['intWillpower'];
				$this->_arrBaseStats['intDexterity'] = $arrRow['intDexterity'];
				$this->_arrBaseStats['intAccuracy'] = $arrRow['intAccuracy'];
				$this->_arrBaseStats['intEvasion'] = $arrRow['intEvasion'];
				$this->_arrBaseStats['intCritDamage'] = $arrRow['intCritDamage'];
				$this->_arrBaseStats['intPierce'] = $arrRow['intPierce'];
				$this->_arrBaseStats['intBlockRate'] = $arrRow['intBlockRate'];
				$this->_arrBaseStats['intBlockReduction'] = $arrRow['intBlockReduction'];
				$this->_arrBaseStats['intFleeResistance'] = $arrRow['intFleeResistance'];
				$this->_arrBaseStats['intMaxHunger'] = $arrRow['intMaxHunger'];
			}
		}
		
		public function addToStats($strStatArrayName, $strStatName, $intStatAmount){
			if($strStatArrayName == 'Base'){
				$this->_arrBaseStats[$strStatName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Skill'){
				$this->_arrSkillStats[$strStatName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Status Effect'){
				$this->_arrStatusEffectStats[$strStatName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Ability'){
				$this->_arrAbilityStats[$strStatName] += $intStatAmount;
			}
		}
		
		public function removeFromStats($strStatArrayName, $strStatName, $intStatAmount){
			if($strStatArrayName == 'Base'){
				$_arrBaseStats[$strStatName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Skill'){
				$_arrSkillStats[$strStatName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Status Effect'){
				$_arrStatusEffectStats[$strStatName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Ability'){
				$_arrAbilityStats[$strStatName] -= $intStatAmount;
			}
		}
		
		public function getBaseStats(){
			return $this->_arrBaseStats;
		}
		
		public function setBaseStats($strIndex, $intValue){
			$this->_arrBaseStats[$strIndex] = $intValue;
		}
		
		public function getCombinedStats($strIndex){
			return $this->_arrBaseStats[$strIndex];
		}
		
		public function getCombinedStatsSecondary($strIndex){
			return $this->_arrBaseStats[$strIndex];
		}
	}

?>
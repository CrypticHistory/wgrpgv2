<?php

	include_once "Database.php";

	class RPGNPCStats{
	
		private $_arrBaseStats;
		private $_arrStatusEffectStats;
		private $_intNPCID;
		private $_intRPGCharacterID;

		public function __construct($intNPCID, $intRPGCharacterID = null){
			$this->_intNPCID = $intNPCID;
			if($intRPGCharacterID != null){
				$this->_intRPGCharacterID = $intRPGCharacterID;
			}
			$this->_arrStatusEffectStats = array();
			$this->_arrStatusEffectStats['intMaxHP']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intAccuracy']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intEvasion']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intCritDamage']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intPierce']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intBlockRate']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intBlockReduction']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intFleeResistance']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intStrength']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intIntelligence']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intAgility']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intVitality']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intWillpower']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intDexterity']['Hungry'] = 0;
			$this->_arrStatusEffectStats['intMaxHunger']['Hungry'] = 0;
		}
		
		public function loadBaseStats(){
			$this->_arrBaseStats = array();
			$objDB = new Database();
			$strSQL = "SELECT intMaxHP, intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity, intAccuracy, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction, intFleeResistance, intMaxHunger
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
				$this->_arrBaseStats['intMaxHunger'] = $arrRow['intMaxHunger'];
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
		
		public function save(){
			$objDB = new Database();
			$strSQL = "UPDATE tblnpcinstancestats
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
							intBlockReduction = " . $objDB->quote($this->_arrBaseStats['intBlockReduction']) . "
							WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
								AND intNPCID = " . $objDB->quote($this->_intNPCID);
			$objDB->query($strSQL);
		}
		
		public function applyGrowth($objGrowth){
			$this->_arrBaseStats['intMaxHP'] += $objGrowth->getGrowthRate('intMaxHP');
			$this->_arrBaseStats['intStrength'] += $objGrowth->getGrowthRate('intStrength');
			$this->_arrBaseStats['intIntelligence'] += $objGrowth->getGrowthRate('intIntelligence');
			$this->_arrBaseStats['intAgility'] += $objGrowth->getGrowthRate('intAgility');
			$this->_arrBaseStats['intVitality'] += $objGrowth->getGrowthRate('intVitality');
			$this->_arrBaseStats['intWillpower'] += $objGrowth->getGrowthRate('intWillpower');
			$this->_arrBaseStats['intDexterity'] += $objGrowth->getGrowthRate('intDexterity');
			$this->_arrBaseStats['intAccuracy'] += $objGrowth->getGrowthRate('intAccuracy');
			$this->_arrBaseStats['intEvasion'] += $objGrowth->getGrowthRate('intEvasion');
			$this->_arrBaseStats['intCritDamage'] += $objGrowth->getGrowthRate('intCritDamage');
			$this->_arrBaseStats['intPierce'] += $objGrowth->getGrowthRate('intPierce');
			$this->_arrBaseStats['intBlockRate'] += $objGrowth->getGrowthRate('intBlockRate');
			$this->_arrBaseStats['intBlockReduction'] += $objGrowth->getGrowthRate('intBlockReduction');
		}
		
		public function addToStats($strStatArrayName, $strStatName, $intStatAmount, $strStatusEffectName = NULL){
			if($strStatArrayName == 'Base'){
				$this->_arrBaseStats[$strStatName] += $intStatAmount;
			}
			else if($strStatArrayName == 'Status Effect'){
				$this->_arrStatusEffectStats[$strStatName][$strStatusEffectName] += $intStatAmount;
			}
		}
		
		public function removeFromStats($strStatArrayName, $strStatName, $intStatAmount, $strStatusEffectName = NULL){
			if($strStatArrayName == 'Base'){
				$this->_arrBaseStats[$strStatName] -= $intStatAmount;
			}
			else if($strStatArrayName == 'Status Effect'){
				$this->_arrStatusEffectStats[$strStatName][$strStatusEffectName] -= $intStatAmount;
			}
		}
		
		public function getBaseStats(){
			return $this->_arrBaseStats;
		}
		
		public function setBaseStats($strIndex, $intValue){
			$this->_arrBaseStats[$strIndex] = $intValue;
		}
		
		public function setStatusEffectStats($strIndex, $intValue, $strStatusEffectName){
			$this->_arrStatusEffectStats[$strIndex][$strStatusEffectName] = $intValue;
		}
		
		public function getStatusEffectStats($strIndex, $strStatusEffectName){
			$this->_arrStatusEffectStats[$strIndex][$strStatusEffectName];
		}
		
		public function getCombinedStats($strIndex){
			
			$intSEStatTotal = 0;
			foreach($this->_arrStatusEffectStats[$strIndex] as $key => $intStatVal){
				$intSEStatTotal += $intStatVal;
			}
			
			return $this->_arrBaseStats[$strIndex] + $intSEStatTotal;
		}
		
		public function getCombinedStatsNoSE($strIndex){
			return $this->_arrBaseStats[$strIndex];
		}
		
		public function getCombinedStatsSecondary($strIndex){
			$intSEStatTotal = 0;
			foreach($this->_arrStatusEffectStats[$strIndex] as $key => $intStatVal){
				$intSEStatTotal += $intStatVal;
			}
			
			return $this->_arrBaseStats[$strIndex] + $intSEStatTotal;
		}
		
		public function setRPGCharacterID($intRPGCharacterID){
			$this->_intRPGCharacterID = $intRPGCharacterID;
		}
	}

?>
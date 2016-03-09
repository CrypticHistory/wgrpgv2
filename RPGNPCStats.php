<?php

	include_once "Database.php";

	class RPGNPCStats{
	
		private $_arrBaseStats;
		private $_intNPCID;

		public function RPGNPCStats($intNPCID){
			$this->_intNPCID = $intNPCID;
		}
		
		public function loadBaseStats(){
			$this->_arrBaseStats = array();
			$objDB = new Database();
			$strSQL = "SELECT intMaxHP, intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction
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
				$this->_arrBaseStats['intEvasion'] = $arrRow['intEvasion'];
				$this->_arrBaseStats['intCritDamage'] = $arrRow['intCritDamage'];
				$this->_arrBaseStats['intPierce'] = $arrRow['intPierce'];
				$this->_arrBaseStats['intBlockRate'] = $arrRow['intBlockRate'];
				$this->_arrBaseStats['intBlockReduction'] = $arrRow['intBlockReduction'];
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
	}

?>
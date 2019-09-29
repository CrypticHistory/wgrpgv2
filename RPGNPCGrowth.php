<?php

	include_once "Database.php";

	class RPGNPCGrowth{
	
		private $_arrGrowthRates;
		private $_intNPCID;

		public function __construct($intNPCID){
			$this->_intNPCID = $intNPCID;
			$this->loadGrowthRates();
		}
		
		public function loadGrowthRates(){
			$this->_arrGrowthRates = array();
			$objDB = new Database();
			$strSQL = "SELECT intMaxHP, intStrength, intIntelligence, intAgility, intVitality, intWillpower, intDexterity, intAccuracy, intEvasion, intCritDamage, intPierce, intBlockRate, intBlockReduction
						FROM tblnpcgrowth
							WHERE intNPCID = " . $objDB->quote($this->_intNPCID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$this->_arrGrowthRates['intMaxHP'] = $arrRow['intMaxHP'];
				$this->_arrGrowthRates['intStrength'] = $arrRow['intStrength'];
				$this->_arrGrowthRates['intIntelligence'] = $arrRow['intIntelligence'];
				$this->_arrGrowthRates['intAgility'] = $arrRow['intAgility'];
				$this->_arrGrowthRates['intVitality'] = $arrRow['intVitality'];
				$this->_arrGrowthRates['intWillpower'] = $arrRow['intWillpower'];
				$this->_arrGrowthRates['intDexterity'] = $arrRow['intDexterity'];
				$this->_arrGrowthRates['intAccuracy'] = $arrRow['intAccuracy'];
				$this->_arrGrowthRates['intEvasion'] = $arrRow['intEvasion'];
				$this->_arrGrowthRates['intCritDamage'] = $arrRow['intCritDamage'];
				$this->_arrGrowthRates['intPierce'] = $arrRow['intPierce'];
				$this->_arrGrowthRates['intBlockRate'] = $arrRow['intBlockRate'];
				$this->_arrGrowthRates['intBlockReduction'] = $arrRow['intBlockReduction'];
			}
		}
		
		public function getGrowthRate($strIndex){
			return $this->_arrGrowthRates[$strIndex];
		}
		
	}

?>
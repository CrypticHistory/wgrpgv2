<?php

	include_once "Database.php";
	include_once "RPGEvent.php";
	
	class RPGLocation {
		
		private $_intLocationID;
		private $_strLocationName;
		private $_strLocationType;
		private $_intTownID;
		private $_txtDescription;
		
		public function __construct($intLocationID = null){
			if($intLocationID != null){
				$this->loadLocationInfo($intLocationID);
			}
		}
		
		private function populateVarFromRow($arrLocationInfo){
			$this->setLocationID($arrLocationInfo['intLocationID']);
			$this->setLocationName($arrLocationInfo['strLocationName']);
			$this->setLocationType($arrLocationInfo['strLocationType']);
			$this->setTownID($arrLocationInfo['intTownID']);
			$this->setDescription($arrLocationInfo['txtDescription']);
		}
		
		private function loadLocationInfo($intLocationID){
			$objDB = new Database();
			$arrLocationInfo = array();
			$strSQL = "SELECT *
						FROM tbllocation
							WHERE intLocationID = " . $objDB->quote($intLocationID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrLocationInfo['intLocationID'] = $arrRow['intLocationID'];
				$arrLocationInfo['strLocationName'] = $arrRow['strLocationName'];
				$arrLocationInfo['strLocationType'] = $arrRow['strLocationType'];
				$arrLocationInfo['intTownID'] = $arrRow['intTownID'];
				$arrLocationInfo['txtDescription'] = $arrRow['txtDescription'];
			}
			$this->populateVarFromRow($arrLocationInfo);
		}
		
		public function getLocationID(){
			return $this->_intLocationID;
		}
		
		public function setLocationID($intLocationID){
			$this->_intLocationID = $intLocationID;
		}
		
		public function getLocationName(){
			return $this->_strLocationName;
		}
		
		public function setLocationName($strLocationName){
			$this->_strLocationName = $strLocationName;
		}
		
		public function getLocationType(){
			return $this->_strLocationType;
		}
		
		public function setLocationType($strLocationType){
			$this->_strLocationType = $strLocationType;
		}
		
		public function getTownID(){
			return $this->_intTownID;
		}
		
		public function setTownID($intTownID){
			$this->_intTownID = $intTownID;
		}
		
		public function getDescription(){
			return $this->_txtDescription;
		}
		
		public function setDescription($txtDescription){
			$this->_txtDescription = $txtDescription;
		}
	
		public function getLocationEventLinks(){
			$objDB = new Database();
			$arrReturn = array();
			$strSQL = "SELECT intEventID
						FROM tbllocationeventlink
							INNER JOIN tblevent
								USING (intEventID)
							WHERE intLocationID = " . $objDB->quote($this->_intLocationID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrReturn[] = new RPGEvent($arrRow['intEventID']);
			}
			return $arrReturn;
		}
		
		public function getLocationXRLinks(){
			$objDB = new Database();
			$arrReturn = array();
			$strSQL = "SELECT intToLocationID
						FROM tbllocationxrlink
							INNER JOIN tbllocation
								ON tbllocationxrlink.intToLocationID = tbllocation.intLocationID
							WHERE intFromLocationID = " . $objDB->quote($this->_intLocationID) . "
								AND strLocationType = 'Building'";
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrReturn[] = new RPGLocation($arrRow['intToLocationID']);
			}
			return $arrReturn;
		}
		
		public function getHubLinks(){
			$objDB = new Database();
			$arrReturn = array();
			$strSQL = "SELECT intToLocationID
						FROM tbllocationxrlink
							INNER JOIN tbllocation
								ON tbllocationxrlink.intToLocationID = tbllocation.intLocationID
							WHERE intFromLocationID = " . $objDB->quote($this->_intLocationID) . "
								AND strLocationType = 'Hub'";
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrReturn[] = new RPGLocation($arrRow['intToLocationID']);
			}
			return $arrReturn;
			
		}
		
		public function getLocationShopLinks(){
			$objDB = new Database();
			$arrReturn = array();
			$strSQL = "SELECT intShopID
						FROM tbllocationshoplink
							INNER JOIN tblshop
								USING (intShopID)
							WHERE intLocationID = " . $objDB->quote($this->_intLocationID);
			$rsResult = $objDB->query($strSQL);
			while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrReturn[] = new RPGShop($arrRow['intShopID']);
			}
			return $arrReturn;
		}
		
		public function getFloorLinks($objRPGCharacter){
			$intMaxFloor = $objRPGCharacter->getFloor();
			$arrReturn = array();
			for($i=1; $i<=$intMaxFloor; $i++){
				$arrReturn[] = new RPGFloor($i);
			}
			return $arrReturn;
		}
		
		public function getLinkName($intToLocationID){
			$objDB = new Database();
			$strSQL = "SELECT strLinkName
						FROM tbllocationxrlink
							WHERE intFromLocationID = " . $objDB->quote($this->_intLocationID) . "
								AND intToLocationID = " . $objDB->quote($intToLocationID);
			$rsResult = $objDB->query($strSQL);
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			return $arrRow['strLinkName'];
		}
		
	}
	
?>